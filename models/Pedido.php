<?php 
namespace Model;

use Model\ActiveRecord;

class Pedido  extends ActiveRecord{
    protected static $tabla = 'pedidos';
    protected static $columnasDB = ['id', 'nombre_pedido', 'cantidad','largo','ancho','alto', 'flauta','test','fecha_ingreso', 'fecha_entrega'];

    public $id;
    public $nombre_pedido;
    public $cantidad;
    public $largo;
    public $ancho;
    public $alto;
    public $flauta;
    public $test;
    public $fecha_ingreso;
    public $fecha_entrega;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre_pedido = $args['nombre_pedido'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->largo = $args['largo'] ?? '';
        $this->ancho = $args['ancho'] ?? '';
        $this->alto = $args['alto'] ?? '';
        $this->flauta = $args['flauta'] ?? '';
        $this->test = $args['test'] ?? '';
        $this->fecha_ingreso = $args['fecha_ingreso'] ?? '';
        $this->fecha_entrega = $args['fecha_entrega'] ?? '';
    }





}