<?php 
namespace Model;

class Producto extends ActiveRecord
{
    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'nombre', 'cantidad', 'fecha'];

    public $id;
    public $nombre;
    public $cantidad;
    public $fecha;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->cantidad = $args['cantidad'] ?? 0;
        $this->fecha = $args['fecha'] ?? date('Y-m-d');
    }
}