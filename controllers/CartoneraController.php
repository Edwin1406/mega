<?php

namespace Controllers;

use MVC\Router;
use Model\Pedido;
use Model\Material;
use Classes\Paginacion;




class CartoneraController {
    public static function cartonera(Router $router)
    {
       // session_start();
        //isAuth();
        //$id= $_SESSION['id'];
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
            'titulo' => 'PEDIDOS SELECCIONADOS',
            
        ]);

    }


    public static function dupla(Router $router)
    {
        session_start();
        isAuth();
        $router->render('admin/produccion/materia/corrugador/cartonera/dupla', [
            'titulo' => 'COMPOSICIÓN DE MATERIALES',
            
        ]);

    }


    // API
    public static function apipapel(Router $router) {
        header("Access-Control-Allow-Origin: *");  
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
        header("Content-Type: application/json"); 
    
        $materiales = Material::obtenerMaterialesConPapeles();
        
        echo json_encode($materiales, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }


    public static function combinacion (Router $router) {
        session_start();
        isAuth();
        $router->render('admin/produccion/materia/corrugador/cartonera/combinacion', [
            'titulo' => 'COMBINACIÓN DE PEDIDOS', 
        ]);

    }


    


}    