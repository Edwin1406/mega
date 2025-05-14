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
           
           $pagina_por_registros = 5;
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

            //sumar los totales
            $papel->TOTAL = 
                ($papel->SF ?: 0) + 
                ($papel->LG ?: 0) + 
                ($papel->ERRO ?: 0) + 
                ($papel->HUN ?: 0) + 
                ($papel->MDO ?: 0);

            //fehcha de actualizacion en basio porque solo estoy creando 
            $papel->updated_at = '';


            
        
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



    public static function editar(Router $router)
        {
            $alertas = [];
            $id = $_GET['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            // validar que el id sea un entero
            if (!$id) {
                header('Location: /admin/produccion/papel/tabla');
            }
            $papel = Bobina::find($id);

            if (!$papel) {
                header('Location: /admin/produccion/papel/tabla');
            }

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $papel->sincronizar($_POST);
                // debuguear($papel);

                //sumar los totales
                $papel->TOTAL = 
                    ($papel->SF ?: 0) + 
                    ($papel->LG ?: 0) + 
                    ($papel->ERRO ?: 0) + 
                    ($papel->HUN ?: 0) + 
                    ($papel->MDO ?: 0);
                //fehcha de actualizacion en basio porque solo estoy creando
                $papel->updated_at = date('Y-m-d H:i:s');
                $alertas = $papel->validar();
                if(empty($alertas)){
                    $papel->actualizar();
                    header('Location: /admin/produccion/papel/tabla');
                }

            }
            $router->render('admin/produccion/papel/editar', [
                'titulo' => 'EDITAR MAQUINA',
                'alertas' => $alertas,
                'papel' => $papel
                
            ]);

            
        }

        public static function eliminar()
        {
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);
                $papel = Bobina::find($id);

                // debuguear($maquina);
                if(!isset($papel)){
                    header('Location: /admin/produccion/papel/tabla');
                }
                $resultado=$papel->eliminar();
                if($resultado){
                    header('Location: /admin/produccion/papel/tabla');
                }

            }
               
        }



        public static function apidesperdiciopapel(){
            header('Content-Type: application/json');
            $papel = Bobina::all();
            echo json_encode($papel);
        }









}