<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function pagina_actual($path):bool{
    return str_contains($_SERVER['REQUEST_URI'] ?? '/', $path) ? true : false;

}

function isAuth() : bool {
    // si existe una sesion iniciada
    if(!isset($_SESSION)){
        session_start();
    }
    return isset($_SESSION['nombre'])&& isset($_SESSION);
}
function isAdmin() : bool {
    if(!isset($_SESSION)){
        session_start();
    }
    return isset($_SESSION['admin'])&& !empty($_SESSION['admin']);
}



function aos_animation():void{
    $efectos = ['fade-up', 'fade-down', 'fade-left', 'fade-right', 'fade-up-right', 'fade-up-left', 'fade-down-right', 'fade-down-left', 'flip-up', 'flip-down', 'flip-left', 'flip-right', 'slide-up', 'slide-down', 'slide-left', 'slide-right', 'zoom-in', 'zoom-in-up', 'zoom-in-down', 'zoom-in-left', 'zoom-in-right', 'zoom-out', 'zoom-out-up', 'zoom-out-down', 'zoom-out-left', 'zoom-out-right'];
    $efecto= array_rand($efectos, 1);
    echo $efectos[$efecto];
}

