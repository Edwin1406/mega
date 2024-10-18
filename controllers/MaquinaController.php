<?php

namespace Controllers;

use MVC\Router;

 class MaquinaController
 {
     public static function crear(Router $router)
     {
         session_start();
         isAuth();
         $router->render('admin/produccion/maquinas/crear', [
             'titulo' => 'CREAR MAQUINA'
         ]);
     }
 }




?>