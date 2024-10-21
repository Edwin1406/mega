<?php

namespace Controllers;

use Model\Maquinas;


class ApiMaquinas {

    public static function api()
    {
        $maquinas = Maquinas::all();
        echo json_encode($maquinas);
    }
}