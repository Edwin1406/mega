<?php

namespace Controllers;

use MVC\Router;
use Model\Pedido;
use Classes\Paginacion;




class CartoneraController {

    public static function cartonera(Router $router)
    {

        session_start();
        isAuth();
        $id= $_SESSION['id'];
        $alertas = [];
        // $pedidosTrimar = Pedido::all('ASC');

        
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

        $total = Pedido::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
    
        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/produccion/materia/corrugador/cartonera/index?page=1');
            exit;
        }
    

        $pedidosTrimar = Pedido::paginar($registros_por_pagina, $paginacion->offset());
    
        $alertas = Pedido::getAlertas();




        // debuguear($pedidosTrimar);
        $router->render('admin/produccion/materia/corrugador/cartonera/index', [
            'titulo' => 'CARTOGAR',

            'alertas' => $alertas,
            'pedidosTrimar' => $pedidosTrimar,
            'paginacion' => $paginacion->paginacion(),
        ]);
    }
}