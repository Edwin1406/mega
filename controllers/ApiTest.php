<?php

namespace Controllers;

use Model\Bobina;
use Model\Test;

class ApiTest {

    public static function api()
    {
        $liner_id= $_GET['liner_id'] ?? '';
        $liner_id =filter_var($liner_id, FILTER_VALIDATE_INT);

        $bobinaExterna_id= $_GET['bobinaExterna_id'] ?? '';
        $bobinaExterna_id =filter_var($bobinaExterna_id, FILTER_VALIDATE_INT);


        if(!$liner_id){
            echo json_encode([]);
            return;
            
        }

        $test  = Test::find('id',$liner_id);

        echo json_encode($test);

    }


    public static function apibobinas()
    {
        $bobina_interna = Bobina::all();
        echo json_encode($bobina_interna);
    }





}