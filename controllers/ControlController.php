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
           
            $control->sincronizar($_POST);

            // debuguear($control);

            // Validar
            $alertas = $control->validar();

            if(empty($alertas)) {
                // Guardar en la base de datos
                $resultado = $control->guardar();
                if($resultado) {
                    header('Location: /admin/control/crear');
                }
            } else {
                // Mostrar alertas
                $alertas = Control::getAlertas();
            }
        } 

        $alertas = [];

        $router->render('admin/control/crear' , [
            'titulo' => 'CONTROL DE PRODUCCION',
            'alertas' => $alertas,
            'control' => $control
        ]);

    }

}