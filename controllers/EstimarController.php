<?php

namespace Controllers;

use MVC\Router;

class EstimarController {

    public static function index(Router $router)
    {
    
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