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
        
        $pagina_por_registros = 5;
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
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $cliente->sincronizar($_POST);
                $alertas = $cliente->validar();
            
                if (empty($alertas)) {
                    $codigo = Cliente::where('codigo', $cliente->codigo);
                    $nombre = Cliente::where('nombre', $cliente->nombre);
                    $archivo = $_FILES['archivo']; // Cambiado a 'archivo' para mayor claridad
                    $nombreArchivo = preg_replace('/[^a-zA-Z0-9._-]/', '_', $archivo['name']); // Limpia el nombre del archivo
                    $tipoArchivo = $archivo['type'];
            
                    // Validar que sea un PDF
                    if ($tipoArchivo !== 'application/pdf') {
                        echo "Error: Solo se permiten archivos PDF.";
                        exit;
                    }
            
                    $rutaTemporal = $archivo['tmp_name'];
                    $cliente->archivo = $nombreArchivo;
            
                    // Ruta destino: carpeta 'src/visor'
                    $destino = $_SERVER['DOCUMENT_ROOT'] . '/src/visor/';
            
                    // Verificar si la carpeta 'visor' existe, si no, crearla
                    if (!file_exists($destino)) {
                        mkdir($destino, 0777, true); // Crear carpeta con permisos adecuados
                    }
            
                    // Mover el archivo a la carpeta 'src/visor'
                    if (move_uploaded_file($rutaTemporal, $destino . $nombreArchivo)) {
                        echo "Archivo subido correctamente a la carpeta 'visor'.";
                        echo "URL del archivo: https://megawebsistem.com/src/visor/$nombreArchivo";
                    } else {
                        echo "Error al subir el archivo a la carpeta 'visor'.";
                    }
            
                    if ($codigo || $nombre) {
                        Cliente::setAlerta('error', 'El Cliente y Ruc ya están registrados');
                        $alertas = Cliente::getAlertas();
                    } else {
                        $cliente->guardar();
                        header('Location: /admin/vendedor/cliente/cotizador?id=1');
                    }
                }
            
            }}

         // Render a la vista
         $router->render('admin/vendedor/cliente/crear', [
            'titulo' => 'CREAR CLIENTE',
            'alertas' => $alertas,
        ]);
    }
}




?>