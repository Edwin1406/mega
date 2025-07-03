<?php

namespace Controllers;

use Model\Control;
use MVC\Router;

class ControlController {

    public static function crear(Router $router)
    {

        session_start();
        isAuth();

        $control = new Control;

        // post 
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            debuguear($_POST);
        } 

        $alertas = [];

        $router->render('admin/control/crear' , [
            'titulo' => 'CONTROL DE PRODUCCION',
            'alertas' => $alertas,
        ]);

    }

}