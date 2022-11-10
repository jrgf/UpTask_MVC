<?php 
namespace Model;


class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','nombre','email','password','token','confirmado'];

 
    

    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '';
    }
    public function validarLogin()
    {
        if(!$this->email){
            self::$alertas['error'][]='El E-mail es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][]='La contraseña es obligatoria';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][]='Email No Válido';
        }
        return self::$alertas;
    }
    public function validarCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][]='El nombre es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][]='El E-mail es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][]='La contraseña es obligatoria';
        }
        if(strlen($this->password)<6){
            self::$alertas['error'][]='La contraseña debe tener al menos 6  caracteres';
        }
        
        if($this->password !== $this->password2){
            self::$alertas['error'][]='La contraseña no coincide';
        }
        return self::$alertas;
    }
    public function comprobar_password() :bool{
        return password_verify($this->password_actual,$this->password);
    }
    public function hashPassword() : void{
        $this->password = password_hash($this->password,PASSWORD_BCRYPT);
    }
    public function generarToken(){
        $this->token = uniqid();
    } 
    public function validarEmail(){
    if (!$this->email) {
        self::$alertas['error'][]='El E-mail es obligatorio';
        }
    if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
        self::$alertas['error'][]='Email No Válido';
    }
    return self::$alertas;
    }
    public function validarPassword()
    {
        if(strlen($this->password)<6){
            self::$alertas['error'][]='La contraseña debe tener al menos 6  caracteres';
        }
        
        if($this->password !== $this->password2){
            self::$alertas['error'][]='La contraseña no coincide';
        }
        return self::$alertas;
    }
    public function validar_perfil(){
        if(!$this->nombre){
            self::$alertas['error'][]='El nombre es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }
        return self::$alertas;
    }

    public function nuevo_password() : array {
        if(!$this->password_actual){
            self::$alertas['error'][]='Coloca tu contraseña actual';
        }
        if(!$this->password_nuevo){
            self::$alertas['error'][]='Coloca tu contraseña tu nueva contraseña,no puede ir vacío';
        }
        if(strlen($this->password_nuevo)<6){
            self::$alertas['error'][]='La contraseña debe contener al menos 6 carácteres';
        }
        return self::$alertas;
    }
   
}