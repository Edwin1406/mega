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
    protected static $columnasDB = ['id', 'id_producto','id_area','tipo_movimiento','cantidad','fecha_movimiento'];

    public $id;
    public $id_producto;
    public $id_area;
    public $tipo_movimiento;
    public $cantidad;
    public $fecha_movimiento;


    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? '';
        $this->id_producto = $args['id_producto'] ?? '';
        $this->id_area = $args['id_area'] ?? '';
        $this->tipo_movimiento = $args['tipo_movimiento'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->fecha_movimiento = $args['fecha_movimiento'] ?? date('Y-m-d H:i:s');

    }



    public function guardas() {
        $query = "INSERT INTO movimientos_inventario (id_producto, id_area, tipo_movimiento, cantidad, fecha_movimiento) 
                  VALUES (:id_producto, :id_area, :tipo_movimiento, :cantidad, :fecha_movimiento)";
        $stmt = self::$db->prepare($query);
    
        // Vinculamos los parámetros
        $stmt->bindParam(':id_producto', $this->id_producto);
        $stmt->bindParam(':id_area', $this->id_area);
        $stmt->bindParam(':tipo_movimiento', $this->tipo_movimiento);
        $stmt->bindParam(':cantidad', $this->cantidad);
        $stmt->bindParam(':fecha_movimiento', $this->fecha_movimiento);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    






    
}

