<?php

namespace Controllers;

use Model\Proveedor;
use MVC\Router;

class ProveedoresController {
    
    public static function index(Router $router) {
        $router->render('admin/proveedor/index', [
            'titulo' => 'Proveedores'
        ]);
    }
    public static function crear(Router $router) {
        $alertas = [];
        $proveedor =  new Proveedor;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proveedor ->sincronizar($_POST);

            //validar
            $alertas = $proveedor->validar();
            
            debuguear($proveedor);
        }

        $router->render('admin/proveedor/crear', [
            'titulo' => 'Crear Proveedor',
            'alertas' => $alertas,
            'proveedor' => $proveedor
        ]);
    }
}