<?php 
namespace Controllers;

use MVC\Router;

class ClienteController
{
    

    public static function crear(Router $router)
    {

        $alertas = [];
         // Render a la vista
         $router->render('admin/vendedor/cliente/crear', [
            'titulo' => 'Crea un nuevo Cliente',
            'alertas' => $alertas
        ]);
    }
}




?>