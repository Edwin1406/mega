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
            // debuguear($pagina_actual);

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

            // $maquinas = Maquinas::all();
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
            // debuguear($maquina);
                // validar
                $alertas = $maquina->validar();

                if(empty($alertas)) {
                    // guardar en la base de datos
                    $maquina->guardar();
                    header('Location: /admin/produccion/maquinas/tabla?page=1');

                }
            
        }

         $router->render('admin/produccion/maquinas/crear', [
             'titulo' => 'CREAR MAQUINA',
             'alertas' => $alertas
             
         ]);
     }



        public static function editar(Router $router)
        {
            $alertas = [];
            $id = $_GET['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            // validar que el id sea un entero
            if (!$id) {
                header('Location: /admin/produccion/maquinas/tabla');
            }
            $maquina = Maquinas::find($id);

            if (!$maquina) {
                header('Location: /admin/produccion/maquinas/tabla');
            }

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $maquina->sincronizar($_POST);
                $alertas = $maquina->validar();
                if(empty($alertas)){
                    $maquina->actualizar();
                    header('Location: /admin/produccion/maquinas/tabla');
                }

            }
            $router->render('admin/produccion/maquinas/editar', [
                'titulo' => 'EDITAR MAQUINA',
                'alertas' => $alertas,
                'maquina' => $maquina
                
            ]);

            
        }

        public static function eliminar()
        {
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);
                $maquina = Maquinas::find($id);

                debuguear($maquina);
                if(!isset($maquina)){
                    header('Location: /admin/produccion/maquinas/tabla');
                }
                $resultado=$maquina->eliminar();
                if($resultado){
                    header('Location: /admin/produccion/maquinas/tabla');
                }

            }
               
        }







 }




?>