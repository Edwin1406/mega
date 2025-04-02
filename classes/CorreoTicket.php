<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class CorreoTicket {

    public $email;
    public $computadora_id;
    public $usuario_asignado;
    public $descripcion;
    public $fecha_creacion;
    public $estado;
    public $prioridad;
    public $categoria;

    
    public function __construct( $email,$computadora_id,$usuario_asignado,$descripcion,$fecha_creacion,$estado,$prioridad,$categoria)
    {
        $this->email = $email;
        $this->computadora_id = $computadora_id;
        $this->usuario_asignado = $usuario_asignado;
        $this->descripcion = $descripcion;
        $this->fecha_creacion = $fecha_creacion;
        $this->estado = $estado;
        $this->prioridad = $prioridad;
        $this->categoria = $categoria;
    }

    public function enviarConfirmacionTicket() {

         // create a new object
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['EMAIL_HOST'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['EMAIL_PORT'];
         $mail->Username = $_ENV['EMAIL_USER'];
         $mail->Password = $_ENV['EMAIL_PASS'];
         $mail->SMTPSecure = 'ssl';

     
         $mail->setFrom('sistemas@logmegaecuador.com', 'MEGASTOCK S.A.');
         $mail->addAddress($this->email, $this->usuario_asignado);
         $mail->Subject = 'Confirma tu Cuenta';

         // Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';

         $contenido = '<html>';
         $contenido .= "<p><strong>Hola " . $this->usuario_asignado .  "</strong> Has Registrado Correctamente tu cuenta en Sitio Web; pero es necesario confirmarla</p>";
         $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/confirmar-cuenta?token=" . $this->usuario_asignado . "'>Confirmar Cuenta</a>";       
         $contenido .= "<p>Si tu no creaste esta cuenta; puedes ignorar el mensaje</p>";
         $contenido .= '</html>';
         $mail->Body = $contenido;

         //Enviar el mail
         $mail->send();

    }
}