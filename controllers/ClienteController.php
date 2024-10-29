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

                $existeUsuario = Cliente::where('email', $cliente->email);
                $ruc = Cliente::where('ruc', $cliente->ruc);
                $nombre = Cliente::where('nombre', $cliente->nombre);


                if($existeUsuario||$ruc || $nombre) {
                    Cliente::setAlerta('error', 'El Cliente  y Ruc ya estan registrados');
                    $alertas = Cliente::getAlertas();
                } else {
                    $cliente->guardar();
                    header('Location: /admin/vendedor/cliente/cotizador?id=1');
                }

                // debuguear($cliente);

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