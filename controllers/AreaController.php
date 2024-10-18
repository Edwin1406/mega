<?php

namespace Controllers;

use Model\Area;
use MVC\Router;

class AreaController {
    
    public static function index(Router $router) {
        session_start();
        isAuth();
         
        $router->render('admin/area/index', [
            'titulo' => 'AREA'
        ]);
    }



    public static function crear(Router $router)
    {
        session_start();
        isAuth();
        $alertas= [];
        $area = new Area;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $_POST = array_map('trim', $_POST);
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
            'titulo' => 'CREAR AREA',
        ]);
    
    }

    public static function paginaArea(Router $router)
    {
       
        session_start();
        isAuth();

        // revisar que la persona sea el propietario del proyecto o quien la creo
        $url = $_GET['id']; // url es id
        if(!$url) header('Location: /admin/index');
        // obtener el proyecto
        $area = Area::where('url',$url);
        // debuguear($area);
        
        if($area->propietarioId !== $_SESSION['id']){ 
        }else{
            header('Location: /admin/index');
        }
        // debuguear($area);
        // ----------------------------------------------------------------------------------
        $router->render('admin/area/paginaArea',[
            'titulo' => $area->area,
        ]);
    
    }




    public static function escoger(Router $router)
    {
        session_start();
        isAuth();
        $id= $_SESSION['id'];
        $escoger = Area::belongsTo('propietarioId',$id);
        $router->render('admin/area/escoger' , [
            'titulo' => 'INGRESE A UNA AREA',
            'escoger' => $escoger
        ]);
    }










}