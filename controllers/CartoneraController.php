<?php

namespace Controllers;

use MVC\Router;
use Model\Pedido;
use Model\Material;
use Classes\Paginacion;




class CartoneraController {
    public static function cartonera(Router $router)
    {
        session_start();
        isAuth();
        $id= $_SESSION['id'];
        $alertas = [];
    
        // Obtener parámetros de paginación
        $pagina_actual = $_GET['page'] ?? 1;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
    
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/produccion/materia/corrugador/cartonera/index?page=1');
            exit;
        }
    
        $registros_por_pagina = $_GET['per_page'] ?? 10;
        if ($registros_por_pagina === 'all') {
            $total = Pedido::total();
            $registros_por_pagina = $total; // Mostrar todos los registros
        } else {
            $registros_por_pagina = filter_var($registros_por_pagina, FILTER_VALIDATE_INT) ?: 10;
        }
    
        // Obtener filtros
        $fecha_entrega = $_GET['fecha_entrega'] ?? '';
        $test = $_GET['test'] ?? '';
    
        // Aplicar filtros a la consulta
        $filtros = [];
        if (!empty($fecha_entrega)) {
            $filtros['fecha_entrega'] = $fecha_entrega;
        }
        if (!empty($test)) {
            $filtros['test'] = $test;
        }
    
        // Obtener pedidos con filtros
        $total = Pedido::total1($filtros);
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
    
        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/produccion/materia/corrugador/cartonera/index?page=1');
            exit;
        }
    
        $pedidosTrimar = Pedido::filtrarYPaginar($filtros, $registros_por_pagina, $paginacion->offset());
    
        $alertas = Pedido::getAlertas();
    
        $router->render('admin/produccion/materia/corrugador/cartonera/index', [
            'titulo' => 'CARTOGAR',
            'alertas' => $alertas,
            'pedidosTrimar' => $pedidosTrimar,
            'paginacion' => $paginacion->paginacion(),
        ]);
    }


    public static function pedidoseleccionados(Router $router)
    {
        session_start();
        isAuth();
        $router->render('admin/produccion/materia/corrugador/cartonera/pedidoseleccionados', [
            'titulo' => 'CARTOGAR',
            
        ]);

    }


    public static function dupla(Router $router)
    {
        session_start();
        isAuth();
        $router->render('admin/produccion/materia/corrugador/cartonera/dupla', [
            'titulo' => 'CARTOGAR',
            
        ]);

    }


    // API
    public static function apipapel(Router $router)
{
    header("Access-Control-Allow-Origin: *");  
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
    header("Content-Type: application/json"); 

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit;
    }

    // Obtener todos los materiales con sus papeles
    $materiales = Material::getAllWithPapeles();

    $grupoMateriales = [];

    foreach ($materiales as $row) {
        // Aquí nos aseguramos de acceder como un array
        $id_material = $row['id_material']; 

        if (!isset($grupoMateriales[$id_material])) {
            $grupoMateriales[$id_material] = [
                'id_material' => $row['id_material'],
                'nombre' => $row['nombre_material'],
                'flauta' => $row['flauta'],
                'papeles' => []
            ];
        }

        if (!is_null($row['id_papel'])) { // Si el material tiene papeles asociados
            $grupoMateriales[$id_material]['papeles'][] = [
                'id_papel' => $row['id_papel'],
                'codigo' => $row['codigo'],
                'descripcion' => $row['descripcion'],
                'peso' => $row['peso']
            ];
        }
    }

    // Convertimos el array a JSON y lo enviamos como respuesta
    echo json_encode(array_values($grupoMateriales), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}

}    