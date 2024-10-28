<?php

namespace Controllers;

use Model\Maquinas;


class ApiMaquinas {

    public static function api()
    {
        header("Content-Security-Policy: script-src 'self'; object-src 'none';");
        header('Content-Type: application/json');
        


        $maquinas = Maquinas::all();
        echo json_encode($maquinas);
    }
}