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
    $productos_inventario = Productos_inventario::allSis('producto', 'DESC');
    $area_inventario = Area_inventario::allSis('area', 'ASC');
    $categoria_inventario = Categoria_inventario::allSis('categoria', 'ASC');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_producto = $_POST['id_producto'];
        $id_area = $_POST['id_area'] ?? null;
        $tipo_movimiento = $_POST['tipo_movimiento'];
        $cantidad = $_POST['cantidad'];

        // Obtener el producto seleccionado
        $producto = Productos_inventario::findSis($id_producto);

        if ($producto) {

            
            // Crear un nuevo movimiento
            $movimiento = new Movimientos_inventario([
                'id_producto' => $id_producto,
                'id_area' => $id_area,
                'tipo_movimiento' => $tipo_movimiento,
                'cantidad' => $cantidad,
                'fecha_movimiento' => date('Y-m-d H:i:s')
            ]);
            // Actualizar el stock del producto
            if ($tipo_movimiento === 'Entrada') {
                $producto->stock_actual += $cantidad;
            } else {
                $producto->stock_actual -= $cantidad;
            }

            debuguear($movimiento);
            // guardar en la base de datos
            $resultado = $movimiento->guardar();
            // $resultado = $producto->guardar();
        }
    }

    $alertas = [];
    $router->render('admin/sistemas/movimiento/movimientos', [
        'titulo' => 'MOVIMIENTOS DE PRODUCTOS',
        'alertas' => $alertas,
        'productos_inventario' => $productos_inventario,
        'area_inventario' => $area_inventario,
        // 'movimientos_invetario' => $movimientos_invetario,
        'categoria_inventario' => $categoria_inventario,
    ]);
}









}