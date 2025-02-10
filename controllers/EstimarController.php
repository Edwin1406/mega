<?php

namespace Controllers;

use MVC\Router;

class EstimarController {

    public static function index(Router $router)
    {
    
        $router->render('admin/produccion/estimar/index', [
            'titulo' => 'Estimar',
        ]);
       
    }
}