<?php 
namespace Model;

use Classes\ValidarCedula;


class Cliente extends ActiveRecord {

    protected static $tabla = 'visor';
    protected static $columnasDB = ['id', 'nombre_cliente','nombre_producto','imagen'];

    public $id;
    public $nombre_cliente;
    public $nombre_producto;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre_cliente = isset($args['nombre_cliente']) ? strtoupper($args['nombre_cliente']) : '';
        $this->nombre_producto = isset($args['nombre_producto']) ? strtoupper($args['nombre_producto']) : '';
        $this->imagen = $args['imagen'] ?? '';
    }
    

    



    public function validar() {

        if(!$this->nombre_cliente) {
            self::$alertas['error'][] = 'El Campo Nombre Cliente es Obligatorio';
        }

        if(!$this->nombre_producto) {
            self::$alertas['error'][] = 'El Campo Nombre es Obligatorio';
        }
       
        return self::$alertas;
    }


} 