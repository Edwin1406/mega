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
    }

    public static function graficas(Router $router)
    {
        $router->render('admin/produccion/estadistica/graficas', [
            'titulo' => 'Estadísticas de Producción'
        ]);
    }


    public static function apiestadisticas()
    {
        header("Access-Control-Allow-Origin: *");  // Permite solicitudes desde cualquier origen
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
        header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Cabeceras permitidas
        $estadistica = EstadisticaProd::all();
        echo json_encode($estadistica);

    }





}