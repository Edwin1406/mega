<?php 
namespace Model;

use Model\ActiveRecord;

class Pedido  extends ActiveRecord{
    protected static $tabla = 'pedidos';
    protected static $columnasDB = ['id', 'cliente', 'ancho', 'estado', 'observaciones', 'created_at', 'updated_at'];

    public $id;
    public $cliente;
    public $ancho;
    public $estado;
    public $observaciones;
    public $created_at;
    public $updated_at;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->cliente = $args['cliente'] ?? '';
        $this->ancho = $args['ancho'] ?? '';
        $this->estado = $args['estado'] ?? '';
        $this->observaciones = $args['observaciones'] ?? '';
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }





}