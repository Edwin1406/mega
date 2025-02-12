<?php

namespace Controllers;


use MVC\Router;
use Model\Bobina;
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

        $tests = Test::all();
        $pedidos = Pedido::all('ASC');
        $totalPedidos = count($pedidos); 
        // debuguear($totalPedidos);
        
        $bobinas = Bobina::all();

        


     

        $router->render('admin/produccion/cotizador/crear', [
            'titulo' => 'COTIZADOR',
            'escoger_produccion' => $escoger_produccion,
            'alertas' => $alertas,
            'pedidos' => $pedidos,
            'bobinas' => $bobinas,
            'tests' => $tests,
            'totalPedidos' => $totalPedidos,
        ]);
    }


    // public static function trimar(){
    //     header("Access-Control-Allow-Origin: *");  // Permite solicitudes desde cualquier origen
    //     header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
    //     $pedidosTrimar = Pedido::trimarcj('DESC', 'CJ');
    //     echo json_encode($pedidosTrimar);
    
    // }


    public static function trimar(){
        header("Access-Control-Allow-Origin: *");  // Permite solicitudes desde cualquier origen
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
    
        $pedidosTrimar = Pedido::all('DESC');
    
        // Modificar los pedidos según las condiciones requeridas
        $pedidosTrimar = array_map(function($pedido){
            // Si el pedido tiene "CJ" en su nombre, realizar los cálculos
            if(strpos($pedido->nombre_pedido, 'CJ') !== false){ 
                $largo = $pedido->largo;
                $ancho = $pedido->ancho;
                $alto = $pedido->alto;
                $largoCalculado = (2 * $alto) + ($largo + 8);
                $anchoCalculado = (2 * $alto) + ($ancho + 10 + 4);
                $pedido->largo = $largoCalculado;
                $pedido->ancho = $anchoCalculado;
                unset($pedido->alto); // Se elimina "alto" para los "CJ"
            }
    
            // Si el pedido tiene "PL" en su nombre y "alto" es "0", eliminar "alto"
            if(strpos($pedido->nombre_pedido, 'PL') !== false && $pedido->alto == "0"){
                unset($pedido->alto);
            }
    
            return $pedido;
        }, $pedidosTrimar);
    
        echo json_encode($pedidosTrimar);
    }
    
    







}