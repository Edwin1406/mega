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
         // generar qr
         $contenidoQR = $materiaprima->nombre ?? uniqid();
         $materiaprima->barcode = $contenidoQR . '.png';
         debuguear($materiaprima);
      }

      $router->render('admin/produccion/materia/crear' , [
         'titulo' => 'MEGASTOCK-MATERIA PRIMA',
         'alertas' => $alertas
      ]);
   }
}