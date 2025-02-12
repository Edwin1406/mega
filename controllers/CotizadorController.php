<?php

namespace Controllers;


use MVC\Router;
use Model\Bobina;
use Model\MateriaPrimaV;
use Model\Pedido;
use Model\Produccion;
use Model\Test;

class CotizadorController
{
    public static function index()
    {
        echo 'Desde el controlador de cotizador';
    }

    
    public static function cotizador(Router $router)
    {
       
        session_start();
        isAuth();
        $id= $_SESSION['id'];
        $alertas = [];
        $escoger_produccion = Produccion::belongsTo('propietarioId',$id);
        if(!isAuth()){
            header('Location: /');
            
        }

        $pedidosTrimar = Pedido::all('ASC');
        $router->render('admin/produccion/cotizador/crear', [
            'titulo' => 'COTIZADOR',
            'escoger_produccion' => $escoger_produccion,
            'alertas' => $alertas,
            'pedidosTrimar' => $pedidosTrimar,
        ]);
    }


    // public static function trimar(){
    //     header("Access-Control-Allow-Origin: *");  // Permite solicitudes desde cualquier origen
    //     header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
    //     $pedidosTrimar = Pedido::trimarcj('DESC', 'CJ');
    //     echo json_encode($pedidosTrimar);
    
    // }


    public static function trimarp(Router $router){

        $pedido = Pedido::find($_GET['id']);
        // calcular ancho y largo para CJ
        if(strpos($pedido->nombre_pedido, 'CJ') !== false){
            $largo = $pedido->largo;
            $ancho = $pedido->ancho;
            $alto = $pedido->alto;
            $largoCalculado = (2 * $alto) + ($largo + 8);
            $anchoCalculado = (2 * $alto) + ($ancho + 10 + 4);
            $pedido->largo = $largoCalculado;
            $pedido->ancho = $anchoCalculado;
            unset($pedido->alto); // Se elimina "alto" para los "CJ"
        } elseif(strpos($pedido->nombre_pedido, 'PL') !== false && $pedido->alto == "0"){
            unset($pedido->alto);
        }

        // Obtener todos los pedidos
$todos_pedidos = Pedido::all('ASC');

// Separar pedidos en dos grupos: CJ y PL
$pedidos_cj = [];
$pedidos_pl = [];

foreach ($todos_pedidos as $buscado) {
    if (strpos($buscado->nombre_pedido, 'CJ') !== false) {
        // Calcular dimensiones ajustadas para "CJ"
        $largo = $buscado->largo;
        $ancho = $buscado->ancho;
        $alto = $buscado->alto;

        $largoCalculado = (2 * $alto) + ($largo + 8);
        $anchoCalculado = (2 * $alto) + ($ancho + 10 + 4);

        $buscado->largo = $largoCalculado;
        $buscado->ancho = $anchoCalculado;
        unset($buscado->alto); // Se elimina "alto" para los "CJ"

        $pedidos_cj[] = $buscado; // Se guarda en la lista CJ
    } elseif (strpos($buscado->nombre_pedido, 'PL') !== false) {
        // Para PL, solo se elimina "alto" si es 0
        if ($buscado->alto == "0") {
            unset($buscado->alto);
        }
        $pedidos_pl[] = $buscado; // Se guarda en la lista PL
    }
}

// Lista de bobinas disponibles (ejemplo, puedes modificar)
$bobinas = [1600, 1800, 2000, 2200, 2500];

// Función para encontrar la mejor combinación dentro de un grupo de pedidos
function encontrarMejorCombinacion($pedidos) {
    global $bobinas;
    $mejor_combinacion = null;
    $mejor_suma = PHP_INT_MAX;

    foreach ($pedidos as $pedido_actual) {
        $ancho_actual = $pedido_actual->ancho;
        $test_actual = $pedido_actual->test;
        $flauta_actual = $pedido_actual->flauta;

        foreach ($pedidos as $otro_pedido) {
            if ($pedido_actual->id !== $otro_pedido->id) { // Evitar el mismo pedido
                if ($otro_pedido->test === $test_actual && $otro_pedido->flauta === $flauta_actual) { // Deben coincidir en Test y Flauta
                    $suma_ancho = $ancho_actual + $otro_pedido->ancho;
                    
                    // Buscar la bobina más cercana que pueda acomodar la suma de anchos
                    foreach ($bobinas as $bobina) {
                        if ($suma_ancho <= $bobina && $bobina - $suma_ancho < $mejor_suma) {
                            $mejor_suma = $bobina - $suma_ancho;
                            $mejor_combinacion = [$pedido_actual, $otro_pedido, 'bobina' => $bobina];
                        }
                    }
                }
            }
        }
    }

    return $mejor_combinacion;
}

// Encontrar la mejor combinación en cada grupo
$mejor_combinacion_cj = encontrarMejorCombinacion($pedidos_cj);
$mejor_combinacion_pl = encontrarMejorCombinacion($pedidos_pl);

debuguear($mejor_combinacion_cj);






        // debuguear($pedido_encontrado);
















        
        // debuguear($pedido);
        $router->render('admin/produccion/cotizador/trimar', [
            'titulo' => 'TRIMAR',

            
        ]);



    }
    
    







}