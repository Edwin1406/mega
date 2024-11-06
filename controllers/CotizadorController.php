<?php

namespace Controllers;

use MVC\Router;
use Model\Pedido;
use Model\Produccion;

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
        $pedidos_formateados =[];
        foreach($pedidos as $pedido){
            $pedidos_formateados[] = $pedido;
            if($pedido->estado == 'pendiente'){
                $pedidos_formateados['estado'][]=$pedido;
            }

            if($pedido->estado == 'en_produccion'){
                $pedidos_formateados['estado'][]=$pedido;
            }

            if($pedido->estado == 'terminado'){
                $pedidos_formateados['estado'][]=$pedido;
            }

            
            
            
        }
        debuguear($pedidos_formateados);

        // debuguear($pedidos);



        $router->render('admin/produccion/cotizador/crear', [
            'titulo' => 'COTIZADOR',
            'escoger_produccion' => $escoger_produccion,
            'alertas' => $alertas,
            'pedidos' => $pedido
        ]);
    }
}