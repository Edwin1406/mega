<?php 
namespace Controllers;

use MVC\Router;
use Model\Cliente;
use Classes\Paginacion;
use Model\Area;

class ClienteController
{
    // public static function cotizador(Router $router)
    // {
    //     $id= $_GET['id'] ?? null;
    //     if($id==1) {
    //         Cliente::setAlerta('exito', 'El Cliente se guardo correctamente');
    //     }


    //     $pagina_actual = $_GET['page'];
    //     $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
    //     // debuguear($pagina_actual);

    //     if(!$pagina_actual|| $pagina_actual <1){
    //         header('Location: /admin/vendedor/cliente/cotizador?page=1');
    //         exit;
    //     }
        
    //     $pagina_por_registros = 5000;
    //     $total = Cliente:: total();
    //     $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);
    //     if($paginacion->total_paginas() < $pagina_actual){
    //         header('Location: /admin/vendedor/cliente/cotizador?page=1');
    //     }
    
    //     $visor = Cliente::paginar($pagina_por_registros, $paginacion->offset());



    //     $alertas = Cliente::getAlertas();
    //     $router->render('admin/vendedor/cliente/cotizador', [
    //         'titulo' => 'VISOR DE CAJAS Y LAMINAR INTERNO',
    //         'id' => $id,
    //         'alertas' => $alertas,
    //         'visor' => $visor,
    //         'paginacion' => $paginacion->paginacion()
    //     ]);
    // }


    public static function cotizador(Router $router)
    {
        $id = $_GET['id'] ?? null;
        if ($id == 1) {
            Cliente::setAlerta('exito', 'El Cliente se guardo correctamente');
        }
    
        $pagina_actual = $_GET['page'] ?? 1;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
    
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/vendedor/cliente/cotizador?page=1');
            exit;
        }
    
        $registros_por_pagina = $_GET['per_page'] ?? 50; // Número de registros por página
        if ($registros_por_pagina === 'all') {
            $total = Cliente::total();
            $registros_por_pagina = $total; // Muestra todos los registros
        } else {
            $registros_por_pagina = filter_var($registros_por_pagina, FILTER_VALIDATE_INT) ?: 10;
        }
    
        $total = Cliente::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
    
        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/vendedor/cliente/cotizador?page=1');
            exit;
        }
    
        $visor = Cliente::paginar($registros_por_pagina, $paginacion->offset());
    
        $alertas = Cliente::getAlertas();
        $router->render('admin/vendedor/cliente/cotizador', [
            'titulo' => 'VISOR DE CAJAS Y LAMINAR INTERNO',
            'id' => $id,
            'alertas' => $alertas,
            'visor' => $visor,
            'paginacion' => $paginacion->paginacion()
        ]);
    }
    










    // public static function tabla(Router $router)
    // {
    //     $id= $_GET['id'] ?? null;
    //     if($id==1) {
    //         Cliente::setAlerta('exito', 'El Cliente se guardo correctamente');
    //     }
        

    //     $pagina_actual = $_GET['page'];
    //     $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
    //     // debuguear($pagina_actual);

    //     if(!$pagina_actual|| $pagina_actual <1){
    //         header('Location: /admin/vendedor/cliente/tabla?page=1');
    //         exit;
    //     }
        
    //     $pagina_por_registros = 5000;
    //     $total = Cliente:: total();
    //     $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);
    //     if($paginacion->total_paginas() < $pagina_actual){
    //         header('Location: /admin/vendedor/cliente/tabla?page=1');
    //     }
    
    //     $visor = Cliente::paginar($pagina_por_registros, $paginacion->offset());



    //     $alertas = Cliente::getAlertas();
    //     $router->render('admin/vendedor/cliente/tabla', [
    //         'titulo' => 'VISOR DE CAJAS Y LAMINAR INTERNO',
    //         'id' => $id,
    //         'alertas' => $alertas,
    //         'visor' => $visor,
    //         'paginacion' => $paginacion->paginacion()
    //     ]);
    // }



    public static function tabla(Router $router)
    {
        $id = $_GET['id'] ?? null;
        if ($id == 1) {
            Cliente::setAlerta('exito', 'El Cliente se guardo correctamente');
        }
    
        $pagina_actual = $_GET['page'] ?? 1;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
    
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/vendedor/cliente/tabla?page=1');
            exit;
        }
    
        // Obtener el número de registros por página
        $registros_por_pagina = $_GET['per_page'] ?? 10;
        if ($registros_por_pagina === 'all') {
            $total = Cliente::total();
            $registros_por_pagina = $total; // Mostrar todos los registros
        } else {
            $registros_por_pagina = filter_var($registros_por_pagina, FILTER_VALIDATE_INT) ?: 10;
        }
    
        $total = Cliente::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
    
        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/vendedor/cliente/tabla?page=1');
            exit;
        }
    
        $visor = Cliente::paginar($registros_por_pagina, $paginacion->offset());
    
        $alertas = Cliente::getAlertas();
        $router->render('admin/vendedor/cliente/tabla', [
            'titulo' => 'VISOR DE CAJAS Y LAMINAR INTERNO',
            'id' => $id,
            'alertas' => $alertas,
            'visor' => $visor,
            'paginacion' => $paginacion->paginacion()
        ]);
    }
    






    public static function crear(Router $router)
{
    $cliente = new Cliente;
    $alertas = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cliente->sincronizar($_POST);

        // debuguear($cliente);
        $alertas = $cliente->validar();

        if (!empty($_FILES['pdf']['tmp_name'])) {
            $carpeta_pdfs = $_SERVER['DOCUMENT_ROOT'] . '/src/visor';
            
            // Crear carpeta si no existe
            if (!is_dir($carpeta_pdfs)) {
                mkdir($carpeta_pdfs, 0755, true);
            }

            // Generar un nombre único para el archivo
            $nombre_pdf = md5(uniqid(rand(), true)) . '.pdf';
            $ruta_destino = $carpeta_pdfs . '/' . $nombre_pdf;

            // Intentar mover el archivo cargado
            if (move_uploaded_file($_FILES['pdf']['tmp_name'], $ruta_destino)) {
                // Asignar el nombre del archivo al objeto cliente
                $cliente->pdf = $nombre_pdf;
            } else {
                $alertas[] = "Error al mover el archivo PDF. Verifica los permisos de la carpeta.";
            }
        }

        if (empty($alertas)) {
            // Guardar en la base de datos
            $existeCodigo = Cliente::where('codigo_producto', $cliente->codigo_producto);
            if($existeCodigo) {
                Cliente::setAlerta('error', 'El Codigo ya esta registrado');
                $alertas = Cliente::getAlertas();
            } else {
                $resultado = $cliente->guardar();
                if ($resultado) {
                    header('Location: /admin/vendedor/cliente/tabla?page=1');
                    exit;
                }
            }
        }
    }
    // Render a la vista con alertas
    $router->render('admin/vendedor/cliente/crear', [
        'titulo' => 'CREAR REGISTRO',
        'alertas' => $alertas,
    ]);         
}


