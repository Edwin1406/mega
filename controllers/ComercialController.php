<?php 

namespace Controllers;

use Model\Area;
use MVC\Router;
use Model\Comercial;
use Classes\Paginacion;
use GuzzleHttp\Psr7\Header;
use Model\Datareclamos;
use Model\Quejas;
use Model\Ubicaciones;

class ComercialController {

    public static function crear(Router $router)
    {
       
        $alertas = [];

        $clientes = Datareclamos::clientesUnicos();
        // debuguear($clientes);




        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            

        }


        $router->render('admin/comercial/crear', [
            'titulo' => 'GENERAR ORDEN DE COMPRA',
            'alertas' => $alertas,
            'clientes' => $clientes
        ]);
    }





    


    public static function tabla(Router $router)
    {
        $id = $_GET['id'] ?? null;
        if ($id == 1) {
            Comercial::setAlerta('exito', 'El Cliente se guardo correctamente');
        }

        $pagina_actual = $_GET['page'] ?? 1;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual|| $pagina_actual < 1) {
            header('Location: /admin/comercial/tabla?page=1');
        }

         // Obtener el número de registros por página
         $registros_por_pagina = $_GET['per_page'] ?? 10;
         if ($registros_por_pagina === 'all') {
             $total = Comercial::total();
             $registros_por_pagina = $total; // Mostrar todos los registros
         } else {
             $registros_por_pagina = filter_var($registros_por_pagina, FILTER_VALIDATE_INT) ?: 10;
         }

         $total = Comercial::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/comercial/tabla?page=1');
            exit;
        }
    
        $comercial = Comercial::paginar($registros_por_pagina, $paginacion->offset());
    


        $router->render('admin/comercial/tabla', [
            'titulo' => 'ORDENES DE COMPRA',
            'comercial' => $comercial,
            'paginacion' => $paginacion->paginacion()
        ]);
    }



    public static function editar(Router $router)
    {
        $alertas = [];
            $id = $_GET['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            // validar que el id sea un entero
            if (!$id) {
                header('Location: /admin/comercial/tabla');
            }
            $comercial = Comercial::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comercial->sincronizar($_POST);
            $alertas = $comercial->validar();
            if (empty($alertas)) {
                $comercial->actualizar();
                $alertas = $comercial->getAlertas();
                header('Location: /admin/comercial/tabla?id='.$id);
            }
        }
        $router->render('admin/comercial/editar', [
            'titulo' => 'EDITAR ORDEN DE COMPRA',
            'comercial' => $comercial,
            'alertas' => $alertas
        ]);
    }



    //SUBIR EXCEL DE ORDENES DE COMPRA
    
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
                    $rutaDestino = __DIR__ . "/../compras/$nombreArchivo";
                    move_uploaded_file($tempArchivo, $rutaDestino);
                    echo 'Archivo subido correctamente';
                 
                    // Llamar al método de Producto para procesar el archivo
                    if (Comercial::procesarArchivoExcelComercial($rutaDestino)) {
                        header('Location: /admin/comercial/crear');
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


        $router->render('admin/comercial/excel', [
            'titulo' => 'SUBIR EXCEL',
            'alertas' => $alertas
        ]);
    }

    public static function apicomercial(Router $router)
    {
        $comercial = Comercial::all('ASC');

        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        Header('Access-Control-Allow-Methods: GET');

        // // convertir  ancho mm a m 
        // $convertir = array_map(function($comercial){
        //     $comercial->ancho = $comercial->ancho / 1000;
        //     return $comercial;
        // }, $comercial);
        echo json_encode($comercial);
    }








}










?> 