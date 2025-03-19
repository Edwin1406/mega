<?php

namespace Controllers;

use TCPDF;
use Exception;
use MVC\Router;
use Classes\Pdf2;
use Classes\Correo;
use Model\Solicitud;
use Model\Movimiento;
use Model\Movimientos;
use Classes\Paginacion;
use Classes\InventarioPdf;
use Model\Area_inventario;
use Model\Categoria_inventario;
use Model\Productos_inventario;
use Model\Movimientos_inventario;

class SistemasController {

    public static function index(Router $router)
    {
        session_start();

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


// Movimientos
public static function movimientos(Router $router) {
    $alertas = [];
    $productos_inventario = Productos_inventario::allSis('producto','DESC');
    $area_inventario = Area_inventario::allSis('area', 'ASC');
    $categoria_inventario = Categoria_inventario::allSis('categoria', 'ASC');
    $movimientos_invetario = Movimientos_inventario::all('DESC');

    $movimientos_invetario = new Movimientos_inventario;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica que los datos del POST lleguen correctamente
        $movimientos_invetario->sincronizar($_POST);
        
        $id_producto = $_POST['id_producto'];
        $id_area = $_POST['id_area'];
        $id_categoria = $_POST['id_categoria'];
        $tipo_movimiento = $_POST['tipo_movimiento'];
        $cantidad = $_POST['cantidad'];
        $costo_nuevo = $_POST['costo_nuevo'];
        
        $producto = Productos_inventario::findSis($id_producto);

        // Si el producto existe en el inventario
        $productos_inventario = new Productos_inventario([
            'id_producto' => $id_producto,
            'nombre_producto' => $producto->nombre_producto,
            'id_categoria' => $producto->id_categoria,
            'id_area' => $id_area,
            'stock_actual' => $producto->stock_actual,
            'costo_unitario' => $producto->costo_unitario,
        ]);

        // si no existe movimientos previos


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica que los datos del POST lleguen correctamente
            $movimientos_invetario->sincronizar($_POST);
            
            $id_producto = $_POST['id_producto'];
            $id_area = $_POST['id_area'];
            $id_categoria = $_POST['id_categoria'];
            $tipo_movimiento = $_POST['tipo_movimiento'];
            $cantidad = $_POST['cantidad'];
            $costo_nuevo = $_POST['costo_nuevo'];
            
            $producto = Productos_inventario::findSis($id_producto);
        
            // Si el producto existe en el inventario
            $productos_inventario = new Productos_inventario([
                'id_producto' => $id_producto,
                'nombre_producto' => $producto->nombre_producto,
                'id_categoria' => $producto->id_categoria,
                'id_area' => $id_area,
                'stock_actual' => $producto->stock_actual,
                'costo_unitario' => $producto->costo_unitario,
            ]);
        
            // // Si el movimiento es de entrada, calculamos el nuevo costo promedio
            // if ($tipo_movimiento === 'Entrada') {
            //     // Si el stock es cero, el costo unitario será el costo nuevo
            //     if ($producto->stock_actual == 0) {
            //         $nuevo_costo_promedio = $producto->costo_unitario; // Si el stock es cero, el costo unitario es el costo nuevo ingresado
            //         $valor = $producto->costo_unitario * $cantidad; // Valor de la entrada
            //         $costo_nuevo = $producto->costo_unitario; // Costo unitario
            //         // Actualizando el stock y el costo unitario
            //         $productos_inventario->stock_actual += $cantidad;
            //     } else {
            //         // Nuevo stock total después de la entrada
            //         $nuevo_stock = $producto->stock_actual + $cantidad;
        
            //         // Buscar movimientos anteriores de tipo 'Entrada'
            //         $movimientos_previos = Movimientos_inventario::where('id_producto', $id_producto)
            //             ->where('tipo_movimiento', 'Entrada')
            //             ->all();
        
            //         $total_valor = 0;
            //         $total_cantidad = 0;
        
            //         // Calculamos el costo total ponderado de todas las entradas previas
            //         foreach ($movimientos_previos as $movimiento) {
            //             $total_valor += $movimiento->costo_nuevo;
            //             $total_cantidad += $movimiento->cantidad;
            //         }
            //         // total valor del utlimo movimiento seria cero y el que ingresa toma la cantidad del ultimo movimiento  para multiplacar por el costo_promedio

                   
                   

            //         // al ultimo movimiento le sumamos la cantidad 
        
            //         // Sumar la nueva entrada al cálculo
            //         $total_valor += $cantidad * $costo_nuevo;
            //         $total_cantidad += $cantidad;
        
            //         // Calcular el nuevo costo promedio ponderado
            //         $nuevo_costo_promedio = $total_valor / $total_cantidad;
        
            //         // Establecer el valor de la entrada
            //         $valor = $costo_nuevo * $cantidad;
        
            //         // Actualizando el stock y el costo unitario
            //         $productos_inventario->stock_actual = $nuevo_stock;
            //         $productos_inventario->costo_unitario = $nuevo_costo_promedio;
            //     }
        
            // } else {
            //     // Si es salida, disminuimos el stock pero no cambiamos el costo promedio
            //     $productos_inventario->stock_actual -= $cantidad;
            //     $valor = 0;  // Para movimientos de salida no calculamos valor
            // }

            // Si el movimiento es de entrada, calculamos el nuevo costo promedio
if ($tipo_movimiento === 'Entrada') {
    // Si el stock es cero, el costo unitario será el costo nuevo
    if ($producto->stock_actual == 0) {
        $nuevo_costo_promedio = $costo_nuevo; // Si el stock es cero, el costo unitario es el costo nuevo ingresado
        $valor = $costo_nuevo * $cantidad; // Valor de la entrada
        
        // Actualizando el stock y el costo unitario
        $productos_inventario->stock_actual = $cantidad;
        $productos_inventario->costo_unitario = $nuevo_costo_promedio;
    } else {
        // Nuevo stock total después de la entrada
        $nuevo_stock = $producto->stock_actual + $cantidad;

        // Calcular el nuevo costo promedio ponderado
        $valor_stock_actual = $producto->stock_actual * $producto->costo_unitario;
        $valor_nueva_entrada = $cantidad * $costo_nuevo;
        
        $nuevo_costo_promedio = ($valor_stock_actual + $valor_nueva_entrada) / $nuevo_stock;

        // Establecer el valor de la entrada
        $valor = $cantidad * $costo_nuevo;

        // Actualizando el stock y el costo unitario
        $productos_inventario->stock_actual = $nuevo_stock;
        $productos_inventario->costo_unitario = $nuevo_costo_promedio;
    }
} else {
    // Si es salida, disminuimos el stock pero no cambiamos el costo promedio
    if ($productos_inventario->stock_actual >= $cantidad) {
        $productos_inventario->stock_actual -= $cantidad;
    } else {
        // Manejar el caso en que no hay suficiente stock
        throw new Exception("Stock insuficiente para la salida");
    }
    
    $valor = 0;  // Para movimientos de salida no calculamos valor
}

        
            // Crear el movimiento de inventario
            $movimientos_invetario = new Movimientos_inventario([
                'id_producto' => $id_producto,
                'id_area' => $id_area,
                'id_categoria' => $producto->id_categoria,
                'tipo_movimiento' => $tipo_movimiento,
                'cantidad' => $cantidad,
                'costo_nuevo' => $costo_nuevo,
                'costo_promedio' => $nuevo_costo_promedio,
                'valor' => $valor,  
                'fecha_movimiento' => date('Y-m-d H:i:s')
            ]);
        }
        
        // debuguear($movimientos_invetario);

        // Guardar el movimiento de inventario
        $movimientos_invetario->guardas();
        
        // Verificar alertas
        $alertas = $movimientos_invetario->getAlertas();

        // Redireccionar si no hay alertas
        if (empty($alertas)) {
            $productos_inventario->actualizar();
            header('Location: /admin/sistemas/movimiento/movimientos');
        }
    }

