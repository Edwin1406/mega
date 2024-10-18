<?php
namespace Controllers;

use Model\Maquinas;
use Model\Produccion;
use MVC\Router;

class ProduccionController
{
    public static function index(Router $router)
    {
       
        session_start();
        isAuth();
        $id= $_SESSION['id'];
        $escoger_produccion = Produccion::belongsTo('propietarioId',$id);
        $router->render('admin/produccion/index', [
            'titulo' => 'SECCION DE PRODUCCCION',
            'escoger_produccion' => $escoger_produccion
        ]);
    }
    
    public static function registro_produccion(Router $router)
    {
       
        session_start();
        isAuth();
        $id= $_SESSION['id'];
        $escoge_registro = Maquinas::belongsTo('propietarioId',$id);
        $router->render('admin/produccion/registro_produccion', [
            'titulo' => 'REGISTRO DE PRODUCCION',
            'escoge_registro' => $escoge_registro
        ]);
    }


    public static function cotizador(Router $router)
    {
       
        session_start();
        isAuth();
        $id= $_SESSION['id'];
        $escoger_produccion = Produccion::belongsTo('propietarioId',$id);
        if(!isAuth()){
            header('Location: /');
            
        }
        $router->render('admin/produccion/cotizador/index', [
            'titulo' => 'COTIZADOR',
            'escoger_produccion' => $escoger_produccion
        ]);
    }



}



?>