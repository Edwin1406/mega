<?php
namespace Controllers;

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
            'escoger' => $escoger_produccion
        ]);
    }
}



?>