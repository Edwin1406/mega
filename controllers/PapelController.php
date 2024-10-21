<?php

namespace Controllers;

use Model\Bobina;
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
        $papel = new Bobina;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $papel->sincronizar($_POST);
            debuguear($papel);

        }   

        $router->render('admin/produccion/papel/crear', [
            'titulo' => 'CREAR PAPEL',
            'alertas' => $alertas
        ]);
    }
}