<?php

namespace Controllers;

use DateTime;
use Model\Control;
use Model\ControlEmpaque;
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
// public static function crearEmpaque(Router $router)
// {
//     session_start();
//     isAuth();

//     $resultado = $_GET['resultado'] ?? null;

//     $control = new ControlEmpaque;
//     $token = $_GET['id'] ?? '';
//     $alertas = [];

//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//          if (isset($_POST['personal']) && is_array($_POST['personal'])) {
//         $_POST['personal'] = implode(' - ', $_POST['personal']);
//     }
//         $control->sincronizar($_POST);


//         // horas trabajadas
//         $control->sacarTotalHoras();


//         // debuguear($control->total_horas);

//         // quiero sacar la prodctividad por hora
// // ya tengo // cantidad y total_horas
//         if ($control->cantidad > 0 && $control->total_horas > 0) {
//             $control->x_hora = $control->cantidad / $control->total_horas;
//         } else {
//             $control->x_hora = 0;
//         }

//         // debuguear($control->x_hora); 

//         // Validar campos específicos si es necesario
//         $alertas = $control->validar();

//         if (empty($alertas)) {
//             $resultado = $control->guardar();
//             if ($resultado) {
//                 header('Location: /admin/controlEmpaque/crear?resultado=1');
//             }
//         } else {
//             $alertas = Control::getAlertas();
//         }
//     }

//     $router->render('admin/controlEmpaque/crear', [
//         'titulo' => 'CONTROL DE EMPAQUE',
//         'alertas' => $alertas,
//         'control' => $control,
//         'token' => $token,
//         'resultado' => $resultado,
//     ]);
public static function crearEmpaque(Router $router)
{
    session_start();
    isAuth();

    $resultado = $_GET['resultado'] ?? null;

    $control = new ControlEmpaque;
    $token = $_GET['id'] ?? '';
    $alertas = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['personal']) && is_array($_POST['personal'])) {
            $_POST['personal'] = implode(' - ', $_POST['personal']);
        }

        $control->sincronizar($_POST);

        // 🕒 Calcular total_horas si no viene calculado
        // Este paso se omite si ya tienes $control->total_horas calculado previamente
        $control->sacarTotalHoras(); // Asegúrate que este método establezca correctamente total_horas como decimal

        // ✅ Calcular productividad cada 15 minutos
        $cantidad = is_numeric($control->cantidad) ? (float)$control->cantidad : 0;
        $minutos_trabajados = $control->total_horas * 60;

        if ($cantidad > 0 && $minutos_trabajados > 0) {
            $control->x_hora = ($cantidad / $minutos_trabajados) * 15;
        } else {
            $control->x_hora = 0;
        }

        debuguear($control->x_hora);

        // Validar campos
        $alertas = $control->validar();

        if (empty($alertas)) {
            $resultado = $control->guardar();
            if ($resultado) {
                header('Location: /admin/controlEmpaque/crear?resultado=1');
                return;
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