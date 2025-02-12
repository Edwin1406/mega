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
    public static function trimarp(Router $router) {
        // Obtener el pedido basado en el ID de la URL
        $pedido = Pedido::find($_GET['id']);
    
        // Calcular dimensiones si es CJ
        if (strpos($pedido->nombre_pedido, 'CJ') !== false) {
            $largo = $pedido->largo;
            $ancho = $pedido->ancho;
            $alto = $pedido->alto;
            $largoCalculado = (2 * $alto) + ($largo + 8);
            $anchoCalculado = (2 * $alto) + ($ancho + 10 + 4);
            $pedido->largo = $largoCalculado;
            $pedido->ancho = $anchoCalculado;
            unset($pedido->alto);
        } elseif (strpos($pedido->nombre_pedido, 'PL') !== false && $pedido->alto == "0") {
            unset($pedido->alto);
        }
    
        // Obtener todos los pedidos y filtrar según el tipo del pedido actual
        $todos_pedidos = Pedido::all('ASC');
    
        $otros_pedidos = array_filter($todos_pedidos, function ($p) use ($pedido) {
            $esCJ = strpos($pedido->nombre_pedido, 'CJ') !== false;
            $esPL = strpos($pedido->nombre_pedido, 'PL') !== false;
    
            // Filtrar solo pedidos del mismo tipo (CJ con CJ, PL con PL)
            return ($esCJ && strpos($p->nombre_pedido, 'CJ') !== false) ||
                   ($esPL && strpos($p->nombre_pedido, 'PL') !== false);
        });
    
        // Calcular dimensiones de los demás pedidos si son CJ
        foreach ($otros_pedidos as $buscado) {
            if (strpos($buscado->nombre_pedido, 'CJ') !== false) {
                $largo = $buscado->largo;
                $ancho = $buscado->ancho;
                $alto = $buscado->alto;
                $largoCalculado = (2 * $alto) + ($largo + 8);
                $anchoCalculado = (2 * $alto) + ($ancho + 10 + 4);
                $buscado->largo = $largoCalculado;
                $buscado->ancho = $anchoCalculado;
                unset($buscado->alto);
            }
        }
    
        // Obtener bobinas
        $bobinas = MateriaPrimaV::datoscompletos('DESC', 'CAJA');
    
        // Convertir bobinas a array con ID y ancho
        $bobinas = array_map(function ($bobina) {
            return [
                'id' => $bobina->id,
                'ancho' => $bobina->ancho
            ];
        }, $bobinas);
    
        // Ordenar bobinas por ancho
        usort($bobinas, function ($a, $b) {
            return $a['ancho'] <=> $b['ancho'];
        });
    
        // Buscar la mejor combinación solo dentro del mismo tipo (CJ-CJ o PL-PL)
        $mejor_combinacion = null;
        $mejor_suma = PHP_INT_MAX;
        $pedido_unico = true; // Indica si no se encontró otro pedido compatible
    
        foreach ($otros_pedidos as $otro_pedido) {
        // Si no se encontró combinación, se muestra solo el pedido seleccionado
                if ($pedido_unico) {
                    // Filtrar bobinas que tengan un ancho mayor o igual al pedido
                    $bobina_compatible = array_filter($bobinas, function($b) use ($pedido) {
                        return $b['ancho'] >= $pedido->ancho;
                    });

                    // Tomar la bobina más pequeña que aún sirva
                    $bobina_seleccionada = !empty($bobina_compatible) ? reset($bobina_compatible) : null;

                    // Si no hay bobina adecuada, asignar null para manejarlo en la vista
                    $mejor_combinacion = [
                        'pedido_1' => $pedido,
                        'pedido_2' => null, // No hay otro pedido
                        'bobina' => $bobina_seleccionada ? $bobina_seleccionada : ['id' => 'N/A', 'ancho' => 'N/A']
                    ];
                }

        }
    
        // Si no se encontró combinación, se muestra solo el pedido seleccionado
        if ($pedido_unico) {
            $mejor_combinacion = [
                'pedido_1' => $pedido,
                'pedido_2' => null, // No hay otro pedido
                'bobina' => [
                    'id' => $bobinas[0]['id'], // Usar la bobina más pequeña disponible
                    'ancho' => $bobinas[0]['ancho']
                ]
            ];
        }
    
        // Renderizar vista
        $router->render('admin/produccion/cotizador/trimar', [
            'titulo' => 'TRIMAR',
            'mejor_combinacion' => $mejor_combinacion,
        ]);
    }
    




}