<?php

namespace Controllers;

use Model\Area_inventario;
use Model\Categoria_inventario;
use Model\Movimiento;
use Model\Movimientos;
use Model\Movimientos_inventario;
use Model\Productos_inventario;
use Model\Solicitud;
use MVC\Router;

class SistemasController {

    public static function index(Router $router)
    {

        $registros = Productos_inventario::countinventario();
        $router->render('admin/sistemas/index', [
            'titulo' => 'INVENTARIO DE SISTEMAS',
            'registros' => $registros,
        ]);
    }


    public static function crear(Router $router)
    {


        $productos_inventario = new Productos_inventario;
        $categoria_inventario = Categoria_inventario:: allSis('categoria', 'ASC');
        $area_inventario = Area_inventario:: allSis('area', 'ASC');

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
            'area_inventario' => $area_inventario,
        ]);
    }




// movimientos 
public static function movimientos(Router $router) {
    $alertas = [];
    $productos_inventario = Productos_inventario::allSis('producto','DESC');
    $area_inventario = Area_inventario::allSis('area', 'ASC');
    $categoria_inventario = Categoria_inventario::allSis('categoria', 'ASC');
    
    $movimientos_invetario = new Movimientos_inventario;
    
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica que los datos del POST lleguen correctamente
    $movimientos_invetario->sincronizar($_POST);
    
    $id_producto = $_POST['id_producto'];
    $id_area = $_POST['id_area'];
    $id_categoria = $_POST['id_categoria'];
    $tipo_movimiento = $_POST['tipo_movimiento'];
    $cantidad = $_POST['cantidad'];
    
    $producto = Productos_inventario::findSis($id_producto);

    $productos_inventario = new Productos_inventario([
        'id_producto' => $id_producto,
        'nombre_producto' => $producto->nombre_producto,
        'id_categoria' => $producto->id_categoria,
        'id_area' => $id_area,
        'stock_actual' => $producto->stock_actual,
        'costo_unitario' => $producto->costo_unitario,
    ]);

    // Calculando el stock actual y el costo unitario
    if ($tipo_movimiento === 'Entrada') {
        $productos_inventario->stock_actual += $cantidad;
        $productos_inventario->costo_unitario = 
            ($producto->costo_unitario * $producto->stock_actual + $producto->costo_unitario * $cantidad) / $productos_inventario->stock_actual;
    } else {
        $productos_inventario->stock_actual -= $cantidad;
    }

    // Establecer el valor en base al tipo de movimiento
    if ($tipo_movimiento === 'Entrada') {
        $valor = $productos_inventario->costo_unitario * $cantidad;
    } else {
        $valor = 0;  // O puedes dejarlo vacío dependiendo de cómo lo manejes en la base de datos
    }

    $movimientos_invetario = new Movimientos_inventario([
        'id_producto' => $id_producto,
        'id_area' => $id_area,
        'id_categoria' => $producto->id_categoria,
        'tipo_movimiento' => $tipo_movimiento,
        'cantidad' => $cantidad,
        'valor' => $valor,  // Asignamos el valor calculado o 0
        'fecha_movimiento' => date('Y-m-d H:i:s')
    ]);

    $movimientos_invetario->guardas();

      
     
        $alertas = $movimientos_invetario->getAlertas();
        // redireccionar
        if (empty($alertas)) {
            $productos_inventario->actualizar();

            header('Location: /admin/sistemas/movimiento/movimientos');
        }



    }

    $router->render('admin/sistemas/movimiento/movimientos', [
        'titulo' => 'MOVIMIENTOS DE PRODUCTOS',
        'alertas' => $alertas,
        'productos_inventario' => $productos_inventario,
        'area_inventario' => $area_inventario,
        'categoria_inventario' => $categoria_inventario,
    ]);
}


public static function apimovimientos()
{
    header("Access-Control-Allow-Origin: *");  
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
    header("Content-Type: application/json"); 

    $movimientos = Movimiento::obtenerMovimientosConProducto();
    echo json_encode($movimientos);
    

    

    
    // echo json_encode($movimientos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}



public static function apiproducts()
{
    header("Access-Control-Allow-Origin: *");  
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
    header("Content-Type: application/json"); 

    $productos = Productos_inventario::obtenerProductosConCategoriaYArea();
    // quiero id_area y id_categoria me muestre el nombre de la categoria y el area
    
    

    echo json_encode($productos);
    
    // echo json_encode($movimientos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}



public static function solicitud(Router $router)
{
    $alertas = [];
    $productos_inventario = Productos_inventario::allSis('producto','DESC');
    $area_inventario = Area_inventario::allSis('area', 'ASC');
    $categoria_inventario = Categoria_inventario::allSis('categoria', 'ASC');
    $solicitud_inventario = new Solicitud;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener el array de productos desde el formulario
        $array = json_decode($_POST['array'], true); // Decodificar el JSON en un array asociativo
    
        // Convertir el array a JSON antes de guardarlo
        $array_json = json_encode($array); 
    
        $solicitud_inventario = new Solicitud([
            'array' => $array_json, // Usamos la cadena JSON en lugar del array
        ]);
    
        $solicitud_inventario->guardar();
    }
    
    $router->render('admin/sistemas/solicitudes/solicitud', [
        'titulo' => 'SOLICITUD DE PRODUCTOS',
        'alertas' => $alertas,
        'productos_inventario' => $productos_inventario,
        'area_inventario' => $area_inventario,
        'categoria_inventario' => $categoria_inventario,
    ]);
}


// public static function solicitudpost(Router $router)
// {
//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
//         $solicitud_inventario = new Solicitud($_POST);

//         debuguear($solicitud_inventario);
//         $resultado =$solicitud_inventario->guardar();
        
//         echo json_encode($resultado);
//     }


// }





}