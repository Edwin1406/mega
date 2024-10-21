<?php

namespace Controllers;

use MVC\Router;

class PapelController
{
    public static function index()
    {
        echo 'index papel';
    }
    public static function crear(Router $router)
    {
        $alertas = [];
        // $papel = new Papel;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){


        }   

        $router->render('admin/produccion/papel/crear', [
            'titulo' => 'CREAR PAPEL',
            'alertas' => $alertas
        ]);
    }
}