<?php
namespace Controllers;

use MVC\Router;

class ProduccionController
{
    public static function index(Router $router)
    {
        session_start();
        isAuth();
        $router->render('admin/produccion/index', [
            'titulo' => 'PRODUCCION'
        ]);
    }
}



?>