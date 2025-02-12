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

        
        // sumar los anchos de los pedidos para CJ
        $todos_pedidos = Pedido::all('ASC');
        // calcular ancho y largo para CJ
        foreach($todos_pedidos as $buscado){
            if(strpos($buscado->nombre_pedido, 'CJ') !== false){
                $largo = $buscado->largo;
                $ancho = $buscado->ancho;
                $alto = $buscado->alto;
                $largoCalculado = (2 * $alto) + ($largo + 8);
                $anchoCalculado = (2 * $alto) + ($ancho + 10 + 4);
                $buscado->largo = $largoCalculado;
                $buscado->ancho = $anchoCalculado;
                unset($buscado->alto); // Se elimina "alto" para los "CJ"
            } elseif(strpos($buscado->nombre_pedido, 'PL') !== false && $buscado->alto == "0"){
                unset($buscado->alto);
            }
        }
        
        
        
        $bobina = $bobinas;
        $pedido_actual = $pedido;
        $todos = $todos_pedidos;
      

        $bobinas = MateriaPrimaV::datoscompletos('DESC', 'CAJA');

        // Convertir el resultado en un array de valores si es necesario
        $bobinas = array_map(function($bobina) {
            return $bobina->ancho; // Suponiendo que 'ancho' es la propiedad relevante
        }, $bobinas);
        
        // Ordenar bobinas de menor a mayor para optimización
        sort($bobinas);
        
        // Encontrar la combinación óptima de pedidos
        $mejor_combinacion = null;
        $mejor_suma = PHP_INT_MAX;
        
        foreach ($todos_pedidos as $pedido_actual) {
            $ancho_actual = $pedido_actual->ancho;
            
            foreach ($todos_pedidos as $otro_pedido) {
                if ($pedido_actual->id !== $otro_pedido->id) { // Evitar sumar el mismo pedido
                    $suma_ancho = $ancho_actual + $otro_pedido->ancho;
                    
                    // Buscar la bobina más cercana que pueda acomodar la suma de anchos
                    foreach ($bobinas as $bobina) {
                        if ($suma_ancho <= $bobina && $bobina - $suma_ancho < $mejor_suma) {
                            $mejor_suma = $bobina - $suma_ancho;
                            $mejor_combinacion = [
                                'pedido_1' => $pedido_actual, 
                                'pedido_2' => $otro_pedido, 
                                'bobina' => $bobina
                            ];
                        }
                    }
                }
            }
        }
        
        debuguear($mejor_combinacion);
        
        // debuguear($bobina);

        // debuguear($pedido);
        $router->render('admin/produccion/cotizador/trimar', [
            'titulo' => 'TRIMAR',

            
        ]);



    }
    
    







}