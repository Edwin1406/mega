<?php


namespace Controllers;

use MVC\Router;
use Model\MateriaPrima;


class MateriaPrimaController
{
   public static function materia(Router $router)
   {

         $materiaprima = new MateriaPrima;
      if($_SERVER['REQUEST_METHOD'] === 'POST') {
         $materiaprima->sincronizar($_POST);
         debuguear($materiaprima);

      }

      $alertas = [];
       $router->render('admin/produccion/materia/crear' , [
           'titulo' => 'MEGASTOCK-MATERIA PRIMA',
             'alertas' => $alertas
       ]);
   }
}