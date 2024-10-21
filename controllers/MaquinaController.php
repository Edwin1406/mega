<?php

namespace Controllers;

use Model\Maquinas;
use MVC\Router;

 class MaquinaController
 {
     public static function crear(Router $router)
     {
        $alertas = [];
        $maquina = new Maquinas;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maquina->sincronizar($_POST);

            debuguear($maquina);

        }

         $router->render('admin/produccion/maquinas/crear', [
             'titulo' => 'CREAR MAQUINA',
             'alertas' => $alertas
             
         ]);
     }
 }




?>