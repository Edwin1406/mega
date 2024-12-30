<?php


namespace Controllers;

use MVC\Router;
use Model\MateriaPrima;




class MateriaPrimaController
{
   public static function materia(Router $router)
   {
      $alertas = [];
      $materiaprima = new MateriaPrima;

      if($_SERVER['REQUEST_METHOD'] === 'POST') {
         $materiaprima->sincronizar($_POST);
         $alertas = $materiaprima->validar();
         // // generar codigo de barras md5
         // $materiaprima->barcode = md5();
         // // generar codigo de barras sha1
         $materiaprima->barcode = sha1($materiaprima->barcode);
         debuguear($materiaprima);
         

      }

      $router->render('admin/produccion/materia/crear' , [
         'titulo' => 'MEGASTOCK-MATERIA PRIMA',
         'alertas' => $alertas
      ]);
   }
}