<?php 
namespace Model;

use Model\ActiveRecord;

class Pedido  extends ActiveRecord{
    protected static $tabla = 'pedidos';
    protected static $columnasDB = ['id', 'cliente', 'ancho','largo', 'estado', 'cantidad','test','created_at', 'updated_at'];

    public $id;
    public $cliente;
    public $ancho;
    public $largo;
    public $estado;
    public $cantidad;
    public $test;
    public $created_at;
    public $updated_at;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->cliente = $args['cliente'] ?? '';
        $this->ancho = $args['ancho'] ?? '';
        $this->largo = $args['largo'] ?? '';
        $this->estado = $args['estado'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->test = $args['test'] ?? '';
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }





}