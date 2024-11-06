<?php

namespace Controllers;

use MVC\Router;
use Model\Bobina;
use Model\Pedido;
use Model\Produccion;
use Model\TestLiner;

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

        $pedidos = Pedido::all('DESC');
        $bobinas = Bobina::all('DESC');
        // $tests = TestLiner::all('DESC');

     

        $router->render('admin/produccion/cotizador/crear', [
            'titulo' => 'COTIZADOR',
            'escoger_produccion' => $escoger_produccion,
            'alertas' => $alertas,
            'pedidos' => $pedidos,
            'bobinas' => $bobinas
        ]);
    }
}