<?php

namespace Controllers;

use Model\Bobina;
use MVC\Router;

class PapelController
{
   
    public static function tabla(Router $router)
    {
        $papel = Bobina::all();
        // debuguear($papel);
        $router->render('admin/produccion/papel/tabla', [
            'titulo' => 'TABLA DE PAPEL',
            'papel' => $papel
        ]);
    }

    public static function crear(Router $router)
    {
        $alertas = [];
        $papel = new Bobina;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $papel->sincronizar($_POST);
        
            // validar
            $alertas = $papel->validar();
            if(empty($alertas)){
                // guardar en la base de datos
                $papel->guardar();
                header('Location: /admin/produccion/papel/tabla');
            }

        }   

        $router->render('admin/produccion/papel/crear', [
            'titulo' => 'CREAR PAPEL',
            'alertas' => $alertas
        ]);
    }
}