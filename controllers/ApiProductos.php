<?php

namespace Controllers;

use Model\Producto;

class ApiProductos {

    public static function productos()
    {
        $productos = Producto::all();
        foreach ($productos as $producto) {
          $producto->total = Producto::totalArray(['nombre'=>$producto->nombre]);
        }
        
         echo json_encode($productos);
     
    }
}