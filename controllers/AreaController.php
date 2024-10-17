<?php

namespace Controllers;

use Model\Area;
use MVC\Router;

class AreaController {
    
    public static function index(Router $router) {
        session_start();
        isAuth();
        $area = Area::belongsTo('propietarioId', $_SESSION['id']);     
        $router->render('admin/area/index', [
            'titulo' => 'AREA',
            'area' => $area
        ]);
    }



    public static function crear(Router $router)
    {
        session_start();
        isAuth();
        $alertas= [];
        $area = new Area;
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
                header('Location: /admin/area/paginaArea?id='.$area->url);

            }
            // debuguear($proyecto);
        }
        $router->render('admin/area/crear',[
            'alertas' => $alertas,
            'titulo' => 'Crear'
        ]);
    
    }

    public static function paginaArea(Router $router)
    {
        session_start();
        isAuth();
        $id = $_GET['id'];
        $area = Area::find($id);
        $router->render('/admin/area/paginaArea', [
            'titulo' => 'Pagina Area',
            'area' => $area
        ]);
    }










}