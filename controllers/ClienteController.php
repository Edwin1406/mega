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
        
        $pagina_por_registros = 2;
        $total = Cliente:: total();
        $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);
        if($paginacion->total_paginas() < $pagina_actual){
            header('Location: /admin/vendedor/cliente/cotizador?page=1');
        }
    
        $visor = Cliente::paginar($pagina_por_registros, $paginacion->offset());



        $alertas = Cliente::getAlertas();
        $router->render('admin/vendedor/cliente/cotizador', [
            'titulo' => ' CLIENTE',
            'id' => $id,
            'alertas' => $alertas,
            'visor' => $visor,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

   


    public static function crear(Router $router)
    {
        $alertas = [];
        $cliente = new Cliente;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente->sincronizar($_POST);
            $alertas = $cliente->validar();
            debuguear($cliente);
    
            if (empty($alertas)) {
                $codigo = Cliente::where('nombre_cliente', $cliente->nombre_cliente);
                $nombre = Cliente::where('nombre_producto', $cliente->nombre_producto);
                $archivo = $_FILES['imagen'];
    
                // Verificar si se cargó un archivo
                if ($archivo && $archivo['error'] === UPLOAD_ERR_OK) {
                    $nombreArchivo = preg_replace('/[^a-zA-Z0-9._-]/', '_', $archivo['name']); // Limpia el nombre del archivo
                    $tipoArchivo = $archivo['type'];
                    $extensionArchivo = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    
                    // Validar tipo y extensión del archivo (PDF)
                    if ($tipoArchivo === 'application/pdf' && strtolower($extensionArchivo) === 'pdf') {
                        // Ruta destino: carpeta 'src/visor'
                        $destino = $_SERVER['DOCUMENT_ROOT'] . '/src/visor/';
    
                        // Verificar si la carpeta 'visor' existe, si no, crearla
                        if (!file_exists($destino)) {
                            mkdir($destino, 0777, true); // Crear carpeta con permisos adecuados
                        }
    
                        // Mover el archivo a la carpeta 'src/visor'
                        if (move_uploaded_file($archivo['tmp_name'], $destino . $nombreArchivo)) {
                            $cliente->imagen = $nombreArchivo;
                            echo "Archivo PDF subido correctamente a la carpeta 'visor'.";
                            echo "URL del archivo: https://megawebsistem.com/src/visor/$nombreArchivo";
                        } else {
                            Cliente::setAlerta('error', 'Error al subir el archivo a la carpeta.');
                            $alertas = Cliente::getAlertas();
                        }
                    } else {
                        Cliente::setAlerta('error', 'El archivo debe ser un PDF.');
                        $alertas = Cliente::getAlertas();
                    }
                } else {
                    Cliente::setAlerta('error', 'No se ha subido ningún archivo o hay un error con la subida.');
                    $alertas = Cliente::getAlertas();
                }
    
                if ($codigo || $nombre) {
                    Cliente::setAlerta('error', 'El Cliente y RUC ya están registrados.');
                    $alertas = Cliente::getAlertas();
                } else {
                    if (empty($alertas)) {
                        $cliente->guardar();
                        header('Location: /admin/vendedor/cliente/cotizador?id=1');
                    }
                }
            }
        }
    
        // Render a la vista
        $router->render('admin/vendedor/cliente/crear', [
            'titulo' => 'CREAR CLIENTE',
            'alertas' => $alertas,
        ]);
    }
    










}




?>