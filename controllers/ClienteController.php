<?php 
namespace Controllers;

use Model\Cliente;
use MVC\Router;

class ClienteController
{
    

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

                if($existeUsuario||$ruc) {
                    Cliente::setAlerta('error', 'El Cliente  o Ruc ya estan registrados');
                    $alertas = Cliente::getAlertas();
                } else {
                    $cliente->guardar();
                    Cliente::setAlerta('exito', 'El Cliente se guardo correctamente');
                    header('Location: /admin/vendedor/cliente/cotizador');
                }

                // debuguear($cliente);

            }

        }

         // Render a la vista
         $router->render('admin/vendedor/cliente/crear', [
            'titulo' => 'cotizar Cliente',
            'alertas' => $alertas
        ]);
    }
}




?>