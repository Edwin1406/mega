<?php 

namespace Controllers;

use Model\Area;
use MVC\Router;
use Model\Comercial;



class ComercialController {

    

    // public static function index(Router $router)
    // {
       
    //     session_start();
    //     isAuth();
    //     $alertas = [];
    //     $id= $_SESSION['id'];
    //     $escoger_produccion = Area::belongsTo('propietarioId',$id);
    //     $router->render('admin/comercial/crear', [
    //         'titulo' => 'Crear Pedido',
    //         'escoger_produccion' => $escoger_produccion,
    //         'alertas' => $alertas
    //     ]);
    // }



    
    public static function crear(Router $router)
    {
       
        session_start();
        isAuth();
        $alertas = [];
        $id= $_SESSION['id'];
        $comercial = new Comercial;

        $escoger_produccion = Area::belongsTo('propietarioId',$id);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comercial->sincronizar($_POST);
            $alertas = $comercial->validar();

            debuguear($comercial);

        }


        $router->render('admin/comercial/crear', [
            'titulo' => 'Crear Pedido',
            'escoger_produccion' => $escoger_produccion,
            'alertas' => $alertas,
            'comercial' => $comercial
        ]);
    }



}










?> 