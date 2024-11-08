<?php 
namespace Controllers;

use MVC\Router;

class Subirexcel {
    public static function subirexcel(Router $router)
    {
        $router->render('admin/produccion/subirexcel/crear', [
            'titulo' => 'Subir Excel'
        ]);
    }
}