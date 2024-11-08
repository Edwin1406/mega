<?php

namespace Controllers;

use Model\Producto;

class ApiProductos {

    public static function productos()
    {
        $productos = Producto::all();
        foreach ($productos as $producto) {
          
            $productos =Producto::topProductos($producto->id); 
        }
        
         echo json_encode($productos);
     
    }
}