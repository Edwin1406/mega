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

        // Obtener el pedido basado en el ID de la URL
        $pedido = Pedido::find($_GET['id']);
    
        // Calcular ancho y largo para CJ
        if(strpos($pedido->nombre_pedido, 'CJ') !== false){
            $largo = $pedido->largo;
            $ancho = $pedido->ancho;
            $alto = $pedido->alto;
            $largoCalculado = (2 * $alto) + ($largo + 8);
            $anchoCalculado = (2 * $alto) + ($ancho + 10 + 4);
            $pedido->largo = $largoCalculado;
            $pedido->ancho = $anchoCalculado;
            unset($pedido->alto);
        } elseif(strpos($pedido->nombre_pedido, 'PL') !== false && $pedido->alto == "0"){
            unset($pedido->alto);
        }
    
        // Obtener todos los pedidos
        $todos_pedidos = Pedido::all('ASC');
    
        // **FILTRAR** para evitar repetir el pedido actual en la lista
        $otros_pedidos = array_filter($todos_pedidos, function($p) use ($pedido) {
            return $p->id !== $pedido->id;
        });
    
        // Calcular dimensiones de los demás pedidos
        foreach($otros_pedidos as $buscado){
            if(strpos($buscado->nombre_pedido, 'CJ') !== false){
                $largo = $buscado->largo;
                $ancho = $buscado->ancho;
                $alto = $buscado->alto;
                $largoCalculado = (2 * $alto) + ($largo + 8);
                $anchoCalculado = (2 * $alto) + ($ancho + 10 + 4);
                $buscado->largo = $largoCalculado;
                $buscado->ancho = $anchoCalculado;
                unset($buscado->alto);
            } elseif(strpos($buscado->nombre_pedido, 'PL') !== false && $buscado->alto == "0"){
                unset($buscado->alto);
            }
        }
    
        // Obtener bobinas
        $bobinas = MateriaPrimaV::datoscompletos('DESC', 'CAJA');
    
        // Convertir bobinas a array con ID y ancho
        $bobinas = array_map(function($bobina) {
            return [
                'id' => $bobina->id,
                'ancho' => $bobina->ancho
            ];
        }, $bobinas);
    
        // Ordenar bobinas por ancho
        usort($bobinas, function($a, $b) {
            return $a['ancho'] <=> $b['ancho'];
        });
    
        // Encontrar la combinación óptima
        $mejor_combinacion = null;
        $mejor_suma = PHP_INT_MAX;
    
        foreach ($otros_pedidos as $otro_pedido) { // Solo comparar con otros pedidos
            $suma_ancho = $pedido->ancho + $otro_pedido->ancho;
    
            foreach ($bobinas as $bobina) {
                if ($suma_ancho <= $bobina['ancho'] && $bobina['ancho'] - $suma_ancho < $mejor_suma) {
                    $mejor_suma = $bobina['ancho'] - $suma_ancho;
                    $mejor_combinacion = [
                        'pedido_1' => $pedido,  // Pedido seleccionado en la URL
                        'pedido_2' => $otro_pedido, 
                        'bobina' => [
                            'id' => $bobina['id'],
                            'ancho' => $bobina['ancho']
                        ]
                    ];
                }
            }
        }
    
        // Renderizar vista
        $router->render('admin/produccion/cotizador/trimar', [
            'titulo' => 'TRIMAR',
            'mejor_combinacion' => $mejor_combinacion,
        ]);
    }
    







}