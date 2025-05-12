<?php 
namespace Controllers;

use MVC\Router;
use Model\Producto;

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

            // Validación del archivo
            if ($error === 0) {
                $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                if ($ext === 'xlsx' || $ext === 'xls') {
                    // Mover el archivo a la carpeta de subidas
                    $rutaDestino = __DIR__ . "/../uploads/$nombreArchivo";
                    move_uploaded_file($tempArchivo, $rutaDestino);
                    echo 'Archivo subido correctamente';

                    // Llamar al método de Producto para procesar el archivo
                    if (Producto::procesarArchivoExcel($rutaDestino)) {
                        echo 'Datos importados correctamente';
                    } else {
                        echo 'Hubo un error al procesar el archivo Excel';
                    }
                } else {
                    echo 'Solo se permiten archivos de Excel (.xlsx, .xls)';
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
