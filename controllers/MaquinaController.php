<?php

namespace Controllers;

use Model\Maquinas;
use MVC\Router;

 class MaquinaController
 {
     public static function crear(Router $router)
     {
         session_start();
         isAuth();
         $id= $_SESSION['id'];
         $escoge = Maquinas::belongsTo('propietarioId',$id);

         $router->render('admin/produccion/maquinas/crear', [
             'titulo' => 'CREAR MAQUINA',
             'escoge' => $escoge
         ]);
     }
 }




?>