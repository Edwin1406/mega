<?php

namespace Classes;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;



// class Correo {

//     public function enviarConAdjunto($destinatario,$destinatario2, $asunto, $mensaje, $pdfContenido, $nombreArchivo = 'documento.pdf') {
//         try {
//             $mail = new PHPMailer();
//             $mail->isSMTP();
//             $mail->Host = $_ENV['EMAIL_HOST'];
//             $mail->SMTPAuth = true;
//             $mail->Port = $_ENV['EMAIL_PORT'];
//             $mail->Username = $_ENV['EMAIL_USER'];
//             $mail->Password = $_ENV['EMAIL_PASS'];
//             $mail->SMTPSecure = 'ssl';


//             $mail->setFrom('sistemas@logmegaecuador.com', 'MEGASTOCK S.A.');
//             $mail->addAddress($destinatario);
//             $mail->addAddress($destinatario2);
//             $mail->Subject = $asunto;

//             // Configurar el mensaje
//             $mail->isHTML(true);
//             $mail->CharSet = 'UTF-8';
//             $mail->Body = $mensaje;
            

//             // Adjuntar el PDF generado en memoria
//             $mail->addStringAttachment($pdfContenido, $nombreArchivo, 'base64', 'application/pdf');
         
            
//             // Enviar el correo
//             if (!$mail->send()) {
//                 throw new Exception('Error al enviar el correo: ' . $mail->ErrorInfo);
//             }
//             return true;
//         } catch (Exception $e) {
//             return 'Error: ' . $e->getMessage();
//         }
//     }
// }


class Correo {

    public function enviarConAdjuntoConImagen($destinatario, $destinatario2, $asunto, $mensaje, $pdfContenido, $nombreArchivo = 'documento.pdf', $rutaImagen, $cidImagen) {
        try {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure = 'ssl';


            $mail->setFrom('sistemas@logmegaecuador.com', 'MEGASTOCK S.A.');
            $mail->addAddress($destinatario);
            $mail->addAddress($destinatario2);
            $mail->Subject = $asunto;

            // Configurar el mensaje HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Aquí puedes agregar la imagen inline con el CID
            $mensajeConFirma = $mensaje . '<p><img src="cid:' . $cidImagen . '" alt="Firma" /></p>';
            $mail->Body = $mensajeConFirma;

            // Adjuntar el PDF generado en memoria
            $mail->addStringAttachment($pdfContenido, $nombreArchivo, 'base64', 'application/pdf');

            // Adjuntar la imagen de la firma
            $mail->addEmbeddedImage($rutaImagen, $cidImagen, '/src/img/Imagen1.png', 'base64', '/src/img/Imagen1.png');

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
