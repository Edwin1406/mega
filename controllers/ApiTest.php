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


        $bobinaInterna_id= $_GET['bobinaInterna_id'] ?? '';
        $bobinaInterna_id =filter_var($bobinaInterna_id, FILTER_VALIDATE_INT);
    
        if(!$bobinaInterna_id){
            echo json_encode([]);
            return;
            
        }

        $bobina  = Bobina::where('id',$bobinaInterna_id);

        echo json_encode($bobina);
    }

    public static function apibobina_externa()
    {


        $bobinaExterna_id= $_GET['bobinaExterna_id'] ?? '';
        $bobinaExterna_id =filter_var($bobinaExterna_id, FILTER_VALIDATE_INT);
    
        if(!$bobinaExterna_id){
            echo json_encode([]);
            return;
            
        }

        $bobina  = Bobina::where('id',$bobinaExterna_id);

        echo json_encode($bobina);
    }
    public static function apibobina_media()
    {


        $bobinaIntermedia_id= $_GET['bobinaIntermedia_id'] ?? '';
        $bobinaIntermedia_id =filter_var($bobinaIntermedia_id, FILTER_VALIDATE_INT);
    
        if(!$bobinaIntermedia_id){
            echo json_encode([]);
            return;
            
        }

        $bobina  = Bobina::where('id',$bobinaIntermedia_id);

        // $bobina = Bobina::all();

        echo json_encode($bobina);
    }

    public static function allbobinas(){
        header("Access-Control-Allow-Origin: *");  // Permite solicitudes desde cualquier origen
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
        header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Cabeceras permitidas
        $bobinas = Bobina::all();
        echo json_encode($bobinas);
    }





}