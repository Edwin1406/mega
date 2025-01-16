<?php 

namespace Controllers;

use Model\Area;
use MVC\Router;
use Model\Comercial;
use Classes\Paginacion;



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
            $comercial->total_item = $comercial->cantidad * $comercial->precio;
            $alertas = $comercial->validar();

            // debuguear($comercial);

           if (empty($alertas)) {
                $comercial->guardar();
                $alertas = $comercial->getAlertas();
                header('Location: /admin/comercial/tabla?id='.$id);
            }


        }


        $router->render('admin/comercial/crear', [
            'titulo' => 'GENERAR ORDEN DE COMPRA',
            'escoger_produccion' => $escoger_produccion,
            'alertas' => $alertas,
            'comercial' => $comercial
        ]);
    }



    public static function tabla(Router $router)
    {
        $id = $_GET['id'] ?? null;
        if ($id == 1) {
            Comercial::setAlerta('exito', 'El Cliente se guardo correctamente');
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
            header('Location: /admin/comercial/tabla?page=1');
            exit;
        }
    
        $comercial = Comercial::paginar($registros_por_pagina, $paginacion->offset());
    


        $router->render('admin/comercial/tabla', [
            'titulo' => 'ORDENES DE COMPRA',
            'comercial' => $comercial,
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
            $comercial = Comercial::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comercial->sincronizar($_POST);
            $alertas = $comercial->validar();
            if (empty($alertas)) {
                $comercial->actualizar();
                $alertas = $comercial->getAlertas();
                header('Location: /admin/comercial/tabla?id='.$id);
            }
        }
        $router->render('admin/comercial/editar', [
            'titulo' => 'EDITAR ORDEN DE COMPRA',
            'comercial' => $comercial,
            'alertas' => $alertas
        ]);
    }



}










?> 