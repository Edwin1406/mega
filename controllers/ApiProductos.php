<?php

namespace Controllers;

use Model\Producto;

class ApiProductos {

    public static function productos()
    {
         // Obtener todos los productos
         $productos = Producto::all();

         // Iterar sobre los productos y obtener el total para cada uno
         foreach ($productos as $producto) {
             // Llamar a topProductos y pasar el ID correctamente
             // Asegúrate de que el id es numérico y se pasa como parámetro adecuado
             $producto->total = Producto::topProductos(['id_producto' => $producto->id]);
         }
 
         // Mostrar el resultado en formato JSON
         echo json_encode($productos);
     
    }
}