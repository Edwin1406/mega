<?php

namespace Controllers;

use Model\Producto;

class ApiProductos {

    public static function productos()
    {
         // Obtener todos los productos
         $productos = Producto::all();
         foreach ($productos as $producto) {
             $producto->total =Producto::topProductos('cantidad'); 
         }

         debuguear($productos);
       
 
         // Mostrar el resultado en formato JSON
         echo json_encode($productos);
     
    }
}