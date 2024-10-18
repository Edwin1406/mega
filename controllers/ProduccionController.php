<?php
namespace Controllers;

use Model\Area;
use MVC\Router;

class ProduccionController
{
    public static function index(Router $router)
    {
        session_start();
        isAuth();
        session_start();
        isAuth();
        $id= $_SESSION['id'];
        $escoger = Area::belongsTo('propietarioId',$id);
        $router->render('admin/produccion/index', [
            'titulo' => 'SECCION DE PRODUCCCION',
            'escoger' => $escoger
        ]);
    }
}



?>