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
        $token = $_GET['id'] ?? '';
        // debuguear($token);

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
                    header('Location: /admin/control/tabla?id='. $token);
                }
            } else {
                // Mostrar alertas
                $alertas = Control::getAlertas();
            }
        }


        $router->render('admin/control/crear' , [
            'titulo' => 'CONTROL DE PRODUCCION',
            'alertas' => $alertas,
            'control' => $control,
            'token' => $token
        ]);

    }


// TABLA 
    public static function tabla(Router $router)
    {
        session_start();
        isAuth();


        $control = Control::all();


      

        // debuguear($control);

        $router->render('admin/control/tabla', [
            'titulo' => 'TABLA DE CONTROL DE PRODUCCION',
            'control' => $control,
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