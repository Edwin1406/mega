<?php
namespace Controllers;

use Model\Pedido;

class ApiPedidos {
    public static function api()
    {
        
        $pedido_id= $_GET['pedido_id'] ?? '';
        $pedido_id =filter_var($pedido_id, FILTER_VALIDATE_INT);
    
        if(!$pedido_id){
            echo json_encode([]);
            return;
            
        }

        $pedidos  = Pedido::where('id',$pedido_id);
       
        // $pedidos = Pedido::all();
        echo json_encode($pedidos);
    }

    public static function apipedido2()
    {
        $pedido2_id= $_GET['pedido2_id'] ?? '';
        $pedido2_id =filter_var($pedido2_id, FILTER_VALIDATE_INT);
    
        if(!$pedido2_id){
            echo json_encode([]);
            return;
            
        }

        $pedidos  = Pedido::where('id',$pedido2_id);
       
        // $pedidos = Pedido::all();
        echo json_encode($pedidos);
    }

    public static function Allpedidos()
    {
        $pedidos = Pedido::all('DESC');
        echo json_encode($pedidos);
    }
}