<?php

namespace Controllers;

use Model\EstadisticaProd;
use MVC\Router;

class EstadisticaProdController {
    public static function crear(Router $router)
    {
        $alertas = [];
        $estadistica = new EstadisticaProd;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $estadistica->sincronizar($_POST);
            $alertas = $estadistica->validar();
            
        }

        $router->render('admin/produccion/estadistica/crear', [
            'titulo' => 'Estadísticas de Producción',
            'alertas' => $alertas
        ]);      
}}