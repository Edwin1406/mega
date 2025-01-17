<?php

namespace Controllers;

use MVC\Router;



class ComercialController {

    public static function tabla(Router $router)
    {

        $router->render('admin/financiero/tabla', [
            'titulo' => 'GENERAR ORDEN DE COMPRA',

           
        ]);
    }
}