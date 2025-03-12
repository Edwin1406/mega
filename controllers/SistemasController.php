<?php

namespace Controllers;

use MVC\Router;

class SistemasController {

    public static function index(Router $router)
    {
        $router->render('admin/sistemas/index', [
            'titulo' => 'INVENTARIO DE SISTEMAS',
        ]);
    }


    public static function crear(Router $router)
    {


        $comercial = new Comercial;

        $escoger_produccion = Area::belongsTo('propietarioId',$id);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comercial->sincronizar($_POST);
            $comercial->total_item = $comercial->cantidad * $comercial->precio;
            $comercial->transito = $comercial->fecha_produccion - $comercial->arribo_planta;
            $comercial->calcularTransito();

            // debuguear($comercial);
            $alertas = $comercial->validar();

            // debuguear($comercial);

           if (empty($alertas)) {
                $comercial->guardar();
                $alertas = $comercial->getAlertas();
                header('Location: /admin/comercial/tabla?id='.$id);
            }


        }





        
        $alertas = [];
        $router->render('admin/sistemas/productos/crear', [
            'titulo' => 'CREAR PRODUCTO',
            'alertas' => $alertas
        ]);
    }





}