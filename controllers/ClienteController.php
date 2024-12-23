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
    $alertas = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cliente->sincronizar($_POST);
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
            $resultado = $cliente->guardar();
            if ($resultado) {
                header('Location: /admin/vendedor/cliente/tabla?page=1');
                exit;
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
        $cliente = Cliente::find($id);
        $alertas = Cliente::getAlertas();

        $cliente->pdf_actual = $cliente->pdf;
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente->sincronizar($_POST);
            $alertas = $cliente->validar();
    

               
        if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
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
        
                // Eliminar el archivo anterior, si existe
                if (!empty($cliente->pdf_actual) && file_exists($carpeta_pdfs . '/' . $cliente->pdf_actual)) {
                    unlink($carpeta_pdfs . '/' . $cliente->pdf_actual);
                }
        
                // Guardar en la base de datos
                $resultado = $cliente->guardar();
                if ($resultado) {
                    header('Location: /admin/vendedor/cliente/tabla?page=1');
                    exit;
                }
            } else {
                $alertas[] = "Error al mover el archivo PDF. Verifica los permisos de la carpeta.";
            }
        } else {
            $alertas[] = "No se subió ningún archivo PDF o hubo un error en la carga.";
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