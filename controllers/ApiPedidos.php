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
        $resultados = []; // Arreglo para guardar todos los resultados
    
        foreach ($pedidos as $pedido) {
            // Accede a la propiedad 'nombre' del objeto Producto
            $cadena = $pedido->nombre_producto;
    
            $resultado = [];
    
            // Expresión regular para las dimensiones
            if (preg_match('/(\d+)X(\d+)X(\d+)/', $cadena, $dimensiones)) {
                $resultado['Largo'] = $dimensiones[1];
                $resultado['Ancho'] = $dimensiones[2];
                $resultado['Altura'] = $dimensiones[3];
            }
    
            // Expresión regular para "K/K" y "TEST"
            if (preg_match('/K\/K\s+(\w+)\s+TEST\s+(\d+)/i', $cadena, $kk_match)) {
                $resultado['lamina'] = $kk_match[1]; // Extrae "K/K" o cualquier texto adicional
                $resultado['test'] = $kk_match[2];   // Extrae el valor numérico después de "TEST"
            }
    
            // Agregar el resultado procesado al arreglo de resultados
            $resultados[] = $resultado;
        }
    
        // Muestra todos los resultados al final
        // debuguear($resultados);
        echo json_encode($resultados);
    }
    
    
    



}