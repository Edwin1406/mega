<?php 

namespace Controllers;

use MVC\Router;



class ComercialController {

    

    public static function index(Router $router)
    {
       
        session_start();
        isAuth();
        $id= $_SESSION['id'];
        $escoger_produccion = Produccion::belongsTo('propietarioId',$id);
        $router->render('admin/comercial/index', [
            'titulo' => 'Área Comercial',
            'escoger_produccion' => $escoger_produccion
        ]);
    }

    public static function registro_comercial(Router $router)
    {   
        session_start();
        isAuth();
        $id= $_SESSION['id'];
        $escoge_registro = UrlRegistro::belongsTo('propietarioId',$id);
        $router->render('admin/comercial/registro_comercial', [
            'titulo' => 'REGISTRO DE PRODUCCION',
            'escoge_registro' => $escoge_registro
        ]);
    }

}










?> 