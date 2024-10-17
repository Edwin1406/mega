<?php

namespace Controllers;

use Model\Proveedor;
use MVC\Router;

class ProveedoresController {
    
    public static function index(Router $router) {
        session_start();
        isAuth();
        $area = Proveedor::All();
        debuguear($area);
        $router->render('admin/proveedor/index', [
            'titulo' => 'AREA',
            'area' => $area
        ]);
    }



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