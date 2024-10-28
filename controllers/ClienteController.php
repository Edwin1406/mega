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
            $alertas = $cliente->validar();
            // debuguear($cliente); 
        }




         // Render a la vista
         $router->render('admin/vendedor/cliente/crear', [
            'titulo' => 'Crea un nuevo Cliente',
            'alertas' => $alertas
        ]);
    }
}




?>