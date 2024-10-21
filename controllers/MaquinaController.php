<?php

namespace Controllers;

use MVC\Router;
use Model\Maquinas;
use Classes\Paginacion;

 class MaquinaController
 {

        public static function tabla(Router $router)
        {

            // PAGINACION DE MAQUINAS

            $pagina_actual = $_GET['page'];
            $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
            debuguear($pagina_actual);

            if(!$pagina_actual|| $pagina_actual <1){
                header('Location: /admin/produccion/maquinas/tabla?page=1');
                exit;
            }
            
            $pagina_por_registros = 1;
            $total = Maquinas:: total();
            $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);
            if($paginacion->total_paginas() < $pagina_actual){
                header('Location: /admin/produccion/maquinas/tabla?page=1');
            }
        
            $maquinas = Maquinas::paginar($pagina_por_registros, $paginacion->offset());





            $maquinas = Maquinas::all();
            // debuguear($maquinas);
            $router->render('admin/produccion/maquinas/tabla', [
                'titulo' => 'TABLA DE MAQUINAS',
                'maquinas' => $maquinas,
                'paginacion' => $paginacion->paginacion()
            ]);
        }




     public static function crear(Router $router)
     {
        $alertas = [];
        $maquina = new Maquinas;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maquina->sincronizar($_POST);
                // validar
                $alertas = $maquina->validar();

                if(empty($alertas)) {
                    // guardar en la base de datos
                    $maquina->guardar();
                    header('Location: /admin/produccion/maquinas/tabla');

                }
            
        }

         $router->render('admin/produccion/maquinas/crear', [
             'titulo' => 'CREAR MAQUINA',
             'alertas' => $alertas
             
         ]);
     }
 }




?>