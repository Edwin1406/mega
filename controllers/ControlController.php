<?php

namespace Controllers;

use Model\Control;
use MVC\Router;



class ControlController {

    public static function crear(Router $router)
    {

        session_start();
        isAuth();
        // debuguear($token);
        
        // get resultado 
        $resultado = $_GET['resultado'] ?? null;


        $control = new Control;
        $token = $_GET['id'] ?? '';
        $alertas = [];

        // post 
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $control->sincronizar($_POST);

if ($control->horas_programadas > 0) {
    // Convertir solo para el cálculo
    $horasDecimal = $control->convertirHorasADecimal($control->horas_programadas);
    
    // Validar que el resultado de conversión sea mayor a 0
    if ($horasDecimal > 0) {
        $control->golpes_maquina_hora = $control->golpes_maquina / $horasDecimal;
    } else {
        $control->golpes_maquina_hora = 0;
    }
} else {
    $control->golpes_maquina_hora = 0;
}

        // debuguear($control);
    // debuguear($control->golpes_maquina_hora);

    $alertas = $control->validar();

    if (empty($alertas)) {
        $resultado = $control->guardar();
        if ($resultado) {
            // resu
        header('Location: /admin/control/crear?resultado=1');

        }
    } else {
        $alertas = Control::getAlertas();
    }
}


        $router->render('admin/control/crear' , [
            'titulo' => 'CONTROL DE PRODUCCION',
            'alertas' => $alertas,
            'control' => $control,
            'token' => $token,
            'resultado' => $resultado,
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



    // public static function apicontroldeproduccion(Router $router)
    // {  
    //     $control = Control::all();

    //     header('Content-Type: application/json');
    //     // CORS
    //     header('Access-Control-Allow-Origin: *');
    //     header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    //     header('Access-Control-Allow-Headers: Content-Type, Authorization');
    //     // debuguear($control);
    //     echo json_encode($control);
    // }


public static function apicontroldeproduccion(Router $router)
{  
    $control = Control::all();

    // Convertir campos numéricos en cada objeto
    foreach ($control as $registro) {
        // fecha date
        $registro->golpes_maquina = (int)$registro->golpes_maquina;
        $registro->golpes_maquina_hora = (float)$registro->golpes_maquina_hora;
        $registro->cambios_medida = (int)$registro->cambios_medida;
        $registro->cantidad_separadores = (int)$registro->cantidad_separadores;
        $registro->cantidad_cajas = (int)$registro->cantidad_cajas;
        $registro->cantidad_papel = (int)$registro->cantidad_papel;
        $registro->desperdicio_kg = (float)$registro->desperdicio_kg;
    }

    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');

    echo json_encode($control);
}



// CONTROL DE EMPAQUE
public static function crearEmpaque(Router $router)
{
    session_start();
    isAuth();

    $resultado = $_GET['resultado'] ?? null;

    $control = new Control;
    $token = $_GET['id'] ?? '';
    $alertas = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $control->sincronizar($_POST);

        // Validar campos específicos si es necesario
        $alertas = $control->validar();

        if (empty($alertas)) {
            $resultado = $control->guardar();
            if ($resultado) {
                header('Location: /admin/controlEmpaque/crear?resultado=1');
            }
        } else {
            $alertas = Control::getAlertas();
        }
    }

    $router->render('admin/controlEmpaque/crear', [
        'titulo' => 'CONTROL DE EMPAQUE',
        'alertas' => $alertas,
        'control' => $control,
        'token' => $token,
        'resultado' => $resultado,
    ]);





}







}