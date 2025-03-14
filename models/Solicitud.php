<?php

namespace Model;

class Solicitud extends ActiveRecord {

    protected static $tabla = 'solicitud_inventario';
    protected static $columnasDB = ['id','id_producto','id_area','id_categoria','cantidad','costo_unitario','total'];

    public $id;
    public $id_producto;
    public $id_area;
    public $id_categoria;
    public $cantidad;
    public $costo_unitario;
    public $total;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_producto = $args['id_producto'] ?? '';
        $this->id_area = $args['id_area'] ?? '';
        $this->id_categoria = $args['id_categoria'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->costo_unitario = $args['costo_unitario'] ?? '';
        $this->total = $args['total'] ?? '';
  
    }




}