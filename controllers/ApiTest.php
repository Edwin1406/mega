<?php

namespace Controllers;

use Model\Bobina;
use Model\Test;

class ApiTest {

    public static function api()
    {
        $tests = Test::all();
        echo json_encode($tests);
    }


    public static function apibobinainterna()
    {
        $bobina_interna = Bobina::all();
        echo json_encode($bobina_interna);
    }





}