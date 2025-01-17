<?php

namespace Controllers;

use MVC\Router;
use Model\Comercial;
use Classes\Paginacion;



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

        
         // Obtener el número de registros por página
         $registros_por_pagina = $_GET['per_page'] ?? 10;
         if ($registros_por_pagina === 'all') {
             $total = Comercial::total();
             $registros_por_pagina = $total; // Mostrar todos los registros
         } else {
             $registros_por_pagina = filter_var($registros_por_pagina, FILTER_VALIDATE_INT) ?: 10;
         }

         $total = Comercial::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/financiero/tabla?page=1');
            exit;
        }
    
        $financiero = Comercial::paginar($registros_por_pagina, $paginacion->offset());
    



        $router->render('admin/financiero/tabla', [
            'titulo' => 'TABLA DE FINANCIERO',
            'financiero' => $financiero,
            'paginacion' => $paginacion->paginacion()
        ]);
    }


    public static function editar(Router $router)
    {
        $alertas = [];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        // validar que el id sea un entero
        if (!$id) {
            header('Location: /admin/comercial/tabla');
        }
        $financiero = Comercial::find($id);


       
        

        $router->render('admin/financiero/editar', [
            'titulo' => 'Editar Financiero',
            'financiero' => $financiero,
            'alertas' => $alertas
        ]);
    }






}


