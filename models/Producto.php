<?php 
namespace Model;

class Producto extends ActiveRecord
{
    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'almacen', 'nombre_cliente', 'ruc_cliente','numero_pedido','fecha_pedido','vendedor','plazo_entrega','estado_pedido','codigo_producto','nombre_producto','cantidad','pvp','subtotal','total'];

    public $id;
    public $almacen;
    public $nombre_cliente;
    public $ruc_cliente;
    public $numero_pedido;
    public $fecha_pedido;
    public $vendedor;
    public $plazo_entrega;
    public $estado_pedido;
    public $codigo_producto;
    public $nombre_producto;
    public $cantidad;
    public $pvp;
    public $subtotal;
    public $total;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->almacen = $args['almacen'] ?? '';
        $this->nombre_cliente = $args['nombre_cliente'] ?? '';
        $this->ruc_cliente = $args['ruc_cliente'] ?? '';
        $this->numero_pedido = $args['numero_pedido'] ?? '';
        $this->fecha_pedido = $args['fecha_pedido'] ?? '';
        $this->vendedor = $args['vendedor'] ?? '';
        $this->plazo_entrega = $args['plazo_entrega'] ?? '';
        $this->estado_pedido = $args['estado_pedido'] ?? '';
        $this->codigo_producto = $args['codigo_producto'] ?? '';
        $this->nombre_producto = $args['nombre_producto'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->pvp = $args['pvp'] ?? '';
        $this->subtotal = $args['subtotal'] ?? '';
        $this->total = $args['total'] ?? '';

    }
}