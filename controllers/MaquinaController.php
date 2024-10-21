<?php

namespace Controllers;

use Model\Maquinas;
use MVC\Router;

 class MaquinaController
 {
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
                    header('Location: /admin/produccion/registro_produccion');

                }
            
        }

         $router->render('admin/produccion/maquinas/crear', [
             'titulo' => 'CREAR MAQUINA',
             'alertas' => $alertas
             
         ]);
     }
 }




?>