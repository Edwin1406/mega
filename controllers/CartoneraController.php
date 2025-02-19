<?php

namespace Controllers;

use MVC\Router;




class CartoneraController {

    public static function cartonera(Router $router)
    {
        $router->render('admin/produccion/materia/corrugador/cartogar/index', [
            'titulo' => 'CARTOGAR',
           
        ]);

    }
}