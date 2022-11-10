<?php 

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email {
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email,$nombre,$token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'bd064cd704ebfe';
        $phpmailer->Password = '245decf911be39';

        $phpmailer->setFrom('cuentas@uptask.com');
        $phpmailer->addAddress('cuentas@uptask.com','uptask.com');
        $phpmailer->Subject = 'Confirma tu cuenta';
        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF8';


        $contenido = "<html>";
        $contenido.="<p><strong>".$this->nombre."</strong> Has creado una nueva cuenta en UpTask,confirmala en el siguiente enlace</p>";
        $contenido.= "<p>Presiona aquí: <a href='https://pure-brook-51629.herokuapp.com/confirmar?token=".$this->token."'>Confimar Cuenta</a></p>";
        $contenido.= "<p>Si no creaste esta cuenta,puedes ignorar este mensaje</p>";
        $contenido .="</html>";
        $phpmailer->Body = $contenido;
        $phpmailer->send();
    }
    public function enviarInstrucciones(){
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'bd064cd704ebfe';
        $phpmailer->Password = '245decf911be39';

        $phpmailer->setFrom('cuentas@uptask.com');
        $phpmailer->addAddress('cuentas@uptask.com','uptask.com');
        $phpmailer->Subject = 'Restablece tu contraseña';
        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF8';


        $contenido = "<html>";
        $contenido.="<p><strong>".$this->nombre."</strong> Te hemos enviado un enlace para recuperar tu contraseña</p>";
        $contenido.= "<p>Presiona aquí: <a href='https://pure-brook-51629.herokuapp.com?token=".$this->token."'>Recuperar Cuenta</a></p>";
        $contenido.= "<p>Si no fuiste el que solicito recuperar tu contraseña,puedes ignorar este mensaje</p>";
        $contenido .="</html>";
        $phpmailer->Body = $contenido;
        $phpmailer->send();
    }
   
}