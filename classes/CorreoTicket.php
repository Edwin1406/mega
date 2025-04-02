<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class CorreoTicket {

    public $email;
    public $emailusuario;
    public $computadora_id;
    public $usuario_asignado;
    public $descripcion;
    public $fecha_creacion;
    public $estado;
    public $prioridad;
    public $categoria;

    
    public function __construct( $email,$emailusuario,$computadora_id,$usuario_asignado,$descripcion,$fecha_creacion,$estado,$prioridad,$categoria)
    {
        $this->email = $email;
        $this->emailusuario = $emailusuario;
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
         $mail->addAddress($this->emailusuario, $this->usuario_asignado);
         $mail->Subject = 'Confirma tu Cuenta';

         // Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';

         $contenido = '<html>';
         $contenido .= "<p><strong>Hola " . $this->usuario_asignado .  "</strong> Has creado un ticket con los siguientes datos:</p>";
            $contenido .= "<p><strong>Computadora ID:</strong> " . $this->computadora_id . "</p>";
            $contenido .= "<p><strong>Descripción:</strong> " . $this->descripcion . "</p>";
            $contenido .= "<p><strong>Fecha de creación:</strong> " . $this->fecha_creacion . "</p>";
            $contenido .= "<p><strong>Estado:</strong> " . $this->estado . "</p>";
            $contenido .= "<p><strong>Prioridad:</strong> " . $this->prioridad . "</p>";
            $contenido .= "<p><strong>Categoria:</strong> " . $this->categoria . "</p>";
            $contenido .= "llegare a la brevedad posible para atender tu solicitud.</p>";
         $contenido .= "<> En caso de que no hayas solicitado este ticket, por favor contacta al departamento de sistemas.</p>";
         $contenido .= '</html>';
         $mail->Body = $contenido;

         //Enviar el mail
         $mail->send();

    }
}