<?php

namespace Controllers;

use Model\Test;

class ApiTest {

    public static function api()
    {
        $tests = Test::all();
        echo json_encode($tests);
    }
}