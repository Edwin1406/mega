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
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
        
        $citas = Citas::all();
        echo json_encode($citas);
    }






}