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




    public static function crear(Router $router)
    {
        session_start();
        isAuth();
        $alertas= [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $area = new Proveedor($_POST);
            // validar
            $alertas = $area->validar();
            if(empty($alertas)){
                // generar la url
                $hash = md5(uniqid(rand(),true));
                $area->url= $hash;
                // almacenar el propietario
                $area->propietarioId = $_SESSION['id'];

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