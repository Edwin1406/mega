<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Control;
use MVC\Router;

use function Model\calcularGolpesPorHoraExcelEstilo;
use function Model\convertirHoraADecimal;

class ControlController {

 public static function crear(Router $router)
{
    session_start();
    isAuth();

    $control = new Control;
    $token = $_GET['id'] ?? '';
    $alertas = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sincronizar datos del formulario
        $control->sincronizar($_POST);

        // Calcular golpes por hora (basado en que 2.604 = 2604 golpes)
        $control->golpes_maquina_hora = self::calcularGolpesPorHoraEntero(
            $control->horas_programadas,
            $control->golpes_maquina
        );

        // Validar
        $alertas = $control->validar();

        if (empty($alertas)) {
            $resultado = $control->guardar();
            if ($resultado) {
                header('Location: /admin/control/tabla?id=' . $token);
                exit;
            }
        } else {
            $alertas = Control::getAlertas();
        }
    }

    $router->render('admin/control/crear', [
        'titulo' => 'CONTROL DE PRODUCCIÓN',
        'alertas' => $alertas,
        'control' => $control,
        'token' => $token
    ]);
}


private static function calcularGolpesPorHoraEntero($hora, $golpes)
 {
    list($h, $m) = explode(":", $hora);
    $horasDecimales = $h + ($m / 60);
    $golpesReales = (int)str_replace(".", "", $golpes); // punto = separador de miles
    if ($horasDecimales == 0) return 0;
    return round($golpesReales / $horasDecimales);
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














}