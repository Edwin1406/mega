<?php

namespace Controllers;

use Model\Area_inventario;
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

    $productos_inventario = Productos_inventario:: allSis('producto', 'DESC');
    $area_inventario = Area_inventario:: allSis('area', 'ASC');

    $movimientos_invetario = new Movimientos_inventario;
// debuguear($productos_inventario);

    // $movimientos = new Movimientos_inventario;
    // // debuguear($movimientos_inventario);
    // // $categoria_inventario = Categoria_inventario:: allSis('categoria', 'ASC');

    
    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     $movimientos->sincronizar($_POST);


    //     debuguear($movimientos);

    //     // debuguear($comercial);
    //     $alertas = $movimientos->validar();

    //     // debuguear($comercial);

    //    if (empty($alertas)) {
    //         $movimientos->guardar();
    //         $alertas = $movimientos->getAlertas();
    //         header('Location: /admin/sistemas/productos/tabla');
    //     }


    // }

    // var_dump(class_exists('Model\Movimientos_inventario'));


    $alertas = [];
    $router->render('admin/sistemas/movimiento/movimientos', [
        'titulo' => 'MOVIMIENTOS DE PRODUCTOS',
        'alertas' => $alertas,
        'productos_inventario' => $productos_inventario,
        'area_inventario' => $area_inventario,
        'movimientos_invetario' => $movimientos_invetario,
    ]);
}










}