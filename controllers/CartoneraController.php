<?php

namespace Controllers;

use Model\Pedido;
use MVC\Router;




class CartoneraController {

    public static function cartonera(Router $router)
    {

        session_start();
        isAuth();
        $id= $_SESSION['id'];
        $alertas = [];
        $pedidosTrimar = Pedido::all('ASC');
        debuguear($pedidosTrimar);
        $router->render('admin/produccion/materia/corrugador/cartonera/index', [
            'titulo' => 'CARTOGAR',
        ]);
    }
}