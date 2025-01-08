<?php

namespace Controllers;

use MVC\Router;

class EstadisticaProdController {
    public static function crear(Router $router)
    {
        $alertas = [];
        $router->render('admin/produccion/estadistica/crear', [
            'titulo' => 'Estadísticas de Producción',
            'alertas' => $alertas
        ]);      
}}