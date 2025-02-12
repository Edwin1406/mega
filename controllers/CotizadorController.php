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

        $pedido_actual = $pedido;

        // sumar los anchos de los pedidos para CJ
        $pedido_buscado = Pedido::all('ASC');
        // calcular ancho y largo para CJ
        foreach($pedido_buscado as $pedido){
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
        }

        debuguear($pedido_buscado);









        // bobinas para CJ
        $bobinas = MateriaPrimaV::all('ASC');

        //   ejemplo 
        

        // pedido 2 100x100x100
        // pedido 1 100x100x100

        // Pedido 1 calculado largo y ancho    116x116
        // Pedido 2 calculado largo y ancho   116x116

        // ojo los dos pedidos para jusntarse deben ser CJ y tambie puede juntarse si tienen el mismo ancho y largo

        // sumar anchos 
        // 116 + 116 = 232

        // buscar bobina que tenga 232 de anchos puede ser mayor o igual a 232 mayor por 50mm
        // 232 + 50 = 282










        
        debuguear($pedido);
        $router->render('admin/produccion/cotizador/trimar', [
            'titulo' => 'TRIMAR',

            
        ]);



    }
    
    







}