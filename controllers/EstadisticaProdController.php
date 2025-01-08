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
            if (empty($alertas)) {
                $resultado = $estadistica->guardar();
                if ($resultado) {
                    header('Location: /admin/produccion/estadistica/graficas');
                }
            }
            
        }

        $router->render('admin/produccion/estadistica/crear', [
            'titulo' => 'Estadísticas de Producción',
            'alertas' => $alertas,
            'estadistica' => $estadistica
        ]);      
}}