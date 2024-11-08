<?php

namespace Controllers;

use Model\Producto;

class ApiProductos {

    public static function productos()
    {
        
        $productos =Producto::topProductos('nombre' , 10); 
        
         echo json_encode($productos);
     
    }
}