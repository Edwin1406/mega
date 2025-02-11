<?php

namespace Controllers;

use MVC\Router;

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






}