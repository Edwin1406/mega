<?php

namespace Controllers;

use MVC\Router;

class ControlController {

    public static function crear(Router $router)
    {

        session_start();
        isAuth();
        $router->render('admin/control/crear' , [
            'titulo' => 'CONTROL DE PRODUCCION',
        ]);

    }
}