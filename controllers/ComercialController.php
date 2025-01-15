<?php 

namespace Controllers;

use MVC\Router;



class ComercialController {
    public static function index(Router $router)
    {
        $router->render('admin/comercial/index', [
            'titulo' => 'Área Comercial'
        ]);
    }
}





?> 