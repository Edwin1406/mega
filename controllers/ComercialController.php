<?php 

namespace Controllers;

use Model\Area;
use MVC\Router;



class ComercialController {

    

    public static function crear(Router $router)
    {
       
        session_start();
        isAuth();
        $alertas = [];
        $id= $_SESSION['id'];
        $escoger_produccion = Area::belongsTo('propietarioId',$id);
        $router->render('admin/comercial/crear', [
            'titulo' => 'Crear Pedido',
            'escoger_produccion' => $escoger_produccion,
            'alertas' => $alertas
        ]);
    }



}










?> 