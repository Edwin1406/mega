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

            if (!empty($_FILES['pdf']['tmp_name'])) {
                $carpeta_pdfs = $_SERVER['DOCUMENT_ROOT'] . '/mega/public/pdfs';
                
                // Crear carpeta si no existe
                if (!is_dir($carpeta_pdfs)) {
                    mkdir($carpeta_pdfs, 0755, true);
                }
                
                // Generar un nombre único para el archivo
                $nombre_pdf = md5(uniqid(rand(), true)) . '.pdf';
            
                // Mover el archivo cargado a la carpeta
                $ruta_destino = $carpeta_pdfs . '/' . $nombre_pdf;
                if (move_uploaded_file($_FILES['pdf']['tmp_name'], $ruta_destino)) {
                    $_POST['pdf'] = $nombre_pdf; // Guardar el nombre del archivo en el array POST
                } else {
                    // Manejar error en la subida
                    echo "Error al subir el archivo PDF.";
                }
            }
            
    
            if (empty($alertas)) {
                // Mover el archivo PDF a la carpeta
                $ruta_destino = $carpeta_pdfs . '/' . $nombre_pdf;
                if (move_uploaded_file($_FILES['pdf']['tmp_name'], $ruta_destino)) {
                    // Guardar en la base de datos
                    $cliente->pdf = $nombre_pdf; // Asignar el nombre del archivo PDF al atributo correspondiente
                    $resultado = $cliente->guardar();
                    
                    if ($resultado) {
                        header('Location: /mega/admin/ponentes');
                    }
                } else {
                    echo "Error al mover el archivo PDF.";
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