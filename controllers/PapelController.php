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
use Model\Empaque;
use Model\Guillotina_lamina;
use Model\Guillotina_papel;
use Model\Micro;
use Model\Preprinter;
use Model\Troquel;
use PhpOffice\PhpSpreadsheet\Calculation\Token\Stack;

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

        $router->render('admin/produccion/papel/tablas/tabla', [
            'titulo' => 'TABLA DESPERDICIO CORRUGADOR',
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

    // public static function crear(Router $router)
    // {
    //     $alertas = [];
    //     $id_orden = $_GET['id_orden'] ?? null;  // Obtiene el id_orden de la URL si está presente

    //     // recueprar galleteado



    // $desperdicio_corrugador = Bobina::find_orden($id_orden);
    // $orden=$desperdicio_corrugador['GALLET'] = $desperdicio_corrugador['GALLET'] ?? 0;
    // // $desperdicio_corrugador['SINGLEFACE'] = $desperdicio_corrugador['SINGLEFACE'] ?? 0;



    //     // debuguear($desperdicio_corrugador);





    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $id_orden = $_POST['id_orden'] ?? '';  


    //         $tipo_maquina = $_POST['tipo_maquina'] ?? '';

    //         // Seleccionar el modelo según el tipo de máquina
    //         switch (strtoupper($tipo_maquina)) {
    //             case 'CORRUGADOR':
    //                 $modelo = new Bobina;
    //                 $modelo->generarIdUnico();
    //                 // id_orden 
    //                 debuguear($modelo);
    //                 $redireccion = '/admin/produccion/papel/tabla';
    //                 break;

    //             case 'MICRO':
    //                 $modelo = new Micro;
    //                 $redireccion = '/admin/produccion/papel/tabla_micro';
    //                 break;

    //             case 'FLEXOGRAFICA':
    //                 $modelo = new Desflexografica;
    //                 $modelo->id_orden = $id_orden;
    //                 // debuguear($modelo);

    //                 $redireccion = '/admin/produccion/papel/tabla_flexografica';
    //                 break;

    //             case 'PREPRINTER':
    //                 $modelo = new Preprinter;
    //                 $redireccion = '/admin/produccion/papel/tabla_preprinter';
    //                 break;

    //             case 'DOBLADO':
    //                 $modelo = new Doblado;
    //                 $redireccion = '/admin/produccion/papel/tabla_doblado';
    //                 break;

    //             case 'CORTE CEJA':
    //                 $modelo = new Corte_ceja;
    //                 $redireccion = '/admin/produccion/papel/tabla_corte_ceja';
    //                 break;

    //             case 'TROQUEL':
    //                 $modelo = new Troquel;
    //                 $redireccion = '/admin/produccion/papel/tabla_troquel';
    //                 break;

    //             case 'CONVERTIDOR':
    //                 $modelo = new Convertidor;
    //                 $redireccion = '/admin/produccion/papel/tabla_convertidor';
    //                 break;

    //             case 'GUILLOTINA LAMINA':
    //                 $modelo = new Guillotina_lamina;
    //                 $redireccion = '/admin/produccion/papel/tabla_guillotina_lamina';
    //                 break;

    //             case 'GUILLOTINA PAPEL':
    //                 $modelo = new Guillotina_papel;
    //                 $redireccion = '/admin/produccion/papel/tabla_guillotina_papel';
    //                 break;

    //             case 'EMPAQUE':
    //                 $modelo = new Empaque;
    //                 $redireccion = '/admin/produccion/papel/tabla_empaque';
    //                 break;

    //             default:
    //                 $alertas['error'][] = 'Tipo de máquina no reconocido.';
    //                 $modelo = null;
    //                 $redireccion = null;
    //         }

    //         if ($modelo) {
    //             $modelo->sincronizar($_POST);
    //             $modelo->tipo_clasificacion = $_POST['tipo_clasificacion'] ?? '';
    //             $modelo->calcularTotal();
    //             $alertas = $modelo->validar();

    //             if (empty($alertas)) {
    //                 $modelo->guardar();
    //                 if ($redireccion) {
    //                     header('Location: ' . $redireccion);
    //                     exit;
    //                 }
    //             }
    //         }
    //     }
    //     $router->render('admin/produccion/papel/crear', [
    //         'titulo' => 'CREAR PAPEL',
    //         'alertas' => $alertas,
    //         'orden' => $orden,
    //         'id_orden' => $id_orden,

    //     ]);
    // }


    public static function crear(Router $router)
    {
        $alertas = [];
        $modelo = null;
        $id_orden = $_POST['id_orden'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $tipo_maquina = $_POST['tipo_maquina'] ?? '';

            // Seleccionar el modelo según el tipo de máquina
            switch (strtoupper($tipo_maquina)) {
                case 'CORRUGADOR':
                    $modelo = new Bobina;

                    // Sincronizar primero los datos del POST
                    $modelo->sincronizar($_POST);
                    $GALLET = $_POST['GALLET'] ?? 0;
                    if (empty($modelo->id_orden)) {
                        $modelo->id_orden = $modelo->generarIdUnico();
                    }

                    $redireccion = '/admin/produccion/papel/tabla';
                    break;

                case 'MICRO':
                    $modelo = new Micro;
                    $modelo->sincronizar($_POST);
                    if (empty($modelo->id_orden)) {
                        $modelo->id_orden = $modelo->generarIdUnico();
                    }
                    $redireccion = '/admin/produccion/papel/tabla_micro';
                    break;

                case 'FLEXOGRAFICA':
                    $modelo = new Desflexografica;
                    $modelo->sincronizar($_POST);

                    // Generar ID único solo si no se proporcionó uno en el formulario
                    if (empty($modelo->id_orden)) {
                        $modelo->id_orden = $modelo->generarIdUnico();
                    }
                    $redireccion = '/admin/produccion/papel/tabla_flexografica';
                    break;

                case 'PREPRINTER':
                    $modelo = new Preprinter;
                    $modelo->sincronizar($_POST);

                    // Generar ID único solo si no se proporcionó uno en el formulario
                    if (empty($modelo->id_orden)) {
                        $modelo->id_orden = $modelo->generarIdUnico();
                    }
                    $redireccion = '/admin/produccion/papel/tabla_preprinter';
                    break;

                case 'DOBLADO':
                    $modelo = new Doblado;
                    $modelo->sincronizar($_POST);

                    // Generar ID único solo si no se proporcionó uno en el formulario
                    if (empty($modelo->id_orden)) {
                        $modelo->id_orden = $modelo->generarIdUnico();
                    }
                    $redireccion = '/admin/produccion/papel/tabla_doblado';
                    break;

                case 'CORTE CEJA':
                    $modelo = new Corte_ceja;
                    $modelo->sincronizar($_POST);

                    // Generar ID único solo si no se proporcionó uno en el formulario
                    if (empty($modelo->id_orden)) {
                        $modelo->id_orden = $modelo->generarIdUnico();
                    }
                    $redireccion = '/admin/produccion/papel/tabla_corte_ceja';
                    break;

                case 'TROQUEL':
                    $modelo = new Troquel;
                    $modelo->sincronizar($_POST);

                    // Generar ID único solo si no se proporcionó uno en el formulario
                    if (empty($modelo->id_orden)) {
                        $modelo->id_orden = $modelo->generarIdUnico();
                    }
                    $redireccion = '/admin/produccion/papel/tabla_troquel';
                    break;

                case 'CONVERTIDOR':
                    $modelo = new Convertidor;
                    $modelo->sincronizar($_POST);

                    // Generar ID único solo si no se proporcionó uno en el formulario
                    if (empty($modelo->id_orden)) {
                        $modelo->id_orden = $modelo->generarIdUnico();
                    }
                    $redireccion = '/admin/produccion/papel/tabla_convertidor';
                    break;

                case 'GUILLOTINA LAMINA':
                    $modelo = new Guillotina_lamina;
                    $modelo->sincronizar($_POST);

                    // Generar ID único solo si no se proporcionó uno en el formulario
                    if (empty($modelo->id_orden)) {
                        $modelo->id_orden = $modelo->generarIdUnico();
                    }
                    $redireccion = '/admin/produccion/papel/tabla_guillotina_lamina';
                    break;

                case 'GUILLOTINA PAPEL':
                    $modelo = new Guillotina_papel;
                    $modelo->sincronizar($_POST);

                    // Generar ID único solo si no se proporcionó uno en el formulario
                    if (empty($modelo->id_orden)) {
                        $modelo->id_orden = $modelo->generarIdUnico();
                    }
                    $redireccion = '/admin/produccion/papel/tabla_guillotina_papel';
                    break;

                case 'EMPAQUE':
                    $modelo = new Empaque;
                    $modelo->sincronizar($_POST);

                    // Generar ID único solo si no se proporcionó uno en el formulario
                    if (empty($modelo->id_orden)) {
                        $modelo->id_orden = $modelo->generarIdUnico();
                    }
                    $redireccion = '/admin/produccion/papel/tabla_empaque';
                    break;

                default:
                    $alertas['error'][] = 'Tipo de máquina no reconocido.';
                    $modelo = null;
                    $redireccion = null;
            }

            if ($modelo) {
                // Asegurar que tipo_clasificacion también se asigna
                $modelo->tipo_clasificacion = $_POST['tipo_clasificacion'] ?? '';

                // Calcular total antes de guardar
                $modelo->calcularTotal();

                // Validar datos
                $alertas = $modelo->validar();

                if (empty($alertas)) {
                    $modelo->guardar();
                    if ($redireccion) {
                        header('Location: ' . $redireccion);
                        exit;
                    }
                }
            }
        }

        // Renderizar vista
        $router->render('admin/produccion/papel/crear', [
            'titulo' => 'CREAR PAPEL',
            'alertas' => $alertas,
            'orden' => $modelo,
            'id_orden' => $id_orden,
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

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $papel->sincronizar($_POST);
            // debuguear($papel);

            $papel->PORCENTAJE = ($papel->TOTAL * $papel->CONSUMO) / 100;


            // Para verificar
            // debuguear($papel);


            // debuguear($papel->TOTAL);

            //  debuguear($papel);
            $alertas = $papel->validar();
            if (empty($alertas)) {
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            $papel = Bobina::find($id);

            // debuguear($maquina);
            if (!isset($papel)) {
                header('Location: /admin/produccion/papel/tabla');
            }
            $resultado = $papel->eliminar();
            if ($resultado) {
                header('Location: /admin/produccion/papel/tabla');
            }
        }
    }



    public static function apidesperdiciopapel()
    {
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







    public static function tabla_convertidor(Router $router)
    {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/produccion/papel/tabla_convertidor?page=1');
            exit;
        }

        $pagina_por_registros = 10;
        $total = Convertidor::total();
        $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/produccion/papel/tabla_convertidor?page=1');
            exit;
        }

        $bobinas = Convertidor::paginar($pagina_por_registros, $paginacion->offset());
        $totales = Convertidor::sumarTodasLasColumnas();

        $router->render('admin/produccion/papel/tablas/tabla_convertidor', [
            'titulo' => 'TABLA DESPERDICIO CONVERTIDOR',
            'bobinas' => $bobinas,
            'paginacion' => $paginacion->paginacion(),
            'totales' => $totales
        ]);
    }

    public static function tabla_corte_ceja(Router $router)
    {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/produccion/papel/tabla_corte_ceja?page=1');
            exit;
        }

        $pagina_por_registros = 10;
        $total = Corte_ceja::total();
        $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/produccion/papel/tabla_corte_ceja?page=1');
            exit;
        }

        $bobinas = Corte_ceja::paginar($pagina_por_registros, $paginacion->offset());
        $totales = Corte_ceja::sumarTodasLasColumnas();

        $router->render('admin/produccion/papel/tablas/tabla_corte_ceja', [
            'titulo' => 'TABLA DESPERDICIO CORTE CEJA',
            'bobinas' => $bobinas,
            'paginacion' => $paginacion->paginacion(),
            'totales' => $totales
        ]);
    }

    public static function tabla_doblado(Router $router)
    {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/produccion/papel/tabla_doblado?page=1');
            exit;
        }

        $pagina_por_registros = 10;
        $total = Doblado::total();
        $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/produccion/papel/tabla_doblado?page=1');
            exit;
        }

        $bobinas = Doblado::paginar($pagina_por_registros, $paginacion->offset());
        $totales = Doblado::sumarTodasLasColumnas();

        $router->render('admin/produccion/papel/tablas/tabla_doblado', [
            'titulo' => 'TABLA DESPERDICIO DOBLADO',
            'bobinas' => $bobinas,
            'paginacion' => $paginacion->paginacion(),
            'totales' => $totales
        ]);
    }


    public static function tabla_flexografica(Router $router)
    {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/produccion/papel/tabla_flexografica?page=1');
            exit;
        }

        $pagina_por_registros = 10;
        $total = Desflexografica::total();
        $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/produccion/papel/tabla_flexografica?page=1');
            exit;
        }

        $bobinas = Desflexografica::paginar($pagina_por_registros, $paginacion->offset());
        $totales = Desflexografica::sumarTodasLasColumnas();

        $router->render('admin/produccion/papel/tablas/tabla_flexografica', [
            'titulo' => 'TABLA DESPERDICIO FLEXOGRAFICA',
            'bobinas' => $bobinas,
            'paginacion' => $paginacion->paginacion(),
            'totales' => $totales
        ]);
    }

    public static function tabla_guillotina_lamina(Router $router)
    {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/produccion/papel/tabla_guillotina_lamina?page=1');
            exit;
        }

        $pagina_por_registros = 10;
        $total = Guillotina_lamina::total();
        $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/produccion/papel/tabla_guillotina_lamina?page=1');
            exit;
        }

        $bobinas = Guillotina_lamina::paginar($pagina_por_registros, $paginacion->offset());
        $totales = Guillotina_lamina::sumarTodasLasColumnas();

        $router->render('admin/produccion/papel/tablas/tabla_guillotina_lamina', [
            'titulo' => 'TABLA DESPERDICIO GUILLOTINA LAMINA',
            'bobinas' => $bobinas,
            'paginacion' => $paginacion->paginacion(),
            'totales' => $totales
        ]);
    }

    public static function tabla_guillotina_papel(Router $router)
    {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/produccion/papel/tabla_guillotina_papel?page=1');
            exit;
        }

        $pagina_por_registros = 10;
        $total = Guillotina_papel::total();
        $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/produccion/papel/tabla_guillotina_papel?page=1');
            exit;
        }

        $bobinas = Guillotina_papel::paginar($pagina_por_registros, $paginacion->offset());
        $totales = Guillotina_papel::sumarTodasLasColumnas();

        $router->render('admin/produccion/papel/tablas/tabla_guillotina_papel', [
            'titulo' => 'TABLA DESPERDICIO GUILLOTINA PAPEL',
            'bobinas' => $bobinas,
            'paginacion' => $paginacion->paginacion(),
            'totales' => $totales
        ]);
    }


    public static function tabla_empaque(Router $router)
    {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/produccion/papel/tabla_empaque?page=1');
            exit;
        }

        $pagina_por_registros = 10;
        $total = Empaque::total();
        $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/produccion/papel/tabla_empaque?page=1');
            exit;
        }

        $bobinas = Empaque::paginar($pagina_por_registros, $paginacion->offset());
        $totales = Empaque::sumarTodasLasColumnas();

        $router->render('admin/produccion/papel/tablas/tabla_empaque', [
            'titulo' => 'TABLA DESPERDICIO EMPAQUE',
            'bobinas' => $bobinas,
            'paginacion' => $paginacion->paginacion(),
            'totales' => $totales
        ]);
    }


    public static function tabla_micro(Router $router)
    {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/produccion/papel/tabla_micro?page=1');
            exit;
        }

        $pagina_por_registros = 10;
        $total = Micro::total();
        $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/produccion/papel/tabla_micro?page=1');
            exit;
        }

        $bobinas = Micro::paginar($pagina_por_registros, $paginacion->offset());
        $totales = Micro::sumarTodasLasColumnas();

        $router->render('admin/produccion/papel/tablas/tabla_micro', [
            'titulo' => 'TABLA DESPERDICIO MICRO',
            'bobinas' => $bobinas,
            'paginacion' => $paginacion->paginacion(),
            'totales' => $totales
        ]);
    }


    public static function tabla_troquel(Router $router)
    {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/produccion/papel/tabla_troquel?page=1');
            exit;
        }

        $pagina_por_registros = 10;
        $total = Troquel::total();
        $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/produccion/papel/tabla_troquel?page=1');
            exit;
        }

        $bobinas = Troquel::paginar($pagina_por_registros, $paginacion->offset());
        $totales = Troquel::sumarTodasLasColumnas();

        $router->render('admin/produccion/papel/tablas/tabla_troquel', [
            'titulo' => 'TABLA DESPERDICIO TROQUEL',
            'bobinas' => $bobinas,
            'paginacion' => $paginacion->paginacion(),
            'totales' => $totales
        ]);
    }
    public static function tabla_preprinter(Router $router)
    {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/produccion/papel/tabla_preprinter?page=1');
            exit;
        }

        $pagina_por_registros = 10;
        $total = Preprinter::total();
        $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/produccion/papel/tabla_preprinter?page=1');
            exit;
        }

        $bobinas = Preprinter::paginar($pagina_por_registros, $paginacion->offset());
        $totales = Preprinter::sumarTodasLasColumnas();

        $router->render('admin/produccion/papel/tablas/tabla_preprinter', [
            'titulo' => 'TABLA DESPERDICIO PREPRINTER',
            'bobinas' => $bobinas,
            'paginacion' => $paginacion->paginacion(),
            'totales' => $totales
        ]);
    }






    // EDITAR CONVERTIDOR 
    public static function editar_convertidor(Router $router)
    {
        $alertas = [];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/produccion/papel/tabla_convertidor');
            exit;
        }

        $convertidor = Convertidor::find($id);

        if (!$convertidor) {
            header('Location: /admin/produccion/papel/tabla_convertidor');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $convertidor->sincronizar($_POST);
            $convertidor->PORCENTAJE = ($convertidor->TOTAL * $convertidor->CONSUMO) / 100;

            $alertas = $convertidor->validar();
            if (empty($alertas)) {
                $convertidor->actualizar();
                header('Location: /admin/produccion/papel/tabla_convertidor');
                exit;
            }
        }

        $router->render('admin/produccion/papel/editar/editar_convertidor', [
            'titulo' => 'EDITAR CONVERTIDOR',
            'alertas' => $alertas,
            'convertidor' => $convertidor
        ]);
    }

public static function ingresoConsumo(Router $router) {
    $alertas = [];
    $id_orden = $_POST['id_orden'] ?? null;
    $resultados = [];

    if ($id_orden) {
        $modelos = [
            'Bobina' => Bobina::class,
            'Micro' => Micro::class,
            'Desflexografica' => Desflexografica::class,
            'Preprinter' => Preprinter::class,
            'Doblado' => Doblado::class,
            'Corte_ceja' => Corte_ceja::class,
            'Troquel' => Troquel::class,
            'Convertidor' => Convertidor::class,
            'Guillotina_lamina' => Guillotina_lamina::class,
            'Guillotina_papel' => Guillotina_papel::class,
            'Empaque' => Empaque::class
        ];

        foreach ($modelos as $nombre => $modeloClase) {
            $registros = $modeloClase::find_orden($id_orden);
            if (!empty($registros)) {
                $resultados[$nombre] = $registros;
            }
        }
    }

    $router->render('admin/produccion/papel/ingresoConsumo', [
        'titulo' => 'INGRESO CONSUMO',
        'alertas' => $alertas,
        'resultados' => $resultados,
        'id_orden' => $id_orden
    ]);
}
















}
