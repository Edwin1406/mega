<?php
namespace Controllers;

use Model\Pedido;

class ApiPedidos {
    public static function api()
    {
       
        $pedidos = Pedido::all();
        echo json_encode($pedidos);
    }
}