    // Renderizar la vista
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

public static function tabla(Router $router)
{
    $solicitud  = Solicitud::all('DESC');


    $pagina_actual = $_GET['page'] ?? 1;
    $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

    if (!$pagina_actual || $pagina_actual < 1) {
        header('Location: /admin/sistemas/solicitudes/tabla?page=1');
        exit;
    }
      // Obtener el número de registros por página
      $registros_por_pagina = $_GET['per_page'] ?? 10;
      if ($registros_por_pagina === 'all') {
          $total = Solicitud::total();
          $registros_por_pagina = $total; // Mostrar todos los registros
      } else {
          $registros_por_pagina = filter_var($registros_por_pagina, FILTER_VALIDATE_INT) ?: 10;
      }

      
      $total = Solicitud::total();
      $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

      if ($paginacion->total_paginas() < $pagina_actual) {
        header('Location: /admin/vendedor/cliente/cotizador?page=1');
        exit;
    }

    $visor = Solicitud::paginar($registros_por_pagina, $paginacion->offset());
    $router->render('admin/sistemas/solicitudes/tabla', [
        'titulo' => 'TABLA DE SOLICITUDES',
        'solicitud' => $solicitud,
        'paginacion' => $paginacion->paginacion(),
        'visor' => $visor,
    ]);
}



public static function pdf(Router $router)
{

    
    
    // $alertas = [];
    // $id = $_GET['id'];
    // $id = filter_var($id, FILTER_VALIDATE_INT);

    // $solicitud = Solicitud::find($id);
    // if (!$solicitud) {
    //     header('Location: /admin/produccion/materia/tabla');
    // }

    // $pdf = new Pdf2();
    // $datos = [
    //     'id' => $solicitud->id ?? 'No disponible',
    //     'array' => $solicitud->array ?? 'No disponible',
    // ];
    


    // $pdf->generarPdf($datos);
    
    // $email = new Correo($usuario->email, $usuario->nombre, $usuario->token);
    // $email->enviarConfirmacion();
    // $pdf->Output('etiqueta.pdf', 'I');
  
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    
    $solicitud = Solicitud::find($id);
    if (!$solicitud) {
        header('Location: /admin/produccion/materia/tabla');
        exit();
    }
    
    $pdf = new Pdf2();
    $datos = [
        'id' => $solicitud->id ?? 'No disponible',
        'array' => $solicitud->array ?? []
    ];
    
    // Llamar correctamente al método pasando los datos
    $pdfContenido = $pdf->obtenerPdfEnMemoria($datos);
    
    if (strlen($pdfContenido) < 500) {
        die("Error: El PDF generado sigue siendo muy pequeño o está vacío.");
    }
    
    // Guardar para depuración
    file_put_contents('test.pdf', $pdfContenido);
    
    // Enviar por correo
    $destinatario1 = "edwin.ed948@gmail.com";
    $destinatario2 = "edwinfer32@hotmail.com";
    $asunto = "Solicitud de adquisición de productos para el area de sistemas";
    $mensaje = "<p>Estimado usuario,</p><p>Adjunto encontrará el documento generado.</p>";
    
    $email = new Correo();
    $resultado = $email->enviarConAdjunto($destinatario1,$destinatario2, $asunto, $mensaje, $pdfContenido, 'etiqueta.pdf');
    
    // quiero visualizar el pdf en el navegador



    if ($resultado === true) {
        // ver el pdf en el navegador
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="etiqueta.pdf"');
        header('Content-Length: ' . strlen($pdfContenido));
        echo $pdfContenido;
         $pdf->Output('SOLICITUD.pdf', 'I');
       
    } else {
        echo "Error al enviar el correo: " . $resultado;
    }
    

}



public static function pdfinventario(Router $router)
{
   
    $inventarioProductos= Productos_inventario::allSis('producto','DESC');

    $pdf = new InventarioPdf();
    $datos = [
        'inventarioProductos' => $inventarioProductos,
    ];

    // debuguear($datos);

    $pdf->generarPdf($datos);
    $pdf->Output('inventario.pdf', 'I');

    
}


}