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
    // public $valor;
    // public $costo_nuevo;


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
                    m.costo_nuevo,
                    m.valor,
                    m.fecha_movimiento,
                    p.nombre_producto,
                    a.nombre_area,
                    c.nombre_categoria

                  FROM movimientos_stock m
                  LEFT JOIN productos_inventario p ON m.id_producto = p.id_producto
                  LEFT JOIN areas_inventario a ON m.id_area = a.id_area
                  LEFT JOIN categorias_inventario c ON p.id_categoria = c.id_categoria
                  ORDER BY m.id";
    
        $resultado = self::arrayasociativo($query);
    
        // Agrupar los movimientos con los nombres de los productos
        $movimientos = [];
        foreach ($resultado as $fila) {
            $movimientos[] = [
                'id' => $fila['movimiento_id'],
                'producto' => $fila['nombre_producto'] ,
                'area' => $fila['nombre_area'],
                'categoria' => $fila['nombre_categoria'],
                'tipo_movimiento' => $fila['tipo_movimiento'],
                'cantidad' => $fila['cantidad'],
                'costo_nuevo' => $fila['costo_nuevo'],
                'valor' => $fila['valor'],
                'fecha_movimiento' => $fila['fecha_movimiento'],
            ];
        }
    
        return array_values($movimientos); 
    }
    

    
}

