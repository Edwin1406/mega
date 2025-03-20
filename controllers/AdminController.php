<?php

namespace Controllers;

use MVC\Router;


class AdminController
{
    public static function index(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        $router->render('admin/dashboard/index' , [
            'titulo' => 'MEGASTOCK-DESARROLLO'
        ]);
    }


    // error 404
    public static function error404(Router $router)
    {
        echo 'Esta es la página de error 404d.';
        exit();
    }
    
}



