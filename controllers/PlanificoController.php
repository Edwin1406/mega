<?php

namespace Controllers;

use MVC\Router;

class PlanificoController
{
    public static function index(Router $router)
    {
        $router->render('admin/produccion/planifico', [
            'titulo' => 'PLANIFICACIÓN DE PRODUCCIÓN',
            
        ]);
    }
}