<?php 
namespace Model;

use Model\ActiveRecord;

class Pedido  extends ActiveRecord{
    protected static $tabla = 'pedidos';
    protected static $columnasDB = ['id', 'nombre_pedido', 'largo','ancho','alto', 'flauta','test','created_at', 'updated_at'];

    public $id;
    public $nombre_pedido;
    public $largo;
    public $ancho;
    public $alto;
    public $flauta;
    public $test;
    public $created_at;
    public $updated_at;
    public ?Bobina $bobina = null; // Definir bobina como una propiedad opcional

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre_pedido = $args['nombre_pedido'] ?? '';
        $this->largo = $args['largo'] ?? '';
        $this->ancho = $args['ancho'] ?? '';
        $this->alto = $args['alto'] ?? '';
        $this->flauta = $args['flauta'] ?? '';
        $this->test = $args['test'] ?? '';
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }





}