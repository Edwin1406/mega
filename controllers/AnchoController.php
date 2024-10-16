<?php

namespace Controllers;

use MVC\Router;


class AnchoController
{
    public static function index(Router $router)
    {
        $router->render('admin/ancho/index' , [
            'titulo' => 'Ancho'
        ]);
    }
}
