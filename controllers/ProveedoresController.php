<?php

namespace Controllers;

use MVC\Router;

class ProveedoresController {
    
    public static function index(Router $router) {
        $router->render('admin/proveedor/index', [
            'titulo' => 'Proveedores'
        ]);
    }
    public static function crear(Router $router) {
        $alertas = [];

        $router->render('admin/proveedor/crear', [
            'titulo' => 'Crear Proveedor',
            'alertas' => $alertas
        ]);
    }
}