<?php

namespace Controllers;

use MVC\Router;
use Model\Bobina;
use Classes\Paginacion;
use Model\Computadora;
use Model\Convertidor;
use Model\Corte_ceja;
use Model\Desflexografica;
use Model\Doblado;
use Model\Guillotina_lamina;
use Model\Micro;
use Model\Preprinter;
use Model\Troquel;

class PapelController
{
   
//     public static function tabla(Router $router)
//     {

//            // PAGINACION DE MAQUINAS

// $total = Bobina::sumarColumna('SINGLEFACE');

// // debuguear($total);

//            $pagina_actual = $_GET['page'];
//            $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
//            // debuguear($pagina_actual);

//            if(!$pagina_actual|| $pagina_actual <1){
//                header('Location: /admin/produccion/papel/tabla?page=1');
//                exit;
//            }
           
//            $pagina_por_registros = 10;
//            $total = Bobina:: total();
//            $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);
//            if($paginacion->total_paginas() < $pagina_actual){
//                header('Location: /admin/produccion/papel/tabla?page=1');
//            }
       
//            $bobinas = Bobina::paginar($pagina_por_registros, $paginacion->offset());

//         // debuguear($papel);
//         $router->render('admin/produccion/papel/tabla', [
//             'titulo' => 'TABLA DE PAPEL',
//             'bobinas' => $bobinas,
//             'paginacion' => $paginacion->paginacion(),
//             'totales' => Bobina::sumarColumna('SINGLEFACE'),
//             'totales2' => Bobina::sumarColumna('EMPALME'),
//             'totales3' => Bobina::sumarColumna('RECUB'),
//             'totales4' => Bobina::sumarColumna('MECANICO'),
//             'totales5' => Bobina::sumarColumna('GALLET'),
//             'totales6' => Bobina::sumarColumna('HUMEDO'),
//             'totales7' => Bobina::sumarColumna('COMBADO'),
//             'totales8' => Bobina::sumarColumna('DESPE'),
//             'totales9' => Bobina::sumarColumna('ERROM'),
//             'totales10' => Bobina::sumarColumna('DESHOJE'),
//             'totales11' => Bobina::sumarColumna('CAMBIO_PEDIDO'),
//             'totales12' => Bobina::sumarColumna('FILOS_ROTOS'),
//             'totales13' => Bobina::sumarColumna('OTROS'),
//             'totales14' => Bobina::sumarColumna('PEDIDOS_CORTOS'),
//             'totales15' => Bobina::sumarColumna('DIFER_ANCHO'),
//             'totales16' => Bobina::sumarColumna('CAMBIO_GRAMAJE'),
//             'totales17' => Bobina::sumarColumna('EXTRA_TRIM'),
//             'totales18' => Bobina::sumarColumna('CONSUMO'),
//             'totales19' => Bobina::sumarColumna('TOTAL'),
//             'totales20' => Bobina::sumarColumna('PORCENTAJE'),
            
//         ]);
//     }


public static function tabla(Router $router)
{
    $pagina_actual = $_GET['page'];
    $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

    if (!$pagina_actual || $pagina_actual < 1) {
        header('Location: /admin/produccion/papel/tabla?page=1');
        exit;
    }

    $pagina_por_registros = 10;
    $total = Bobina::total();
    $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);

    if ($paginacion->total_paginas() < $pagina_actual) {
        header('Location: /admin/produccion/papel/tabla?page=1');
        exit;
    }

    $bobinas = Bobina::paginar($pagina_por_registros, $paginacion->offset());
    $totales = Bobina::sumarTodasLasColumnas();

