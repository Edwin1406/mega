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
    debuguear($productos_inventario);
    $area_inventario = Area_inventario:: allSis('area', 'ASC');
    $categoria_inventario = Categoria_inventario:: allSis('categoria', 'ASC');
    

    $movimientos_invetario = new Movimientos_inventario;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $movimientos_invetario->sincronizar($_POST);
        // debuguear($movimientos_invetario);
        $alertas = $movimientos_invetario->validar();
        // Comprobamos el tipo de movimiento
        if ($movimientos_invetario->tipo_movimiento === 'Salida') {

            $id=$movimientos_invetario->id_producto;
            // Si es una salida, verificamos si la cantidad solicitada es mayor al stock actual
            $producto = Productos_inventario::findSis($id);
            if ($movimientos_invetario->cantidad > $producto->stock_actual) {
                $alertas[] = 'La cantidad de salida es mayor al stock actual';
            } else {
                // Si la salida es válida, restamos la cantidad al stock actual
                $producto->stock_actual -= $movimientos_invetario->cantidad;
                $producto->guardar();  // Guardamos el producto con el stock actualizado
            }
        } elseif ($movimientos_invetario->tipo_movimiento === 'Entrada') {
            $id = $movimientos_invetario->id_producto;

            // Si es una entrada, sumamos la cantidad al stock actual
            $producto = Productos_inventario::findSis($id);
            $producto->stock_actual += $movimientos_invetario->cantidad;
            $producto->guardar();  // Guardamos el producto con el stock actualizado
        }

     

    }

    $alertas = [];
    $router->render('admin/sistemas/movimiento/movimientos', [
        'titulo' => 'MOVIMIENTOS DE PRODUCTOS',
        'alertas' => $alertas,
        'productos_inventario' => $productos_inventario,
        'area_inventario' => $area_inventario,
        'movimientos_invetario' => $movimientos_invetario,
        'categoria_inventario' => $categoria_inventario,
    ]);
}










}