<?php 
namespace Controllers;

use MVC\Router;
use Model\Cliente;
use Classes\Paginacion;

class ClienteController
{
    public static function cotizador(Router $router)
    {
        $id= $_GET['id'] ?? null;
        if($id==1) {
            Cliente::setAlerta('exito', 'El Cliente se guardo correctamente');
        }


        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        // debuguear($pagina_actual);

        if(!$pagina_actual|| $pagina_actual <1){
            header('Location: /admin/vendedor/cliente/cotizador?page=1');
            exit;
        }
        
        $pagina_por_registros = 100;
        $total = Cliente:: total();
        $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);
        if($paginacion->total_paginas() < $pagina_actual){
            header('Location: /admin/vendedor/cliente/cotizador?page=1');
        }
    
        $visor = Cliente::paginar($pagina_por_registros, $paginacion->offset());



        $alertas = Cliente::getAlertas();
        $router->render('admin/vendedor/cliente/cotizador', [
            'titulo' => 'VISOR DE CAJAS Y LAMINAR INTERNO',
            'id' => $id,
            'alertas' => $alertas,
            'visor' => $visor,
            'paginacion' => $paginacion->paginacion()
        ]);
    }
    public static function tabla(Router $router)
    {
        $id= $_GET['id'] ?? null;
        if($id==1) {
            Cliente::setAlerta('exito', 'El Cliente se guardo correctamente');
        }


        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        // debuguear($pagina_actual);

        if(!$pagina_actual|| $pagina_actual <1){
            header('Location: /admin/vendedor/cliente/tabla?page=1');
            exit;
        }
        
        $pagina_por_registros = 100;
        $total = Cliente:: total();
        $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);
        if($paginacion->total_paginas() < $pagina_actual){
            header('Location: /admin/vendedor/cliente/tabla?page=1');
        }
    
        $visor = Cliente::paginar($pagina_por_registros, $paginacion->offset());



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
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente->sincronizar($_POST);
            $alertas = $cliente->validar();
    
            // Generar un nombre único para el archivo PDF
            $nombrePDF = md5(uniqid(rand(), true)) . '.pdf';
            $cliente->imagen = $nombrePDF;
    
            if (empty($alertas)) {
                // Guardar los datos del cliente en la base de datos
                $cliente->guardar();
    
                // Procesar el archivo PDF
                $archivo = $_FILES['imagen'] ?? null;
    
                if ($archivo && $archivo['error'] === UPLOAD_ERR_OK) {
                    // Sanitizar el nombre del archivo
                    $nombreArchivo = preg_replace('/[^a-zA-Z0-9._-]/', '_', $archivo['name']);
                    $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
    
                    // Validar que sea un archivo PDF
                    if ($archivo['type'] === 'application/pdf' && $extension === 'pdf') {
                        $destino = $_SERVER['DOCUMENT_ROOT'] . '/src/visor/';
    
                        // Crear la carpeta si no existe
                        if (!file_exists($destino)) {
                            if (!mkdir($destino, 0777, true) && !is_dir($destino)) {
                                Cliente::setAlerta('error', 'No se pudo crear la carpeta de destino.');
                            }
                        }
    
                        // Mover el archivo subido al destino
                        if (move_uploaded_file($archivo['tmp_name'], $destino . $nombrePDF)) {
                            $cliente->imagen = $nombrePDF;
                        } else {
                            Cliente::setAlerta('error', 'Error al subir el archivo.');
                        }
                    } else {
                        Cliente::setAlerta('error', 'El archivo debe ser un PDF válido.');
                    }
                } else {
                    Cliente::setAlerta('error', 'No se pudo procesar el archivo.');
                }
    
                // Redirigir si no hay errores
                if (empty(Cliente::getAlertas())) {
                    $cliente->actualizar();
                    header('Location: /admin/vendedor/cliente/tabla?id=1');
                    exit;
                }
            }
        }
    
        // Obtener alertas
        $alertas = Cliente::getAlertas();
    
        // Renderizar la vista
        $router->render('admin/vendedor/cliente/crear', [
            'titulo' => 'CREAR REGISTRO',
            'alertas' => $alertas,
        ]);
    }
    
    

    public static function editar(Router $router)
    {
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $cliente = Cliente::find($id);
        $alertas = Cliente::getAlertas();
    
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
                }
    
                if (empty(Cliente::getAlertas())) {
                    $cliente->actualizar();
                    header('Location: /admin/vendedor/cliente/tabla?id=1');
                }
            }
        }
    
        // Render a la vista
        $router->render('admin/vendedor/cliente/editar', [
            'titulo' => 'EDITAR REGISTRO',
            'alertas' => $alertas,
            'cliente' => $cliente
        ]);
    }







    










}




?>