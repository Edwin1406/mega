<?php

namespace Controllers;

use Model\Categoria_inventario;
use Model\Movimientos_inventario;
use Model\Productos_inventario;
use MVC\Router;

class SistemasController {

    public static function index(Router $router)
    {
        $router->render('admin/sistemas/index', [
            'titulo' => 'INVENTARIO DE SISTEMAS',
        ]);
    }


    public static function crear(Router $router)
    {


        $productos_inventario = new Productos_inventario;
        $categoria_inventario = Categoria_inventario:: allSis('categoria', 'ASC');

        // debuguear($categoria_inventario);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productos_inventario->sincronizar($_POST);


            // debuguear($productos_inventario);

            // debuguear($comercial);
            $alertas = $productos_inventario->validar();

            // debuguear($comercial);

           if (empty($alertas)) {
                $productos_inventario->guardar();
                $alertas = $productos_inventario->getAlertas();
                header('Location: /admin/sistemas/productos/tabla');
            }


        }

        $alertas = [];
        $router->render('admin/sistemas/productos/crear', [
            'titulo' => 'CREAR PRODUCTO',
            'alertas' => $alertas,
            'categoria_inventario' => $categoria_inventario,
        ]);
    }




// movimientos 


public static function movimientos(Router $router)
{

    
    $movimientos_inventario = new Movimientos_inventario;
    // debuguear($movimientos_inventario);
    $categoria_inventario = Categoria_inventario:: allSis('categoria', 'ASC');

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $movimientos_inventario->sincronizar($_POST);


        debuguear($movimientos_inventario);

        // debuguear($comercial);
        $alertas = $movimientos_inventario->validar();

        // debuguear($comercial);

       if (empty($alertas)) {
            $movimientos_inventario->guardar();
            $alertas = $movimientos_inventario->getAlertas();
            header('Location: /admin/sistemas/productos/tabla');
        }


    }

    $alertas = [];
    $router->render('admin/sistemas/movimiento/movimientos', [
        'titulo' => 'MOVIMIENTOS DE PRODUCTOS',
        'alertas' => $alertas,
    ]);
}










}