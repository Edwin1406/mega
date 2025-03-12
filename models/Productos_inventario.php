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
    protected static $columnasDB = ['id_categoria', 'nombre_categoria'];

    public $id_categoria;
    public $nombre_categoria;

    public function __construct($args = [])
    {
        $this->id_categoria = $args['id_categoria'] ?? null;
        $this->nombre_categoria = $args['nombre_categoria'] ?? '';
    }
}



class Area_iventario extends ActiveRecord
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

