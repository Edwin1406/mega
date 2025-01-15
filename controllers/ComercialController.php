<?php 

namespace Controllers;

use Model\Area;
use MVC\Router;



class ComercialController {

    

    public static function index(Router $router)
    {
       
        session_start();
        isAuth();
        $id= $_SESSION['id'];
        $escoger_produccion = Area::belongsTo('propietarioId',$id);
        $router->render('admin/comercial/crear', [
            'titulo' => 'Área Comercial',
            'escoger_produccion' => $escoger_produccion
        ]);
    }



}










?> 