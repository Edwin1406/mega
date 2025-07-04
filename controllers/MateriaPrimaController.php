<?php


namespace Controllers;

use MVC\Router;
use Classes\Pdf;
use Classes\Paginacion;
use Model\Comercial;
use Model\MateriaPrima;
use Model\MateriaPrimaV;
use Model\Pedido;
use Model\Proyecciones;

class MateriaPrimaController
{

   public static function materia(Router $router)
   {
      $alertas = [];
      $materiaprima = new MateriaPrima;

    //   $totalExistencia = MateriaPrimaV::sumarExistencia('CAJA');
    //     // debuguear($totalExistencia);
      
    //   $totalExistenciaMedium = MateriaPrimaV::sumarExistencia('MEDIUM');      
    // //   debuguear($totalExistenciaMedium);
      
    //     $totalExistencia = $totalExistencia + $totalExistenciaMedium;
        
        

    //   $totalExistenciaMicro = MateriaPrimaV::sumarExistencia('MICRO');
    //   $totalExistenciaPeriodico = MateriaPrimaV::sumarExistencia('PERIODICO');
   
    //   $totalExistencia = number_format($totalExistencia, 0, '.', ',');
    //   $totalExistenciaMicro = number_format($totalExistenciaMicro, 0, '.', ',');
    //   $totalExistenciaPeriodico = number_format($totalExistenciaPeriodico, 0, '.', ',');


    //   $allkilos = MateriaPrimaV::allkilogramos('DESC');


    $fechaHoy = date('Y-m-d');

    $totalExistenciaCaja = MateriaPrimaV::sumarExistenciaPorMes('CAJAS-KRAFT');
    $totalExistenciaCajaBlanco = MateriaPrimaV::sumarExistenciaPorMes('CAJAS-BLANCO');
    $totalExistenciaMedium = MateriaPrimaV::sumarExistenciaPorMes('MEDIUM');

    $totalExistenciaCaja = $totalExistenciaCaja + $totalExistenciaCajaBlanco+ $totalExistenciaMedium;

    // debuguear($totalExistenciaMedium);
    $totalExistenciaMicro = MateriaPrimaV::sumarExistenciaPorMes('MICRO-KRAFT');
    // debuguear($totalExistenciaMicro);
    // debuguear($totalExistenciaMicro);
    $totalExistenciaPeriodico = MateriaPrimaV::sumarExistenciaPorMes('PERIODICO');
    
  

    $totalExistenciaCaja = number_format($totalExistenciaCaja, 0, '.', ',');
    $totalExistenciaMicro = number_format($totalExistenciaMicro, 0, '.', ',');
    $totalExistenciaPeriodico = number_format($totalExistenciaPeriodico, 0, '.', ',');
    
    $allkilos = MateriaPrimaV::allkilogramosPorMes('DESC');
        // debuguear($allkilos);

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
      $totalKgAll = 0;
        foreach ($allkilos as $item) {
            $totalKgAll += $item->existencia; // o $item['existencia'] si es array asociativo
        }
        $totalKgAll = number_format($totalKgAll, 0, '.', ',');


      $router->render('admin/produccion/materia/crear' , [
         'titulo' => 'MEGASTOCK-MATERIA PRIMA',
         'alertas' => $alertas,
            'totalExistenciaCaja' => $totalExistenciaCaja,
            'totalExistenciaMicro' => $totalExistenciaMicro,
            'totalExistenciaPeriodico' => $totalExistenciaPeriodico,
            'totalKgAll' => $totalKgAll,

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
                    // if (MateriaPrimaV::procesarArchivoExcelMateria($rutaDestino)) {
                    if (Pedido::procesarArchivoExcelpedidos($rutaDestino)) {
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

        // debuguear($totalCosto);


        // KRAFT
        $totalExistenciaK = MateriaPrimaV::sumarExistencia('CAJA-KRAFT');
       

        // BLANCO
        $totalExistenciaB = MateriaPrimaV::sumarExistencia('CAJA-BLANCO');
        $totalCostoB = MateriaPrimaV::sumarCosto('CAJA-BLANCO');

        // MEDIUM
        $totalExistenciaM = MateriaPrimaV::sumarExistencia('MEDIUM');
        $totalCostoM = MateriaPrimaV::sumarCosto('MEDIUM');

        // stock de corrugador
        $cajablanco = MateriaPrimaV::menosDeCien('DESC');

     


        // con deciamles
        $totalExistencia = number_format($totalExistencia, 2, '.', ',');
        $totalExistenciaK = number_format($totalExistenciaK, 2, '.', ',');
        $totalExistenciaB = number_format($totalExistenciaB, 2, '.', ',');
        $totalExistenciaM = number_format($totalExistenciaM, 2, '.', ',');
        $totalCosto = number_format($totalCosto, 2, '.', ',');
        $totalCostoB = number_format($totalCostoB, 2, '.', ',');
        $totalCostoM = number_format($totalCostoM, 2, '.', ',');

        $router->render('admin/produccion/materia/corrugador', [
            'titulo' => 'CORRUGADOR',
            'totalRegistros' => $totalRegistros,
            'totalExistencia' => $totalExistencia,
            'totalCosto' => $totalCosto,
            'totalExistenciaK' => $totalExistenciaK,
            'totalExistenciaB' => $totalExistenciaB,
            'totalCostoB' => $totalCostoB,
            'totalExistenciaM' => $totalExistenciaM,
            'totalCostoM' => $totalCostoM
        ]);
    }







    public static function apicorrugador (){
        // CORS
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    
        // Obtén los datos desde la consulta base
        // $corrugador = MateriaPrimaV::allc('ASC', 'CAJA');
        $corrugador = MateriaPrimaV::allcorrugador('ASC', ['CAJA', 'MEDIUM']);

        // Procesa los datos para agrupar por gramaje y ancho
        $agregados = [];
        foreach ($corrugador as $item) {
            $key = $item->gramaje . '-' . $item->ancho; // Llave única basada en gramaje y ancho
            if (!isset($agregados[$key])) {
                $agregados[$key] = $item; // Almacena el objeto original
                $agregados[$key]->existencia = intval($item->existencia); // Inicializa la existencia como entero
            } else {
                $agregados[$key]->existencia += intval($item->existencia); // Suma las existencias
            }
        }
    
        // Convierte el arreglo asociativo a un índice simple
        $resultadosFinales = array_values($agregados);
    
        // Devuelve los datos procesados como JSON
        echo json_encode($resultadosFinales);
        exit;
        
    }



    public static function apiAnchossobrantes(){
        
          // CORS
          header("Access-Control-Allow-Origin: *");
          header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
      
          // Obtén los datos desde la consulta base
          // $corrugador = MateriaPrimaV::allc('ASC', 'CAJA');
          $corrugador = MateriaPrimaV::allcorrugadorsobrante('ASC', ['CAJA', 'MEDIUM']);
  
          // Procesa los datos para agrupar por gramaje y ancho
          $agregados = [];
          foreach ($corrugador as $item) {
              $key = $item->gramaje . '-' . $item->ancho; // Llave única basada en gramaje y ancho
              if (!isset($agregados[$key])) {
                  $agregados[$key] = $item; // Almacena el objeto original
                  $agregados[$key]->existencia = intval($item->existencia); // Inicializa la existencia como entero
              } else {
                  $agregados[$key]->existencia += intval($item->existencia); // Suma las existencias
              }
          }
      
          // Convierte el arreglo asociativo a un índice simple
          $resultadosFinales = array_values($agregados);
      
          // Devuelve los datos procesados como JSON
          echo json_encode($resultadosFinales);
          exit;
    }
    

    public static function apicajacraft (){
        // CORS
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    
        // Obtén los datos desde la consulta base
        $corrugador = MateriaPrimaV::allc('ASC', 'CAJAS-KRAFT');
    
        // Procesa los datos para agrupar por gramaje y ancho
        $agregados = [];
        foreach ($corrugador as $item) {
            $key = $item->gramaje . '-' . $item->ancho; // Llave única basada en gramaje y ancho
            if (!isset($agregados[$key])) {
                $agregados[$key] = $item; // Almacena el objeto original
                $agregados[$key]->existencia = intval($item->existencia); // Inicializa la existencia como entero
            } else {
                $agregados[$key]->existencia += intval($item->existencia); // Suma las existencias
            }
        }
    
        // Convierte el arreglo asociativo a un índice simple
        $resultadosFinales = array_values($agregados);
    
        // Devuelve los datos procesados como JSON
        echo json_encode($resultadosFinales);
        exit;
        
    }


    public static function apicajablanco() {
        // CORS
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    
        // Obtén los datos desde la consulta base
        $corrugador = MateriaPrimaV::allc('ASC', 'CAJAS-BLANCO');

      
        // Procesa los datos para agrupar por gramaje y ancho
        $agregados = [];
        foreach ($corrugador as $item) {
            $key = $item->gramaje . '-' . $item->ancho; // Llave única basada en gramaje y ancho
            if (!isset($agregados[$key])) {
                $agregados[$key] = $item; // Almacena el objeto original
                $agregados[$key]->existencia = intval($item->existencia); // Inicializa la existencia como entero
            } else {
                $agregados[$key]->existencia += intval($item->existencia); // Suma las existencias
            }
        }
    
        // Convierte el arreglo asociativo a un índice simple
        $resultadosFinales = array_values($agregados);

        // debuguear($resultadosFinales);
    
        // Devuelve los datos procesados como JSON
        echo json_encode($resultadosFinales);
        exit;
    }
    
    public static function apicajamedium() {
        // CORS
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    
        // Obtén los datos desde la consulta base
        $corrugador = MateriaPrimaV::allc('ASC', 'MEDIUM');

      
        // Procesa los datos para agrupar por gramaje y ancho
        $agregados = [];
        foreach ($corrugador as $item) {
            $key = $item->gramaje . '-' . $item->ancho; // Llave única basada en gramaje y ancho
            if (!isset($agregados[$key])) {
                $agregados[$key] = $item; // Almacena el objeto original
                $agregados[$key]->existencia = intval($item->existencia); // Inicializa la existencia como entero
            } else {
                $agregados[$key]->existencia += intval($item->existencia); // Suma las existencias
            }
        }
    
        // Convierte el arreglo asociativo a un índice simple
        $resultadosFinales = array_values($agregados);

        // debuguear($resultadosFinales);
    
        // Devuelve los datos procesados como JSON
        echo json_encode($resultadosFinales);
        exit;
    }
    


// PENDIENTE DECIMALES IMPORTACIONES 
  public static function apicajakraftimport() {
    // CORS
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

    // Obtén los datos desde la consulta base
    $corrugador = Comercial::allcIMPORT('ASC', 'CAJAS-KRAFT');
// debuguear($corrugador);

    // debuguear($corrugador);
    
    // Procesa los datos para agrupar por gramaje y ancho
    $agregados = [];
    foreach ($corrugador as $item) {
        // Convierte la cantidad a float antes de hacer cualquier operación
        $cantidad = $item->cantidad; // Convierte de string a float

        $key = $item->gramaje . '-' . $item->ancho; // Llave única basada en gramaje y ancho
        if (!isset($agregados[$key])) {
            $agregados[$key] = $item; // Almacena el objeto original
            $agregados[$key]->cantidad = $cantidad; // Asigna la cantidad como float
        } else {
            $agregados[$key]->cantidad += $cantidad; // Suma las cantidades como float
        }
    }

    debuguear($agregados);

    // Convierte el arreglo asociativo a un índice simple
    $resultadosFinales = array_values($agregados);

    // Devuelve los datos procesados como JSON
    echo json_encode($resultadosFinales);
    exit;
}


    


    
    // public static function apicajablanco (){
    //     // cors
    //     header("Access-Control-Allow-Origin: *");
    //     header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    //     $corrugador = MateriaPrimaV::allc('ASC', 'MICRO');
    //      echo json_encode($corrugador);
    //      exit;
         
    // }








    public static function microcorrugador(Router $router)
    {
        $microcorrugador = MateriaPrimaV::allc('DESC', 'MICRO');
        // $totalCosto = MateriaPrimaV::sumarCosto('MICRO');
        // $totalRegistros = MateriaPrimaV::countByLinea('MICRO');
        $totalExistencia = MateriaPrimaV::sumarExistencia('MICRO');


        
        // con deciamles 
        $totalExistencia = number_format($totalExistencia, 2, '.', ',');
        
        $router->render('admin/produccion/materia/microcorrugador', [
            'titulo' => 'MICRO CORRUGADOR',
            'microcorrugador' => $microcorrugador,
     
            'totalExistencia' => $totalExistencia,
           
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
        $cajacraft = MateriaPrimaV::datoscompletos('DESC', 'CAJA-KRAFT');

        $totalCostoK = MateriaPrimaV::sumarCosto('CAJA-KRAFT');

        $totalExistenciaK = MateriaPrimaV::sumarExistenciaPorMes('CAJAS-KRAFT');

        $totalCostoK = number_format($totalCostoK, 2, '.', ',');
        $totalExistenciaK = number_format($totalExistenciaK, 2, '.', ',');

        
        
        // debuguear($cajacraft);
        $router->render('admin/produccion/materia/corrugador/cajacraft', [
            'titulo' => 'CAJA CRAFT',
            'cajacraft' => $cajacraft,
            'totalExistenciaK' => $totalExistenciaK

        ]);
    }


    public static function cajablanco(Router $router)
    {
        $cajablanco = MateriaPrimaV::datoscompletos('DESC', 'CAJA-BLANCO');

        $totalCostoB = MateriaPrimaV::sumarCosto('CAJA-BLANCO');

        $totalCostoB = number_format($totalCostoB, 2, '.', ',');
            $totalExistenciaB = MateriaPrimaV::sumarExistenciaPorMes('CAJAS-BLANCO');

        $totalExistenciaB = number_format($totalExistenciaB, 2, '.', ',');

        $router->render('admin/produccion/materia/corrugador/cajablanco', [
            'titulo' => 'CAJA BLANCO',
            'cajablanco' => $cajablanco,
            'totalCostoB' => $totalCostoB,
            'totalExistenciaB' => $totalExistenciaB
        ]);
    }


    public static function cajamedium(Router $router)
    {
        $cajamedium = MateriaPrimaV::datoscompletos('DESC', 'MEDIUM');

        $totalCostoM = MateriaPrimaV::sumarCosto('MEDIUM');

            $totalExistenciaM = MateriaPrimaV::sumarExistenciaPorMes('MEDIUM');

        $totalCostoM = number_format($totalCostoM, 2, '.', ',');
        $totalExistenciaM = number_format($totalExistenciaM, 2, '.', ',');

        $router->render('admin/produccion/materia/corrugador/cajamedium', [
            'titulo' => 'CAJA MEDIUM',
            'cajamedium' => $cajamedium,
            'totalCostoM' => $totalCostoM,
            'totalExistenciaM' => $totalExistenciaM
        ]);
    }

    // CAJAS KRAFT IMPORTACION

    public static function cajakraftimport(Router $router)
    {
        $totalExistenciaKI= Comercial::sumarExistenciaPorMesComercial('CAJAS-KRAFT');
        $totalExistenciaKI = number_format($totalExistenciaKI, 2, '.', ',');
        
        // debuguear($cajacraft);
        $router->render('admin/produccion/materia/corrugador/cajakraftimport', [
            'titulo' => 'CAJA kRAFT IMPORTACION',
            'totalExistenciaKI' => $totalExistenciaKI
            

        ]);
    }









    public static function apicorrugador2(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        
        $corru = MateriaPrimaV::allcc('DESC', 'CAJA');
        echo json_encode($corru);

    } 
    


    public static function eliminarTabla(Router $router) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar si el formulario ha enviado la confirmación
            if (isset($_POST['confirmar']) && $_POST['confirmar'] == 1) {
                // Instancia del modelo y llamada al método eliminarTabla
                $materiaModelo = new MateriaPrimaV();
                $resultado = $materiaModelo->eliminarTabla();
    
                // Redirigir o mostrar mensaje según el resultado
                if ($resultado) {
                    header('Location: /admin/produccion/registro_produccion');
                    exit;  // Detener la ejecución después de la redirección
                } else {
                    echo "Error al eliminar la tabla.";
                }
            } else {
                echo "Acción no confirmada.";
            }
        }
    }




    public static function apimateriaprimajson(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        
        $materiaprimajson = MateriaPrimaV::all('ASC');
        // $materiaprimajson = MateriaPrimaV::allcorrugador('ASC', ['CAJA', 'MEDIUM']);

        echo json_encode($materiaprimajson);
    }




    // NUEVAS VENTANAS PARA SIMULAR EL CORRUGADOR

    public static function corrugadorVentana(Router $router){

        session_start();

    //     $totalExistencia = MateriaPrimaV::sumarExistenciaPorMes('CAJA-KRAFT');
    //     // debuguear($totalExistencia);
      
    //   $totalExistenciaMedium = MateriaPrimaV::sumarExistenciaPorMes('MEDIUM');      
    // //   debuguear($totalExistenciaMedium);
      
        // $totalExistencia = $totalExistencia + $totalExistenciaMedium;

        // debuguear($totalExistencia);

         // KRAFT
         $totalExistenciaK = MateriaPrimaV::sumarExistenciaPorMes('CAJAS-KRAFT');
       

         // BLANCO
         $totalExistenciaB = MateriaPrimaV::sumarExistenciaPorMes('CAJAS-BLANCO');
    
 
         // MEDIUM
         $totalExistenciaM = MateriaPrimaV::sumarExistenciaPorMes('MEDIUM');


         $totalExistencia = $totalExistenciaK + $totalExistenciaB + $totalExistenciaM;


        //  debuguear($totalExistenciaK);



        $totalExistenciaKI= Comercial::sumarExistenciaPorMesComercial('CAJAS-KRAFT');
        $totalExistenciaBI= Comercial::sumarExistenciaPorMesComercial('CAJAS-BLANCO');
        $totalExistenciaMI= Comercial::sumarExistenciaPorMesComercial('MEDIUM');

        // debuguear($totalExistenciaBI);


        $totalExistenciasComercial= $totalExistenciaKI + $totalExistenciaBI + $totalExistenciaMI;
        $totalExistenciasComercial = number_format($totalExistenciasComercial, 3, '.', ',');

        // debuguear($totalExistenciasComercial);
         

        
        // // $totalExistenciaBI = number_format($totalExistenciaBI, 0, '.', ',');
        // $totalExistenciaMI = number_format($totalExistenciaMI, 0, '.', ',');

   
        $totalExistencia = number_format($totalExistencia, 0, '.', ',');
        $totalExistenciaK = number_format($totalExistenciaK, 0, '.', ',');
        $totalExistenciaB = number_format($totalExistenciaB, 0, '.', ',');
        $totalExistenciaM = number_format($totalExistenciaM, 0, '.', ',');
    


    //   $allkilos = MateriaPrimaV::allkilogramos('DESC');




        $router->render('admin/produccion/materia/corrugadorVentana', [
            'titulo' => 'INVENTARIO DEL CORRUGADOR',
            'totalExistencia' => $totalExistencia,
            'totalExistenciaK' => $totalExistenciaK,
            'totalExistenciaB' => $totalExistenciaB,
            'totalExistenciaM' => $totalExistenciaM,
            'totalExistenciaKI' => $totalExistenciaKI,
            'totalExistenciaBI' => $totalExistenciaBI,
            'totalExistenciaMI' => $totalExistenciaMI,
            'totalExistenciasComercial' => $totalExistenciasComercial

        ]);

    }


// excel de proyecciones 

    public static function excelNuevo(Router $router)
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
                    $rutaDestino = __DIR__ . "/../proyecciones/$nombreArchivo";
                    move_uploaded_file($tempArchivo, $rutaDestino);
                    echo 'Archivo subido correctamente';

                    // Llamar al método de Producto para procesar el archivo
                    if (Proyecciones::procesarArchivoExcelProyecciones($rutaDestino)) {
                        // header('Location: /admin/produccion/materia/crear');
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


        $router->render('admin/produccion/materia/excelNuevo', [
            'titulo' => 'SUBIR EXCEL',
            'alertas' => $alertas
        ]);
    }


    public static function apiproyecciones(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        
        $proyecciones = Proyecciones::all('ASC');
        // $materiaprimajson = MateriaPrimaV::allcorrugador('ASC', ['CAJA', 'MEDIUM']);

        echo json_encode($proyecciones);

    }




    
    



}