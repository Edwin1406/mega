<?php

namespace Controllers;

use MVC\Router;
use Model\Comercial;



class FinancieroController {

    public static function tabla(Router $router)
    {

        
        $id = $_GET['id'] ?? null;
        if (!$id){
            header('Location: /');
        }
        

        $pagina_actual = $_GET['page'] ?? 1;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual|| $pagina_actual < 1) {
            header('Location: /admin/comercial/tabla?page=1');
        }

        $router->render('admin/financiero/tabla', [
            'titulo' => 'TABLA DE FINANCIERO',
        ]);
    }
}