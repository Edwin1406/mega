<?php

namespace Controllers;

use Model\Producto;

class ApiProductos {

    public static function productos()
    {
        
             $productos =Producto::topProductos('cantidad'); 
         

        //  debuguear($productos);
       
 
         // Mostrar el resultado en formato JSON
         echo json_encode($productos);
     
    }
}