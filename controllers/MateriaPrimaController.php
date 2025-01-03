<?php


namespace Controllers;

use MVC\Router;
use Classes\Pdf;
use Classes\Paginacion;
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
         
         // Generar identificador único de 12 caracteres
         $barcode = substr(md5(uniqid()), 0, 12);

         // Asegurar que los caracteres generados sean válidos para Code39
         $barcode = strtoupper(preg_replace('/[^A-Z0-9\-\/\.\$\+%\s]/', '', $barcode));

         // Asignar el código al atributo
         $materiaprima->barcode = $barcode;
         
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

            $pdf = new Pdf();
            $datos = [
                'tipo' => $materia->tipo,
                'ancho' => $materia->ancho,
                'peso' => $materia->peso,
                'created_at' => $materia->created_at,
                'barcode' => $materia->barcode
            ];
            $pdf->generarPdf($datos);
            $pdf->Output('etiqueta.pdf', 'I');
   }

   public static function ApiMateriaPrima()
   {
    header("Access-Control-Allow-Origin: *");  // Permite solicitudes desde cualquier origen
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
    header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Cabeceras permitidas
      $materias = MateriaPrima::all();
      echo json_encode($materias);
   }




   public static function editar(Router $router)
   {
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    $materiaprima = MateriaPrima::find($id); // Obtener cliente actual
    $alertas = MateriaPrima::getAlertas(); 

    // debuguear($materiaprima);

    // if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     $args = $_POST['materiaprima'];
    //     $materiaprima->sincronizar($args);
    //     $alertas = $materiaprima->validar();
    //     if(empty($alertas)) {
    //         $resultado = $materiaprima->guardar();
    //         if($resultado) {
    //             header('Location: /admin/produccion/materia/tabla');
    //         }
    //     }
    // }

    $router->render('admin/produccion/materia/editar', [
        'titulo' => 'Actualizar Materia Prima',
        'materiaprima' => $materiaprima,
        'alertas' => $alertas
    ]);


  
   }










}