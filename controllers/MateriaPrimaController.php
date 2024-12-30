<?php


namespace Controllers;

use MVC\Router;


class MateriaPrimaController
{
   public static function materia(Router $router)
   {

      $alertas = [];
       $router->render('admin/produccion/materia/crear' , [
           'titulo' => 'MEGASTOCK-MATERIA PRIMA',
             'alertas' => $alertas
       ]);
   }
}