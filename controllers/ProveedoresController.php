<?php

namespace Controllers;

use MVC\Router;

class ProveedoresController {
    
    public static function index(Router $router) {
        $router->render('proveedores/index', [
            'titulo' => 'Proveedores'
        ]);
    }
}