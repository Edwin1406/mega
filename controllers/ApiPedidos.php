<?php
namespace Controllers;

use Model\Pedido;
use Model\Producto;

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
        $pedidos = Pedido::all('ASC');
        echo json_encode($pedidos);
    }


    // public static function Allpedidos2()
    // {
    //     // header("Access-Control-Allow-Origin: *");  // Permite solicitudes desde cualquier origen
    //     // header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
    //     // header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Cabeceras permitidas
    //     // $pedidos = Producto::all('ASC');
    //     // debuguear($pedidos);
       
        
    // }


    public static function Allpedidos2()
{
    header("Access-Control-Allow-Origin: *");  // Permite solicitudes desde cualquier origen
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
    header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Cabeceras permitidas

    $pedidos = Producto::all('ASC');

    foreach ($pedidos as $pedido) {
        // Cadena de ejemplo
        $cadena = $pedido['nombre']; // Asegúrate de que la propiedad sea el nombre adecuado

        // Expresión regular para las dimensiones
        if (preg_match('/(\d+)X(\d+)X(\d+)/', $cadena, $dimensiones)) {
            $largo = $dimensiones[1];
            $ancho = $dimensiones[2];
            $altura = $dimensiones[3];
        }

        // Expresión regular para el valor K/K
        if (preg_match('/K\/K TEST (\d+)/i', $cadena, $kk_match)) {
            $k_k = $kk_match[1];
        }

        // Muestra los resultados
        debuguear([
            'Largo' => $largo ?? null,
            'Ancho' => $ancho ?? null,
            'Altura' => $altura ?? null,
            'K/K' => $k_k ?? null
        ]);
    }
}




}