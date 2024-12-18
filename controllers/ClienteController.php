<?php 
namespace Controllers;

use Model\Cliente;
use MVC\Router;

class ClienteController
{
    public static function cotizador(Router $router)
    {
        $id= $_GET['id'] ?? null;
        if($id==1) {
            Cliente::setAlerta('exito', 'El Cliente se guardo correctamente');
        }
        $alertas = Cliente::getAlertas();
        $router->render('admin/vendedor/cliente/cotizador', [
            'titulo' => ' CLIENTE',
            'id' => $id,
            'alertas' => $alertas,
        ]);
    }

    public static function crear(Router $router)
    {
        $alertas = [];
        $cliente = new Cliente;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente ->sincronizar($_POST);
            // debuguear($cliente); 
            $alertas = $cliente->validar();
            if(empty($alertas)) {
                $codigo = Cliente::where('codigo', $cliente->codigo);
                $nombre = Cliente::where('nombre', $cliente->nombre);
                $imagen = $_FILES['imagen'];
                $nombreImagen = preg_replace('/[^a-zA-Z0-9._-]/', '_', $imagen['name']); // Limpia el nombre del archivo
                $archivo = $imagen['tmp_name'];
                $cliente->imagen = $nombreImagen;
                        
                if($codigo || $nombre) {
                    // Ruta destino: carpeta 'src/visor'
                    $destino = $_SERVER['DOCUMENT_ROOT'] . '/src/visor/';
                    
                    // Verificar si la carpeta 'visor' existe, si no, crearla
                    if (!file_exists($destino)) {
                        mkdir($destino, 0777, true); // Crear carpeta con permisos adecuados
                    }
                    
                    // Mover el archivo a la carpeta 'src/visor'
                    if (move_uploaded_file($archivo, $destino . $nombreImagen)) {
                        echo "Archivo subido correctamente a la carpeta 'visor'.";
                        echo "URL de la imagen: https://megawebsistem.com/src/visor/$nombreImagen";
                    } else {
                        echo "Error al subir el archivo a la carpeta 'visor'.";
                    }
                    Cliente::setAlerta('error', 'El Cliente  y Ruc ya estan registrados');
                    $alertas = Cliente::getAlertas();
                } else {
                    $cliente->guardar();
                    header('Location: /admin/vendedor/cliente/cotizador?id=1');
                }
            }
            
            
            
            
        }

         // Render a la vista
         $router->render('admin/vendedor/cliente/crear', [
            'titulo' => 'CREAR CLIENTE',
            'alertas' => $alertas,
        ]);
    }
}




?>