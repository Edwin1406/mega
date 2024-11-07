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
            return;
            
        }

        $test  = Test::find('id',$liner_id);

        echo json_encode($test);

    }


    public static function apibobinas()
    {


        $bobinaInterna_id= $_GET['bobinaInterna_id'] ?? '';
        $bobinaInterna_id =filter_var($bobinaInterna_id, FILTER_VALIDATE_INT);


        if(!$bobinaInterna_id){
            echo json_encode([]);
            return;
            
        }

        $bobina  = Bobina::find('id',$bobinaInterna_id);

        echo json_encode($bobina);
    }





}