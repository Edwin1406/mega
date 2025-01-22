<?php


namespace Controllers;

use MVC\Router;
use Classes\Pdf;
use Classes\Paginacion;
use Model\MateriaPrima;
use Model\MateriaPrimaV;

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

        //  debuguear($materiaprima);
         
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
    if (!$id) {
        header('Location: /admin/produccion/papel/tabla');
    }
    $alertas = [];
    $materia = MateriaPrima::find($id);
    $materia->updated_at = date('Y-m-d H:i:s');
    // tengo un campo menos_peso en el fromulario  quiero con lo que ingrese ahi se reste al peso actual
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $materia->sincronizar($_POST);
        $alertas = $materia->validar();
        // debuguear($materia);
        if($materia->menos_peso<= $materia->peso){
            $materia->peso = $materia->peso - $materia->menos_peso;
        }else{
            $alertas['error'][] = 'El peso a restar no puede ser mayor al peso actual';
        }
        if(empty($alertas)){
            $materia->guardar();
            header('Location: /admin/produccion/materia/tabla');
        }

    }


    // debuguear($materiaprima);

    $router->render('admin/produccion/materia/editar', [
        'titulo' => 'Actualizar Materia Prima',
        'materia' => $materia,
        'alertas' => $alertas
    ]);


  
   }




    public static function lector(Router $router)
    {
        $router->render('admin/produccion/materia/lector', [
            'titulo' => 'LECTOR DE CODIGO DE BARRAS'
        ]);
    }


    public static function graficas(Router $router)
    {
        $router->render('admin/produccion/materia/graficas', [
            'titulo' => 'GRAFICAS DE MATERIA PRIMA'
        ]);
    }





    public static function excel(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $archivo = $_FILES['file'];
            $nombreArchivo = $archivo['name'];
            $tipoArchivo = $archivo['type'];
            $tamanoArchivo = $archivo['size'];
            $tempArchivo = $archivo['tmp_name'];
            $error = $archivo['error'];

            // Validación del archivo
            if ($error === 0) {
                $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                if ($ext === 'xlsx' || $ext === 'xls') {
                    // Mover el archivo a la carpeta de subidas
                    $rutaDestino = __DIR__ . "/../materiaprima/$nombreArchivo";
                    move_uploaded_file($tempArchivo, $rutaDestino);
                    echo 'Archivo subido correctamente';

                    // Llamar al método de Producto para procesar el archivo
                    if (MateriaPrimaV::procesarArchivoExcelMateria($rutaDestino)) {
                        header('Location: /admin/produccion/materia/crear');
                    } else {
                        echo 'Hubo un error al procesar el archivo Excel';
                    }
                } else {
                    echo 'Solo se permiten archivos de Excel (.xlsx, .xls)';
                }
            } else {
                echo 'Hubo un error al subir el archivo';
            }
        }


        $router->render('admin/produccion/materia/excel', [
            'titulo' => 'SUBIR EXCEL',
            'alertas' => $alertas
        ]);
    }


    public static function corrugador(Router $router)
    {
        $corrugador = MateriaPrimaV::where('linea', 'CAJA-KRAFT');

        // Depura el resultado
        debuguear($corrugador);
        
      
        


        $router->render('admin/produccion/materia/corrugador', [
            'titulo' => 'CORRUGADOR'
        ]);
    }


    public static function microcorrugador(Router $router)
    {
        $router->render('admin/produccion/materia/microcorrugador', [
            'titulo' => 'MICRO CORRUGADOR'
        ]);
    }



    public static function periodico(Router $router)
    {
        $router->render('admin/produccion/materia/periodico', [
            'titulo' => 'PERIODICO'
        ]);
    }

    







}