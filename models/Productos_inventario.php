<?php 
namespace Model;

class Productos_inventario extends ActiveRecord
{
    protected static $tabla = 'productos_inventario';
    protected static $columnasDB = ['id_producto', 'nombre_producto','id_categoria','stock_actual','costo_unitario'];

    public $id_producto;
    public $nombre_producto;
    public $id_categoria;
    public $stock_actual;
    public $costo_unitario;

    public function __construct($args = [])
    {
        $this->id_producto = $args['id_producto'] ?? '';
        $this->nombre_producto = $args['nombre_producto'] ?? '';
        $this->id_categoria = $args['id_categoria'] ?? '';
        $this->stock_actual = $args['stock_actual'] ?? '';
        $this->costo_unitario = $args['costo_unitario'] ?? '';


    }
}


class Categoria_inventario extends ActiveRecord
{
    protected static $tabla = 'categorias_inventario';
    protected static $columnasDB = ['id_inventario', 'nombre_categoria'];

    public $id_inventario;
    public $nombre_categoria;

    public function __construct($args = [])
    {
        $this->id_inventario = $args['id_producto'] ?? null;
        $this->nombre_categoria = $args['nombre_categoria'] ?? '';
    }
}