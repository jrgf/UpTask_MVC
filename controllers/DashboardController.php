<?php   

namespace Controllers;

use Model\Proyectos;
use Model\Usuario;
use MVC\Router;

class DashBoardController {
    public static function index(Router $router){
        session_start();
        isAuth();
        $proyectos = Proyectos::belongsTo('propietarioId',$_SESSION['id']);
        $router->render('dashboard/index',['titulo'=>'Proyectos','proyectos'=>$proyectos]);
    }
    public static function crear_proyecto(Router $router){
        session_start();
        isAuth();
        $alertas = [];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $proyecto = new Proyectos($_POST);

           
            //Validacion Proyecto
            $alertas = $proyecto->validarProyecto();
            if(empty($alertas)){
                //Generar URL
                $proyecto->url = md5(uniqid());
                //Almacenar el creador del proyecto
                $proyecto->propietarioId = $_SESSION['id'];
                $proyecto->guardar();
                header('Location: /proyecto?url='.$proyecto->url);
                //Guardar Proyecto
            }
        }
        $router->render('dashboard/crear-proyecto',['titulo'=>'Crear Proyecto','alertas'=>$alertas]);
    }
    public static function perfil(Router $router){
        session_start();
        isAuth();
        $alertas=[];
        $usuario = Usuario::find($_SESSION['id']);
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $usuario->sincronizar($_POST);
    $alertas = $usuario->validar_perfil();
    if (empty($alertas)) {
        $existeUsuario = Usuario::where('email', $usuario->email);
        if ($existeUsuario && $existeUsuario->id !== $usuario->id) {
            Usuario::setAlerta('error', 'Ya existe un usuario registrado con ese correo');
            $alertas = Usuario::getAlertas();
        } else {
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cambios Guardados Correctamente');
            $alertas = Usuario::getAlertas();
            $_SESSION['nombre'] = $usuario->nombre;
        }
    }
}
    $router->render('dashboard/perfil',['titulo'=>'Perfil','usuario'=>$usuario,'alertas'=>$alertas]);
}
       
    public static function proyecto(Router $router){
        session_start();
        isAuth();

        $url = $_GET['url'];
        if(!$url){
            header('Location: /dashboard');
        }
        $proyecto = Proyectos::where('url',$url);
        if($proyecto->propietarioId !== $_SESSION['id']){
            header('Location: /dashboard');
        }
        
        $router->render('dashboard/proyecto',['titulo'=>$proyecto->proyecto]);
    }
    public static function cambiar_password(Router $router){
        session_start();
        isAuth();
        $alertas = [];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuario = Usuario::find($_SESSION['id']);
            $usuario->sincronizar($_POST);
            $alertas = $usuario->nuevo_password();
            if(empty($alertas)){
                $resultado = $usuario->comprobar_password();
                if($resultado){
                    unset($usuario->password_actual);
                    $usuario->password = $usuario->password_nuevo;
                    unset($usuario->password_nuevo);
                    $usuario->hashPassword();
                    $resultado = $usuario->guardar();
                    if($resultado){
                        Usuario::setAlerta('exito','Contraseña Actualizada Correctamente');
                    $alertas = Usuario::getAlertas();
                    }
                    
                }else{
                    Usuario::setAlerta('error','Contraseña incorrecta');
                    $alertas = Usuario::getAlertas();
                }
            }
        }
        $router->render('dashboard/cambiar-password',['titulo'=>'Cambiar Contraseña','alertas'=>$alertas]);
    }
}
