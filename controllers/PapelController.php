<?php

namespace Controllers;

use MVC\Router;
use Model\Bobina;
use Classes\Paginacion;

class PapelController
{
   
    public static function tabla(Router $router)
    {

           // PAGINACION DE MAQUINAS

           $pagina_actual = $_GET['page'];
           $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
           // debuguear($pagina_actual);

           if(!$pagina_actual|| $pagina_actual <1){
               header('Location: /admin/produccion/papel/tabla?page=1');
               exit;
           }
           
           $pagina_por_registros = 1;
           $total = Bobina:: total();
           $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);
           if($paginacion->total_paginas() < $pagina_actual){
               header('Location: /admin/produccion/papel/tabla?page=1');
           }
       
           $bobinas = Bobina::paginar($pagina_por_registros, $paginacion->offset());

        // debuguear($papel);
        $router->render('admin/produccion/papel/tabla', [
            'titulo' => 'TABLA DE PAPEL',
            'bobinas' => $bobinas,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router)
    {
        $alertas = [];
        $papel = new Bobina;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $papel->sincronizar($_POST);
        
            // validar
            $alertas = $papel->validar();
            if(empty($alertas)){
                // guardar en la base de datos
                $papel->guardar();
                header('Location: /admin/produccion/papel/tabla');
            }

        }   

        $router->render('admin/produccion/papel/crear', [
            'titulo' => 'CREAR PAPEL',
            'alertas' => $alertas
        ]);
    }
}