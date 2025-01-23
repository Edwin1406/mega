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


//     public static function corrugador(Router $router)
//     {
//         $corrugador = MateriaPrimaV::allc('DESC', 'CAJA');
        
//         $totalRegistros = MateriaPrimaV::countByLinea('CAJA');
//         $totalExistencia = MateriaPrimaV::sumarExistencia('CAJA');
//         // con deciamles 
//         $totalExistencia = number_format($totalExistencia, 2, '.', ',');
//         $materias = [];

//       if($_SERVER['REQUEST_METHOD'] === 'POST'){
//           $gramaje = $_POST['gramaje'];
//           $ancho = $_POST['ancho'];
//           $materias = MateriaPrimaV::filtrarPorGramajeYAncho($gramaje, $ancho);
//           // debuguear($materias);
//       }
// // Convierte el array de materias filtradas a JSON
// $jsonMaterias = json_encode($materias);


        
//         $router->render('admin/produccion/materia/corrugador', [
//             'titulo' => 'CORRUGADOR',
//             'corrugador' => $corrugador,
//             'totalRegistros' => $totalRegistros,
//             'totalExistencia' => $totalExistencia,
//             'materias' => $materias,
//             'jsonMaterias' => $jsonMaterias
            
//         ]);

//     }

    public static function corrugador(Router $router)
    {
        // GENERAL
        $totalRegistros = MateriaPrimaV::countByLinea('CAJA');
        $totalExistencia = MateriaPrimaV::sumarExistencia('CAJA');
        $totalCosto = MateriaPrimaV::sumarCosto('CAJA');

        // KRAFT
        $totalExistenciaK = MateriaPrimaV::sumarExistencia('CAJA-KRAFT');
        $totalCostoK = MateriaPrimaV::sumarCosto('CAJA-KRAFT');

        // BLANCO
        $totalExistenciaB = MateriaPrimaV::sumarExistencia('CAJA-BLANCO');
        $totalCostoB = MateriaPrimaV::sumarCosto('CAJA-BLANCO');

        // MEDIUM
        $totalExistenciaM = MateriaPrimaV::sumarExistencia('CAJA-MEDIUM');
        $totalCostoM = MateriaPrimaV::sumarCosto('CAJA-MEDIUM');




        // con deciamles
        $totalExistencia = number_format($totalExistencia, 2, '.', ',');
        $totalExistenciaK = number_format($totalExistenciaK, 2, '.', ',');
        $totalExistenciaB = number_format($totalExistenciaB, 2, '.', ',');
        $totalExistenciaM = number_format($totalExistenciaM, 2, '.', ',');
        $totalCosto = number_format($totalCosto, 2, '.', ',');
        $totalCostoK = number_format($totalCostoK, 2, '.', ',');
        $totalCostoB = number_format($totalCostoB, 2, '.', ',');
        $totalCostoM = number_format($totalCostoM, 2, '.', ',');

        $router->render('admin/produccion/materia/corrugador', [
            'titulo' => 'CORRUGADOR',
            'totalRegistros' => $totalRegistros,
            'totalExistencia' => $totalExistencia,
            'totalCosto' => $totalCosto,
            'totalExistenciaK' => $totalExistenciaK,
            'totalCostoK' => $totalCostoK,
            'totalExistenciaB' => $totalExistenciaB,
            'totalCostoB' => $totalCostoB,
            'totalExistenciaM' => $totalExistenciaM,
            'totalCostoM' => $totalCostoM
        ]);
    }



    public static function apicorrugador (){
        $corrugador = MateriaPrimaV::allc('DESC', 'CAJA');
        $jsoncorrugador = json_encode($corrugador);
        $data = json_decode($jsoncorrugador, true);
    
        // Organiza datos para ApexCharts
        $lineas = [];
        foreach ($data as $item) {
            $id = $item['id'];
            $linea = $item['linea'];
            $gramaje = $item['gramaje'];
            $ancho = $item['ancho'];
            $existencia = $item['existencia'];
    
            // Crear etiqueta única combinando gramaje y ancho
            $etiqueta = "$gramaje / $ancho";
    
            // Inicializar la estructura si no existe
            if (!isset($lineas[$linea])) {
                $lineas[$linea] = [
                    'id' => [],
                    'labels' => [],
                    'data' => [],
                    'gramajes' => [],
                    'anchos' => []
                ];
            }
    
            // Agregar la etiqueta y los datos correspondientes

            $lineas[$linea]['id'][] = $id;
            $lineas[$linea]['labels'][] = $etiqueta;
            $lineas[$linea]['data'][] = $existencia;
            $lineas[$linea]['gramajes'][] = $gramaje;
            $lineas[$linea]['anchos'][] = $ancho;


        }
    
        // Envía la respuesta JSON
        header('Content-Type: application/json');
        echo json_encode($lineas);
        exit;
        
    }


    public static function microcorrugador(Router $router)
    {
        $microcorrugador = MateriaPrimaV::allc('DESC', 'MICRO');
        
        
        $totalRegistros = MateriaPrimaV::countByLinea('MICRO');
        $totalExistencia = MateriaPrimaV::sumarExistencia('MICRO');
        // con deciamles 
        $totalExistencia = number_format($totalExistencia, 2, '.', ',');
        
        $router->render('admin/produccion/materia/microcorrugador', [
            'titulo' => 'MICRO CORRUGADOR',
            'microcorrugador' => $microcorrugador,
            'totalRegistros' => $totalRegistros,
            'totalExistencia' => $totalExistencia
        ]);
    }



    public static function periodico(Router $router)
    {

        $periodico = MateriaPrimaV::allc('DESC', 'PERIODICO');
        
        $totalRegistros = MateriaPrimaV::countByLinea('PERIODICO');
        $totalExistencia = MateriaPrimaV::sumarExistencia('PERIODICO');
        // con deciamles 
        $totalExistencia = number_format($totalExistencia, 2, '.', ',');
        
        $router->render('admin/produccion/materia/periodico', [
            'titulo' => 'PERIODICO',
            'periodico' => $periodico,
            'totalRegistros' => $totalRegistros,
            'totalExistencia' => $totalExistencia
        ]);
    }




    public static function cajacraft(Router $router)
    {
        $cajacraft = MateriaPrimaV::all('DESC', 'CAJA-CRAFT');
        
        debuguear($cajacraft);
        $router->render('admin/produccion/materia/cajacraft', [
            'titulo' => 'CAJA CRAFT',
            'cajacraft' => $cajacraft
        ]);
    }
    







}