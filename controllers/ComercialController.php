<?php 

namespace Controllers;

use Model\Area;
use MVC\Router;
use Model\Comercial;



class ComercialController {

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

           if (empty($alertas)) {
                $comercial->guardar();
                $alertas = $comercial->getAlertas();
            }
            

        }


        $router->render('admin/comercial/crear', [
            'titulo' => 'GENERAR ORDEN DE COMPRA',
            'escoger_produccion' => $escoger_produccion,
            'alertas' => $alertas,
            'comercial' => $comercial
        ]);
    }



}










?> 