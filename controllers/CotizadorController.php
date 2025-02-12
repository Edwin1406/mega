<?php

namespace Controllers;


use MVC\Router;
use Model\Bobina;
use Model\MateriaPrimaV;
use Model\Pedido;
use Model\Produccion;
use Model\Test;

class CotizadorController
{
    public static function index()
    {
        echo 'Desde el controlador de cotizador';
    }

    
    public static function cotizador(Router $router)
    {
       
        session_start();
        isAuth();
        $id= $_SESSION['id'];
        $alertas = [];
        $escoger_produccion = Produccion::belongsTo('propietarioId',$id);
        if(!isAuth()){
            header('Location: /');
            
        }

        $pedidosTrimar = Pedido::all('ASC');
        $router->render('admin/produccion/cotizador/crear', [
            'titulo' => 'COTIZADOR',
            'escoger_produccion' => $escoger_produccion,
            'alertas' => $alertas,
            'pedidosTrimar' => $pedidosTrimar,
        ]);
    }


    // public static function trimar(){
    //     header("Access-Control-Allow-Origin: *");  // Permite solicitudes desde cualquier origen
    //     header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
    //     $pedidosTrimar = Pedido::trimarcj('DESC', 'CJ');
    //     echo json_encode($pedidosTrimar);
    
    // }


    public static function trimarp(Router $router){

        $bobinas = MateriaPrimaV::all('ASC');
        $bobinaOptima = null;
        $minDesperdicio = PHP_INT_MAX;
        
        foreach ($bobinas as $bobina) {
            $anchoBobina = $bobina->ancho;
            $largoBobina = $bobina->largo;
            
            $anchoTotal = $pedido->ancho + ($pedidoDupla ? $pedidoDupla->ancho : 0);
            $largoTotal = max($pedido->largo, $pedidoDupla ? $pedidoDupla->largo : 0);
            
            if ($anchoBobina >= $anchoTotal && $largoBobina >= $largoTotal) {
                $desperdicio = ($anchoBobina - $anchoTotal) + ($largoBobina - $largoTotal);
                
                if ($desperdicio < $minDesperdicio) {
                    $minDesperdicio = $desperdicio;
                    $bobinaOptima = $bobina;
                }
            }
        }
        

        
        debuguear($bobinaOptima);
        $router->render('admin/produccion/cotizador/trimar', [
            'titulo' => 'TRIMAR',

            
        ]);



    }
    
    







}