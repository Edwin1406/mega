<?php

namespace Controllers;

use Model\Bobina;
use Model\Test;

class ApiTest {

    public static function api()
    {
        $liner_id= $_GET['liner_id'] ?? '';
        $liner_id =filter_var($liner_id, FILTER_VALIDATE_INT);

        if(!$liner_id){
            echo json_encode([]);
            
        }



    }


    public static function apibobinas()
    {
        $bobina_interna = Bobina::all();
        echo json_encode($bobina_interna);
    }





}