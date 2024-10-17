<?php

namespace Controllers;

use MVC\Router;


class AnchoController
{
    public static function index(Router $router)
    {
        $router->render('admin/areas/index' , [
            'titulo' => 'escoja una area para entrar a la pagina de ancho'
        ]);
    }
}
