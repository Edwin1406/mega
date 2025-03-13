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
public static function movimientos(Router $router) {
    $alertas = [];
    $productos_inventario = Productos_inventario::all('DESC');
    $area_inventario = Area_inventario::allSis('area', 'ASC');
    $categoria_inventario = Categoria_inventario::allSis('categoria', 'ASC');

    $movimientos_invetario = new Movimientos_inventario;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica que los datos del POST lleguen correctamente
        $movimientos_invetario->sincronizar($_POST);

        // tipo_movimiento es entrada se suma al stock_actual de productos_inventario caso contrario se resta
        if ($movimientos_invetario->tipo_movimiento === 'Entrada') {
            $productos_inventario = Productos_inventario::find($movimientos_invetario->id_producto);
            debuguear($productos_inventario);
            $productos_inventario->stock_actual += $movimientos_invetario->cantidad;
            $productos_inventario->guardar();
        } else {
            $productos_inventario = Productos_inventario::find($movimientos_invetario->id_producto);
            $productos_inventario->stock_actual -= $movimientos_invetario->cantidad;
            $productos_inventario->guardar();
        }
        // debuguear($movimientos_invetario);
    }

    $router->render('admin/sistemas/movimiento/movimientos', [
        'titulo' => 'MOVIMIENTOS DE PRODUCTOS',
        'alertas' => $alertas,
        'productos_inventario' => $productos_inventario,
        'area_inventario' => $area_inventario,
        'categoria_inventario' => $categoria_inventario,
    ]);
}









}