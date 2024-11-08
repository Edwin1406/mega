<?php 
namespace Controllers;

use MVC\Router;

class Subirexcel {
    public static function subirexcel(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $archivo = $_FILES['file'];
            $nombreArchivo = $archivo['name'];
            $tipoArchivo = $archivo['type'];
            $tamanoArchivo = $archivo['size'];
            $tempArchivo = $archivo['tmp_name'];
            $error = $archivo['error'];

            if ($error === 0) {
                $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                if ($ext === 'xlsx' || $ext === 'xls') {
                    move_uploaded_file($tempArchivo, __DIR__ . "/../uploads/$nombreArchivo");
                    echo 'Archivo subido correctamente';
                } else {
                    echo 'Solo se permiten archivos de excel';
                }
            } else {
                echo 'Hubo un error al subir el archivo';
            }
        }


        $router->render('admin/produccion/subirexcel/crear', [
            'titulo' => 'Subir Excel'
        ]);
    }
}