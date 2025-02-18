<?php


namespace Controllers;

use MVC\Router;

class CartoneraController
{
    public static function index(Router $router)
    {
        $router->render('admin/produccion/corrugador/cartonera/index', [
            'titulo' => 'Cotizador Cartonera'
        ]);
    }
}




