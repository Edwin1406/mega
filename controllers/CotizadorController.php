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
        $pedido_buscado = Pedido::all('ASC');
        // calcular ancho y largo para CJ
        foreach($pedido_buscado as $buscado){
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
        
        $bobinas = MateriaPrimaV::datoscompletos('DESC', 'CAJA');


        $bobina = $bobinas;
        $pedido_actual = $pedido;
        $pedido_encontrado = $pedido_buscado;


        $pedido_optimo = null;
        foreach($pedido_buscado as $buscado){
            // hacer un bucle para encontrar el pedido optimo sumando el ancho  del pdido actual con los demas pedidos anchos de los pedidos  y comparar la suma  con las bobinas y ver el mas optimo
            
            $ancho_pedido_actual = $pedido_actual->ancho;
            $ancho_pedido_buscado = $buscado->ancho;

            $suma_anchos = $ancho_pedido_actual + $ancho_pedido_buscado;
            $bobina_encontrada = null;
            foreach($bobina as $bobi){
                if($bobi->ancho >= $suma_anchos){
                    $bobina_encontrada = $bobi;
                    break;
                }
            }

            if($bobina_encontrada){
                if(!$pedido_optimo){
                    $pedido_optimo = $buscado;
                    $pedido_optimo->bobina = $bobina_encontrada;
                } else {
                    $ancho_pedido_optimo = $pedido_optimo->ancho;
                    $suma_anchos_optimo = $ancho_pedido_optimo + $pedido_optimo->ancho;
                    if($suma_anchos < $suma_anchos_optimo){
                        $pedido_optimo = $buscado;
                        $pedido_optimo->bobina = $bobina_encontrada;
                    }
                }
            }

        }


        debuguear($pedido_optimo);
        // debuguear($bobina);









        // debuguear($pedido_encontrado);
















        
        // debuguear($pedido);
        $router->render('admin/produccion/cotizador/trimar', [
            'titulo' => 'TRIMAR',

            
        ]);



    }
    
    







}