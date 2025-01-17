<?php

namespace Controllers;

use MVC\Router;



class FinancieroController {

    public static function tabla(Router $router)
    {

        $router->render('admin/financiero/tabla', [
            'titulo' => 'GENERAR ORDEN DE COMPRA',

           
        ]);
    }
}