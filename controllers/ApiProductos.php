<?php

namespace Controllers;

use Model\Producto;

class ApiProductos {

    public static function productos()
    {
        $productos = Producto::all();
        foreach ($productos as $producto) {
           
            $productos->total = Producto::topProductos($producto->id); // Almacenar la información
        }
        
        echo json_encode($productos);
    }
    
}