    $router->render('admin/produccion/papel/tabla', [
        'titulo' => 'TABLA DE PAPEL',
        'bobinas' => $bobinas,
        'paginacion' => $paginacion->paginacion(),
        'totales' => $totales
    ]);
}






    // public static function crear(Router $router)
    // {
    //     $alertas = [];
    //     $papel = new Bobina;
    //     if($_SERVER['REQUEST_METHOD'] === 'POST'){

      

            
    //         $papel->sincronizar($_POST);
    //         $papel->tipo_clasificacion = $_POST['tipo_clasificacion'] ?? '';

    //         //sumar los totales pero dependiendo de la clasificacion si es controlable solo se suman algunas columnas
    //    $papel->TOTAL =  
    //     floatval($papel->SINGLEFACE) +
    //     floatval($papel->EMPALME) +
    //     floatval($papel->RECUB) +
    //     floatval($papel->MECANICO) +
    //     floatval($papel->GALLET) +
    //     floatval($papel->HUMEDO) +
    //     floatval($papel->COMBADO) +
    //     floatval($papel->DESPE) +
    //     floatval($papel->ERROM) +
    //     floatval($papel->DESHOJE) +
    //     floatval($papel->CAMBIO_PEDIDO) +
    //     floatval($papel->FILOS_ROTOS) +
    //     floatval($papel->OTROS) +
    //     floatval($papel->PEDIDOS_CORTOS) +
    //     floatval($papel->DIFER_ANCHO) +
    //     floatval($papel->CAMBIO_GRAMAJE) +
    //     floatval($papel->EXTRA_TRIM);

    //         // Calcula el porcentaje



    //         // debuguear($papel);

        
    //         // validar
    //         $alertas = $papel->validar();
    //         if(empty($alertas)){
    //             // guardar en la base de datos
    //             $papel->guardar();
    //             header('Location: /admin/produccion/papel/tabla');
    //         }

    //     }   

    //     $router->render('admin/produccion/papel/crear', [
    //         'titulo' => 'CREAR PAPEL',
    //         'alertas' => $alertas
    //     ]);
    // }



public static function crear(Router $router)
{
    $alertas = [];
    $modelo = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tipo_maquina = $_POST['tipo_maquina'] ?? '';

        // Seleccionar el modelo según el tipo de máquina
        switch (strtoupper($tipo_maquina)) {
            case 'CORRUGADOR':
                $modelo = new Bobina;
                break;

            case 'MICRO':
                $modelo = new Micro;
                break;
            
            case 'FLEXOGRAFICA':
                $modelo = new Desflexografica;
                break;

            case 'PREPRINTER':
                $modelo = new Preprinter;
                break;
            
            case 'DOBLADO':
                $modelo = new Doblado;
                break;

            case 'CORTE CEJA':
                $modelo = new Corte_ceja;
                break;

            case 'TROQUEL':
                $modelo = new Troquel;
                break;

            case 'CONVERTIDOR':
                $modelo = new Convertidor;
                break;

            case 'GUILLOTINA LAMINA':
                $modelo = new Guillotina_lamina;
                break;

            // Puedes seguir agregando más tipos si es necesario
            default:
                $alertas['error'][] = 'Tipo de máquina no reconocido.';
                $modelo = null;
        }

        if ($modelo) {
            $modelo->sincronizar($_POST);
            $modelo->tipo_clasificacion = $_POST['tipo_clasificacion'] ?? '';

            // Cálculo de total (puedes mover esto dentro del modelo si prefieres)

            $modelo->calcularTotal();
            
            // Validar
            $alertas = $modelo->validar();

            if (empty($alertas)) {
                $modelo->guardar();
                header('Location: /admin/produccion/papel/tabla');
                exit;
            }
        }
    }

    $router->render('admin/produccion/papel/crear', [
        'titulo' => 'CREAR PAPEL',
        'alertas' => $alertas
    ]);
}





    public static function editar(Router $router)
        {
            $alertas = [];
            $id = $_GET['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            // validar que el id sea un entero
            if (!$id) {
                header('Location: /admin/produccion/papel/tabla');
            }
            $papel = Bobina::find($id);

            if (!$papel) {
                header('Location: /admin/produccion/papel/tabla');
            }

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $papel->sincronizar($_POST);
                // debuguear($papel);

                $papel->PORCENTAJE=($papel->TOTAL* $papel->CONSUMO) / 100; 
          

// Para verificar
// debuguear($papel);


                // debuguear($papel->TOTAL);
                
            //  debuguear($papel);
                $alertas = $papel->validar();
                if(empty($alertas)){
                    $papel->actualizar();
                    header('Location: /admin/produccion/papel/tabla');
                }

            }
            $router->render('admin/produccion/papel/editar', [
                'titulo' => 'EDITAR MAQUINA',
                'alertas' => $alertas,
                'papel' => $papel
                
            ]);

            
        }

        public static function eliminar()
        {
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);
                $papel = Bobina::find($id);

                // debuguear($maquina);
                if(!isset($papel)){
                    header('Location: /admin/produccion/papel/tabla');
                }
                $resultado=$papel->eliminar();
                if($resultado){
                    header('Location: /admin/produccion/papel/tabla');
                }

            }
               
        }



        public static function apidesperdiciopapel(){
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
            $papel = Bobina::all();
            echo json_encode($papel);

            // $papel = Computadora::all();
            // echo json_encode($papel);




        }


        public static function graficos(Router $router)
        {
            
            
            $router->render('admin/produccion/papel/graficos', [
                'titulo' => 'GRAFICOS',
            ]);


        }









}