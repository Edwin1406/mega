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


    public static function trimar(){
        header("Access-Control-Allow-Origin: *");  // Permite solicitudes desde cualquier origen
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
        $pedidosTrimar = Pedido::trimarcj('DESC', 'CJ');
        echo json_encode($pedidosTrimar);
    }
    
    public static function trimarp(Router $router) {
        // Obtener el pedido basado en el ID de la URL
        $pedido = Pedido::find($_GET['id']);
    
        // Determinar si es CJ o PL
        $esCJ = strpos($pedido->nombre_pedido, 'CJ') !== false;
        $esPL = strpos($pedido->nombre_pedido, 'PL') !== false;
    
        // Calcular dimensiones si es CJ
        if ($esCJ) {
            $largo = $pedido->largo;
            $ancho = $pedido->ancho;
            $alto = $pedido->alto;
            $pedido->largo = (2 * $alto) + ($largo + 8);
            $pedido->ancho = (2 * $alto) + ($ancho + 10 + 4);
            unset($pedido->alto);
        } elseif ($esPL && $pedido->alto == "0") {
            unset($pedido->alto);
        }
    
        // Obtener todos los pedidos ordenados
        $todos_pedidos = Pedido::all('ASC');
    
        // Filtrar solo pedidos del mismo tipo (CJ con CJ, PL con PL)
        $otros_pedidos = array_filter($todos_pedidos, function ($p) use ($esCJ, $esPL) {
            return ($esCJ && strpos($p->nombre_pedido, 'CJ') !== false) ||
                   ($esPL && strpos($p->nombre_pedido, 'PL') !== false);
        });
    
        // Calcular dimensiones de los demás pedidos si son CJ
        foreach ($otros_pedidos as $buscado) {
            if (strpos($buscado->nombre_pedido, 'CJ') !== false) {
                $largo = $buscado->largo;
                $ancho = $buscado->ancho;
                $alto = $buscado->alto;
                $buscado->largo = (2 * $alto) + ($largo + 8);
                $buscado->ancho = (2 * $alto) + ($ancho + 10 + 4);
                unset($buscado->alto);
            }
        }
    
        // Obtener bobinas y ordenarlas por ancho
        $bobinas = MateriaPrimaV::datoscompletos('DESC', 'CAJA');
        $bobinas = array_map(fn($bobina) => ['id' => $bobina->id, 'ancho' => $bobina->ancho], $bobinas);
        usort($bobinas, fn($a, $b) => $a['ancho'] <=> $b['ancho']);
    
        // Buscar la mejor combinación de pedidos dentro del mismo tipo
        $mejor_combinacion = null;
        $mejor_suma = PHP_INT_MAX;
        $pedido_unico = true;
    
        foreach ($otros_pedidos as $otro_pedido) {
            if ($pedido->id !== $otro_pedido->id) {
                $suma_ancho = $pedido->ancho + $otro_pedido->ancho;
    
                foreach ($bobinas as $bobina) {
                    if ($suma_ancho + 30 <= $bobina['ancho'] && $bobina['ancho'] - $suma_ancho < $mejor_suma) {
                        $mejor_suma = $bobina['ancho'] - $suma_ancho;
                        $mejor_combinacion = [
                            'pedido_1' => $pedido,
                            'pedido_2' => $otro_pedido,
                            'bobina' => ['id' => $bobina['id'], 'ancho' => $bobina['ancho']]
                        ];
                        $pedido_unico = false;
                    }
                }
            }
        }
    
        // Si no hay combinación, buscar la bobina más pequeña que aún cubra el pedido con un margen de 30 mm
        if ($pedido_unico) {
            foreach ($bobinas as $bobina) {
                if ($bobina['ancho'] >= $pedido->ancho + 30) {
                    $mejor_combinacion = [
                        'pedido_1' => $pedido,
                        'pedido_2' => null,
                        'bobina' => ['id' => $bobina['id'], 'ancho' => $bobina['ancho']]
                    ];
                    break;
                }
            }
    
            // Verificar que la bobina seleccionada sea válida
            if (!$mejor_combinacion || $mejor_combinacion['bobina']['ancho'] < $pedido->ancho + 30) {
                $mejor_combinacion['bobina'] = null; // No hay bobina válida
            }
        }
    
        // Renderizar vista
        $router->render('admin/produccion/cotizador/trimar', [
            'titulo' => 'TRIMAR',
            'mejor_combinacion' => $mejor_combinacion,
        ]);
    }
    

}