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

        $test  = Test::where('id',$liner_id);

        echo json_encode($test);

    }


    public static function apibobinas()
{
    $bobinaInterna_id = $_GET['bobinaInterna_id'] ?? '';
    $bobinaInterna_id = filter_var($bobinaInterna_id, FILTER_VALIDATE_INT);

    $bobinaExterna_id = $_GET['bobinaExterna_id'] ?? '';
    $bobinaExterna_id = filter_var($bobinaExterna_id, FILTER_VALIDATE_INT);

    if (!$bobinaInterna_id && !$bobinaExterna_id) {
        echo json_encode([]);
        return;
    }

    $resultados = [];

    if ($bobinaInterna_id) {
        $bobinaInterna = Bobina::where('id', $bobinaInterna_id);
        if ($bobinaInterna) {
            $resultados[] = $bobinaInterna;
        }
    }

    if ($bobinaExterna_id) {
        $bobinaExterna = Bobina::where('id', $bobinaExterna_id);
        if ($bobinaExterna) {
            $resultados[] = $bobinaExterna;
        }
    }

    echo json_encode($resultados);
}






}