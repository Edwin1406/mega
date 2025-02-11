<?php

namespace Controllers;

use MVC\Router;
use Model\Citas;

class EstimarController {

    public static function index(Router $router)
    {
        $id = $_GET['id'] ?? null;
        // sanitize $id
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id){
            header('Location: /error404');
        }
    
        $router->render('admin/produccion/estimar/index', [
            'titulo' => 'PANEL DE ESTIMACIÓN',
        ]);
       
    }


    public static function costos_generales(Router $router)
    {
       
        $router->render('admin/produccion/estimar/costos_generales/index', [
            'titulo' => 'COSTOS GENERALES',
        ]);
       
    }





    public static function citas() {
        header("Access-Control-Allow-Origin: *");  // Permite solicitudes desde cualquier origen
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
        header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Cabeceras permitidas
        $citas = Citas::all();
        echo json_encode($citas);
    }






}