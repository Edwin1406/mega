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
    debuguear($productos_inventario);
    $area_inventario = Area_inventario::allSis('area', 'ASC');
    $categoria_inventario = Categoria_inventario::allSis('categoria', 'ASC');

    // $movimientos_invetario = new Movimientos_inventario;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica que los datos del POST lleguen correctamente
        // $movimientos_invetario->sincronizar($_POST);

        $id_producto = $_POST['id_producto'];
        $id_area = $_POST['id_area'];
        $tipo_movimiento = $_POST['tipo_movimiento'];
        $cantidad = $_POST['cantidad'];

        var_dump($_POST);

        $movimientos_invetario = new Movimientos_inventario([
                    'id_producto' => $id_producto,
                    'id_area' => $id_area,
                    'tipo_movimiento' => $tipo_movimiento,
                    'cantidad' => $cantidad,
                    'fecha_movimiento' => date('Y-m-d H:i:s')
        ]);
        
        // $producto= Productos_inventario::findSis($id_producto);

    

        // if ($tipo_movimiento === 'Entrada') {
        //     $producto->stock_actual += $cantidad;

        // }elseif ($tipo_movimiento === 'Salida') {
        //     $producto->stock_actual -= $cantidad;
        // }

  
        //      $producto->guardar();
            


        


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