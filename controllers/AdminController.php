<?php

namespace Controllers;

use MVC\Router;


class AdminController
{
    public static function index(Router $router)
    {
        $router->render('admin/dashboard/index' , [
            'titulo' => 'MEGASTOCK-DESARROLLO'
        ]);
    }


    // error 404
    public static function error404(Router $router)
    {
        $router->render('admin/error/404');
    }
}



