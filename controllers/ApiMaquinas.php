<?php

namespace Controllers;

use Model\Maquinas;
use MVC\Router;

class ApiMaquinas {

    public static function api(Router $router)
    {
        $maquinas = Maquinas::all();
        $maquinas = json_encode($maquinas);
    }
}