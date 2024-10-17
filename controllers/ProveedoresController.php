<?php

namespace Controllers;

use Model\Proveedor;
use MVC\Router;

class ProveedoresController {
    
    public static function index(Router $router) {
        $router->render('admin/proveedor/index', [
            'titulo' => 'AREA'
        ]);
    }



    // public static function crear(Router $router) {
    //     $alertas = [];
    //     $area =  new Proveedor;

    //     if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $area->sincronizar($_POST);

    //         //validar
    //         $alertas = $area->validar();

    //         // guardar el registro
            
    //         if(empty($alertas)) {
    //             $resultado =  $area->guardar();
    //             if($resultado) {
    //                 header('Location: /admin/proveedor');
    //             }
    //         }
    //         // debuguear($proveedor);
    //     }

    //     $router->render('admin/proveedor/crear', [
    //         'titulo' => 'Crear Proveedor',
    //         'proveedor' => $proveedor,
    //         'alertas' => $alertas
    //     ]);
    // }



    public static function crear(Router $router)
    {
        session_start();
        isAuth();
        $alertas= [];
        $area = new Proveedor;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $area->sincronizar($_POST);
            
            // validar
            $alertas = $area->validar();
            if(empty($alertas)){
                // generar la url
                $hash = md5(uniqid(rand(),true));
                $area->url= $hash;
                
                // almacenar el propietario
                $area->propietarioId = $_SESSION['id'];
                // debuguear($area);
                
                // guardar en la base de datos 
                $area->guardar();
                // redireccionar
                header('Location: /admin/proveedor?id='.$area->url);

            }
            // debuguear($proyecto);
        }
        $router->render('admin/proveedor/crear',[
            'alertas' => $alertas,
            'titulo' => 'Crear'
        ]);
    
    }










}