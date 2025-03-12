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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $movimientos_invetario->sincronizar($_POST);
        // debuguear($movimientos_invetario);
        $alertas = $movimientos_invetario->validar();

        if (empty($alertas)) {
            $movimientos_invetario->guardar();
            $alertas = $movimientos_invetario->getAlertas();
            header('Location: /admin/sistemas/movimientos/movimientos');
        }
    }

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