<?php


namespace Controllers;

use Classes\Paginacion;
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


         if(empty($alertas)) {
            $resultado = $materiaprima->guardar();
            if($resultado) {
               header('Location: /admin/produccion/materia/tabla');
            }
         }
      }

      $router->render('admin/produccion/materia/crear' , [
         'titulo' => 'MEGASTOCK-MATERIA PRIMA',
         'alertas' => $alertas
      ]);
   }

   public static function tabla(Router $router)
   {

       $pagina_actual = $_GET['page'];
       $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
       // debuguear($pagina_actual);

       if(!$pagina_actual|| $pagina_actual <1){
           header('Location: /admin/produccion/materia/tabla?page=1');
           exit;
       }
       
       $pagina_por_registros = 5;
       $total = MateriaPrima:: total();
       $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);
       if($paginacion->total_paginas() < $pagina_actual){
           header('Location: /admin/produccion/materia/tabla?page=1');
       }
   
       $materias = MateriaPrima::paginar($pagina_por_registros, $paginacion->offset());



       $router->render('admin/produccion/materia/tabla', [
           'titulo' => 'TABLA DE MATERIA PRIMA',
           'materias' => $materias,
           'paginacion' => $paginacion->paginacion()
       ]);
   }



   public static function pdf(Router $router)
   {
            $alertas = [];
            $id = $_GET['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            $materia = MateriaPrima::find($id);
            if (!$materia) {
                header('Location: /admin/produccion/materia/tabla');
            }

            $pdf =verpdf($materia);
            $pdf->Output('I', 'materia.pdf');
            
   }









}