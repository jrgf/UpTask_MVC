<?php 

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
           $auth = new Usuario($_POST);
           $alertas = $auth->validarLogin();
           if(empty($alertas)){
             $usuario = Usuario::where('email',$auth->email);
             if(!$usuario || !$usuario->confirmado){
                Usuario::setAlerta('error','El usuario no existe o no esta confirmado');
             }
             else{
                //El usuario existe comprobamos password
                if(password_verify($_POST['password'],$usuario->password)){
                    session_start();
                    $_SESSION['id'] = $usuario->id;
                    $_SESSION['nombre'] = $usuario->nombre;
                    $_SESSION['email'] = $usuario->email;
                    $_SESSION['login'] = true;

                    //
                    header('Location: /dashboard');

                }else{
                    Usuario::setAlerta('error','El password es incorrecto');
                }
             }
           }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/login',['titulo'=>"Iniciar Sesión",'alertas'=>$alertas]);
    }
    public static function logout(){
        session_start();
        $_SESSION=[];
        header('Location: /');
    }
    public static function crear(Router $router){
        $alertas=[];
        $usuario = new Usuario;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
          
           $usuario->sincronizar($_POST);
           $alertas = $usuario->validarCuenta();
           //Registrar que el usuario no esta registrado previamente
           
           if(empty($alertas)){
            $usuarioExiste = Usuario::where('email',$usuario->email);
            if($usuarioExiste){
                Usuario::setAlerta('error','Error el usuario ya existe');
                $alertas = Usuario::getAlertas();
           }else{
            $usuario->hashPassword();
            unset($usuario->password2);
            $usuario->generarToken();
            $usuario->confirmado = 0;
            $resultado = $usuario->guardar();
            //Enviar el email
            $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
            $email->enviarConfirmacion();
            if($resultado){
                header('Location: /mensaje');
            }
            
           }
           
           }
          
        }
        $router->render('auth/crear',['titulo'=>"Crear Cuenta",'usuario'=>$usuario,'alertas'=>$alertas]);
    }
    public static function recuperar(Router $router){
       
        $alertas=[];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuario = new Usuario($_POST);
            $alertas=$usuario->validarEmail();
            if(empty($alertas)){
                $usuario = Usuario::where('email',$usuario->email);
                if($usuario && $usuario->confirmado === "1"){
                  $usuario->generarToken();
                  unset($usuario->password2);
                  $usuario->guardar();
                  //Enviando el email
                  $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
                  $email->enviarInstrucciones();
                    Usuario::setAlerta('exito','Se han enviado las instrucciones a tu email');
                }else{
                    Usuario::setAlerta('error','El usuario no existe o no esta confirmado');
                   
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/forget',['titulo'=>'Recuperar Contraseña','alertas'=>$alertas]);
    }
    public static function restablecer(Router $router){
        $token = s($_GET['token']);
        $alertas=[];
        $mostrar = true;
        if(!$token){
            header('Location: /');
        }
        $usuario = Usuario::where('token',$token);
        if(empty($usuario)){
            Usuario::setAlerta('error','Token no Valido');
            $mostrar = false;
        }
        $alertas = Usuario::getAlertas();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPassword();
            if(empty($alertas)){
                $usuario->hashPassword();
                $usuario->token = null;
                $resultado = $usuario->guardar();
                if ($resultado) {
                    header('Location: /');
                }
            }
        }
        $router->render('auth/restablecer',['titulo'=>'Restablecer Contraseña','alertas'=>$alertas,'mostrar'=>$mostrar]);

    }
    public static function mensaje(Router $router){
        $router->render('auth/mensaje',['titulo'=>'Cuenta creada exitosamente']);
    }
    public static function confirmar(Router $router){
        $token = s($_GET['token']);
        $alertas = [];
        if(!$token){
            header('Location: /');
        }
        $usuario = Usuario::where('token',$token);
        if(empty($usuario)){
            Usuario::setAlerta('error','Token no valido');
        }else{
            $usuario->confirmado = 1;
            $usuario->token = "";
            $usuario->guardar();
            Usuario::setAlerta('exito','Su usuario ha sido confirmado exitosamente');
        }
        $alertas=Usuario::getAlertas();
        $router->render('auth/confirmar',['titulo'=>'Confirma tu cuenta','alertas'=>$alertas]);
    }
}