<?php

namespace Model;


class Movimiento  extends ActiveRecord
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

    public static function obtenerMovimientosConProducto() {
        // Consulta SQL que une la tabla de movimientos con la de productos
        $query = "SELECT 
                    m.id AS movimiento_id,
                    m.tipo_movimiento,
                    m.cantidad,
                    m.fecha_movimiento,
                    p.nombre_producto
                  FROM movimientos_stock m
                  LEFT JOIN productos_inventario p ON m.id_producto = p.id_producto
                  ORDER BY m.id";
    
        $resultado = self::arrayasociativo($query);
    
        // Agrupar los movimientos con los nombres de los productos
        $movimientos = [];
        foreach ($resultado as $fila) {
            $movimientos[] = [
                'id' => $fila['movimiento_id'],
                'tipo_movimiento' => $fila['tipo_movimiento'],
                'cantidad' => $fila['cantidad'],
                'fecha_movimiento' => $fila['fecha_movimiento'],
                'producto' => $fila['nombre_producto'] // Aquí agregamos el nombre del producto
            ];
        }
    
        return json_encode($movimientos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    

    
}

