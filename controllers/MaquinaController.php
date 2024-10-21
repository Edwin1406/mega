<?php

namespace Controllers;

use Model\Maquinas;
use MVC\Router;

 class MaquinaController
 {
     public static function crear(Router $router)
     {
        $alertas = [];

         $router->render('admin/produccion/maquinas/crear', [
             'titulo' => 'CREAR MAQUINA',
             'alertas' => $alertas
             
         ]);
     }
 }




?>