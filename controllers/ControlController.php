<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Control;
use MVC\Router;

use function Model\convertirHoraADecimal;

class ControlController {

    public static function crear(Router $router)
    {

        session_start();
        isAuth();

        $control = new Control;
        $alertas = [];

        // post 
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Primero sincroniza con los datos del formulario
            $control->sincronizar($_POST);

            // Luego realiza el cálculo
            $golpes_maquina_hora = 0;
            
            if (!empty($control->horas_programadas) && !empty($control->golpes_maquina)) {
                $horas_decimal = convertirHoraADecimal($control->horas_programadas);
                
                if ($horas_decimal > 0) {
                    $golpes_maquina_hora = $control->golpes_maquina / $horas_decimal;
                }
            }

            $control->golpes_maquina_hora = $golpes_maquina_hora;

            // debuguear($control);

            // Validar
            $alertas = $control->validar();

            if (empty($alertas)) {
                // Guardar en la base de datos
                $resultado = $control->guardar();
                if ($resultado) {
                    header('Location: /admin/control/crear');
                }
            } else {
                // Mostrar alertas
                $alertas = Control::getAlertas();
            }
        }


        $router->render('admin/control/crear' , [
            'titulo' => 'CONTROL DE PRODUCCION',
            'alertas' => $alertas,
            'control' => $control
        ]);

    }


// TABLA 
    public static function tabla(Router $router)
    {
        session_start();
        isAuth();

        $control = Control::all();

          $pagina_actual = $_GET['page'];
            $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
            // debuguear($pagina_actual);

            if(!$pagina_actual|| $pagina_actual <1){
                header('Location: /admin/control/tabla?page=1');
                exit;
            }
            
            $pagina_por_registros = 5;
            $total = Control:: total();
            $paginacion = new Paginacion($pagina_actual, $pagina_por_registros, $total);
            if($paginacion->total_paginas() < $pagina_actual){
                header('Location: /admin/control/tabla?page=1');
            }
        
            $control = Control::paginar($pagina_por_registros, $paginacion->offset());

        // debuguear($control);

        $router->render('admin/control/tabla', [
            'titulo' => 'TABLA DE CONTROL DE PRODUCCION',
            'control' => $control,
            'paginacion' => $paginacion->paginacion()
        ]);
    }



    public static function apicontroldeproduccion(Router $router)
    {  
        $control = Control::all();

        header('Content-Type: application/json');
        // CORS
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        // debuguear($control);
        echo json_encode($control);
    }
















}