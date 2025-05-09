<?php 
namespace Model;

class Productos_inventario extends ActiveRecord
{
    protected static $tabla = 'productos_inventario';
    protected static $columnasDB = ['id_producto', 'nombre_producto','id_categoria','id_area','stock_actual','costo_unitario'];

    public $id_producto;
    public $nombre_producto;
    public $id_categoria;
    public $id_area;
    public $stock_actual;
    public $costo_unitario;

    public function __construct($args = [])
    {
        $this->id_producto = $args['id_producto'] ?? '';
        $this->nombre_producto = $args['nombre_producto'] ?? '';
        $this->id_categoria = $args['id_categoria'] ?? '';
        $this->id_area = $args['id_area'] ?? '';
        $this->stock_actual = $args['stock_actual'] ?? '';
        $this->costo_unitario = $args['costo_unitario'] ?? '';


    }

    public function actualizar()
    {
        // Actualizamos tanto el stock_actual como el costo_unitario
        $query = "UPDATE productos_inventario SET stock_actual = ?, costo_unitario = ? WHERE id_producto = ?";
    
        $stmt = self::$db->prepare($query);
    
        // Vinculamos los parámetros: 'ii' para dos enteros: stock_actual, costo_unitario, y 'i' para el id_producto
        $stmt->bind_param('dii',  $this->stock_actual,$this->costo_unitario, $this->id_producto);
    
        // Ejecutamos la consulta y retornamos true si fue exitosa
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    


    public static function obtenerProductosConCategoriaYArea() {
        // Consulta SQL con LEFT JOIN para obtener nombres de categoría y área
        $query = "SELECT 
                    p.id_producto, 
                    p.nombre_producto, 
                    p.stock_actual, 
                    p.costo_unitario, 
                    c.nombre_categoria, 
                    a.nombre_area
                  FROM productos_inventario p
                  LEFT JOIN categorias_inventario c ON p.id_categoria = c.id_categoria
                  LEFT JOIN areas_inventario a ON p.id_area = a.id_area
                  ORDER BY p.id_producto DESC";
    
        $resultado = self::arrayasociativo($query); // Ejecuta la consulta y obtiene los datos como array asociativo
    
        // Formatear la respuesta
        $productos = [];
        foreach ($resultado as $fila) {
            $productos[] = [
                'id_producto' => $fila['id_producto'],
                'nombre_producto' => $fila['nombre_producto'],
                'stock_actual' => $fila['stock_actual'],
                'costo_unitario' => $fila['costo_unitario'],
                'categoria' => $fila['nombre_categoria'], // Se devuelve el nombre de la categoría
                'area' => $fila['nombre_area'] // Se devuelve el nombre del área
            ];
        }
    
        return $productos;
    }
    




}


class Categoria_inventario extends ActiveRecord
{
    protected static $tabla = 'categorias_inventario';
    protected static $columnasDB = ['id_categoria', 'nombre_categoria'];

    public $id_categoria;
    public $nombre_categoria;

    public function __construct($args = [])
    {
        $this->id_categoria = $args['id_categoria'] ?? null;
        $this->nombre_categoria = $args['nombre_categoria'] ?? '';
    }
}



class Area_inventario extends ActiveRecord
{
    protected static $tabla = 'areas_inventario';
    protected static $columnasDB = ['id_area', 'nombre_area'];

    public $id_area;
    public $nombre_area;

    public function __construct($args = [])
    {
        $this->id_area = $args['id_area'] ?? null;
        $this->nombre_area = $args['nombre_area'] ?? '';
    }
}


class Movimientos_inventario  extends ActiveRecord
{
    protected static $tabla = 'movimientos_stock';
    protected static $columnasDB = ['id', 'id_producto','id_area','id_categoria','tipo_movimiento','cantidad','costo_nuevo','costo_promedio','valor','fecha_movimiento'];

    public $id;
    public $id_producto;
    public $id_area;
    public $id_categoria;
    public $tipo_movimiento;
    public $cantidad;
    public $costo_nuevo;
    public $costo_promedio;
    public $valor;
    public $fecha_movimiento;


    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? '';
        $this->id_producto = $args['id_producto'] ?? '';
        $this->id_area = $args['id_area'] ?? '';
        $this->id_categoria = $args['id_categoria'] ?? '';
        $this->tipo_movimiento = $args['tipo_movimiento'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->costo_nuevo = $args['costo_nuevo'] ?? '';
        $this->costo_promedio = $args['costo_promedio'] ?? '';
        $this->valor = $args['valor'] ?? '';
        $this->fecha_movimiento = $args['fecha_movimiento'] ?? date('Y-m-d H:i:s');

    }



    // public function guardas() {
    //     $query = "INSERT INTO movimientos_stock (id_producto, id_area, tipo_movimiento, cantidad,valor, fecha_movimiento) 
    //     VALUES (?, ?,?, ?, ?, ?)";
    //     $stmt = self::$db->prepare($query);

    //     // Vinculamos los parámetros con los valores correspondientes
    //     $stmt->bind_param('iisii', 
    //     $this->id_producto, 
    //     $this->id_area, 
    //     $this->tipo_movimiento, 
    //     $this->cantidad, 
    //     $this->valor,
    //     $this->fecha_movimiento
    //     );

    
    //     if ($stmt->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    
    public function guardas() {
        $query = "INSERT INTO movimientos_stock (id_producto, id_area,id_categoria, tipo_movimiento, cantidad,costo_nuevo,costo_promedio,valor, fecha_movimiento) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = self::$db->prepare($query);
    
        // Vinculamos los parámetros con los valores correspondientes
        $stmt->bind_param('iiississs', 
            $this->id_producto, 
            $this->id_area, 
            $this->id_categoria,
            $this->tipo_movimiento, 
            $this->cantidad, 
            $this->costo_nuevo,
            $this->costo_promedio,
            $this->valor,
            $this->fecha_movimiento // Este campo debe ser tratado como 's' (string)
        );
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    





    
}

