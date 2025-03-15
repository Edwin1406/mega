<?php

namespace Classes;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;



class Correo {

    public function enviarConAdjunto($destinatario, $asunto, $mensaje, $pdfContenido, $nombreArchivo = 'documento.pdf') {
        try {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure = 'ssl';


            $mail->setFrom('pruebas@odonto.megawebsistem.com', 'Tu Nombre o Empresa');
            $mail->addAddress($destinatario);
            $mail->Subject = $asunto;

            // Configurar el mensaje
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Body = $mensaje;
            

            // Adjuntar el PDF generado en memoria
            $mail->addStringAttachment($pdfContenido, $nombreArchivo, 'base64', 'application/pdf');
            $mail->SMTPDebug = 2; // 1 para mensajes básicos, 2 para detalles
            $mail->Debugoutput = 'html'; // Salida en formato HTML
            
            // Enviar el correo
            if (!$mail->send()) {
                throw new Exception('Error al enviar el correo: ' . $mail->ErrorInfo);
            }
            return true;
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}