public static function editar(Router $router)
{
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    $cliente = Cliente::find($id); // Obtener cliente actual
    $alertas = Cliente::getAlertas();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cliente->sincronizar($_POST); // Sincronizar datos del formulario
        $alertas = $cliente->validar(); // Validar datos

        // Verificar si se subió un nuevo archivo PDF
        if (!empty($_FILES['pdf']['tmp_name'])) {
            $carpeta_pdfs = $_SERVER['DOCUMENT_ROOT'] . '/src/visor';

            // Crear carpeta si no existe
            if (!is_dir($carpeta_pdfs)) {
                mkdir($carpeta_pdfs, 0755, true);
            }

            // Verificar si existe un archivo previo
            if (!empty($cliente->pdf)) {
                $pdf_anterior = $carpeta_pdfs . '/' . $cliente->pdf;

                // Eliminar archivo anterior si existe
                if (file_exists($pdf_anterior)) {
                    unlink($pdf_anterior);
                }
            }

            // Generar un nuevo nombre único para el archivo PDF
            $nombre_pdf = md5(uniqid(rand(), true)) . '.pdf';
            $ruta_destino = $carpeta_pdfs . '/' . $nombre_pdf;

            // Mover el nuevo archivo a la carpeta
            if (move_uploaded_file($_FILES['pdf']['tmp_name'], $ruta_destino)) {
                // Actualizar el nombre del archivo en el objeto cliente
                $cliente->pdf = $nombre_pdf;
            } else {
                $alertas[] = "Error al mover el archivo PDF. Verifica los permisos de la carpeta.";
            }
        }

        if (empty($alertas)) {
            // Guardar en la base de datos
            $resultado = $cliente->guardar();
            if ($resultado) {
                header('Location: /admin/vendedor/cliente/tabla?page=1');
                exit;
            }
        }
    }

    $router->render('admin/vendedor/cliente/editar', [
        'cliente' => $cliente,
        'alertas' => $alertas,
        'titulo' => 'EDITAR REGISTRO',
    ]);
}




    // API para obtener el nombre del cliente
    public static function nombreCliente (Router $router){
        $visor_id= $_GET['id'] ?? '';
        $visor_id =filter_var($visor_id, FILTER_VALIDATE_INT);
        
        if(!$visor_id){
            echo json_encode([]);
            return;
            
        }

        $clientes= Cliente ::where('id',$visor_id);
        echo json_encode($clientes);
    }


    // API para actualizar el estado del cliente
    public static function actualizar (Router $router){
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $cliente = Cliente::find($_POST['id']);
           session_start();

           if (!$cliente || (int)$cliente->id !== (int)$_POST['id']) {
            $respuesta = [
                'estado' => 'error',
                'mensaje' => 'Error al actualizar el estado'
            ];
            echo json_encode($respuesta);
            return;
        }
            $visor = new Cliente($_POST);
            $visor->id = $cliente->id;
            $visor->pdf = $cliente->pdf;
            // debuguear($visor);
            $resultado = $visor->guardar();
            if($resultado){
                $respuesta = [
                    'tipo' => 'correcto',
                    'mensaje' => 'Estado actualizado'
                ];
            } 
            echo json_encode(['respuesta' => $respuesta]);
       }
       
    }



}




?>