<?php 
namespace Controllers;

use MVC\Router;
use Model\Cliente;
use Classes\Paginacion;

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
        
    //     $pagina_por_registros = 5;
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
    $busqueda = $_GET['filtro'] ?? ''; // Capturar el filtro de búsqueda
    $busqueda = trim($busqueda);

    $pagina_actual = $_GET['page'] ?? 1;
    $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

    if (!$pagina_actual || $pagina_actual < 1) {
        header('Location: /admin/vendedor/cliente/cotizador?page=1');
        exit;
    }

    $pagina_por_registros = 5;

    // Obtener el total de registros dependiendo de si hay búsqueda
    $total = $busqueda ? Cliente::totalFiltrado($busqueda) : Cliente::total();
    $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);

    if ($paginacion->total_paginas() < $pagina_actual) {
        header('Location: /admin/vendedor/cliente/cotizador?page=1');
        exit;
    }

    // Filtrar los datos si hay búsqueda, de lo contrario, paginar normalmente
    if ($busqueda) {
        $visor = Cliente::buscarPaginado($busqueda, $pagina_por_registros, $paginacion->offset());
    } else {
        $visor = Cliente::paginar($pagina_por_registros, $paginacion->offset());
    }

    $alertas = Cliente::getAlertas();
    $router->render('admin/vendedor/cliente/cotizador', [
        'titulo' => 'VISOR DE CAJAS Y LAMINAR INTERNO',
        'id' => $id,
        'alertas' => $alertas,
        'visor' => $visor,
        'paginacion' => $paginacion->paginacion(),
        'filtro' => $busqueda // Enviar el filtro actual al frontend
    ]);
}


   

    public static function crear(Router $router)
    {
        $cliente = new Cliente;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente->sincronizar($_POST);
            $alertas = $cliente->validar();
    
            if (empty($alertas)) {
                $archivo = $_FILES['imagen'] ?? null;
                if ($archivo && $archivo['error'] === UPLOAD_ERR_OK) {
                    $nombreArchivo = preg_replace('/[^a-zA-Z0-9._-]/', '_', $archivo['name']);
                    $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
    
                    if ($archivo['type'] === 'application/pdf' && $extension === 'pdf') {
                        $destino = $_SERVER['DOCUMENT_ROOT'] . '/src/visor/';
                        if (!file_exists($destino)) mkdir($destino, 0777, true);
    
                        if (move_uploaded_file($archivo['tmp_name'], $destino . $nombreArchivo)) {
                            $cliente->imagen = $nombreArchivo;
                        } else {
                            Cliente::setAlerta('error', 'Error al subir el archivo.');
                        }
                    } else {
                        Cliente::setAlerta('error', 'El archivo debe ser un PDF.');
                    }
                } else {
                    Cliente::setAlerta('error', 'No se ha subido ningún archivo.');
                }
    
                if (empty(Cliente::getAlertas())) {
                    $cliente->guardar();
                    header('Location: /admin/vendedor/cliente/cotizador?id=1');
                }
            }
        }
        $alertas = Cliente::getAlertas();

    
        // Render a la vista
        $router->render('admin/vendedor/cliente/crear', [
            'titulo' => 'CREAR REGISTRO',
            'alertas' => $alertas,
        ]);
    }
    










}




?>