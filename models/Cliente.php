<?php 
namespace Model;

use Classes\ValidarCedula;


class Cliente extends ActiveRecord {

    protected static $tabla = 'visor';
    protected static $columnasDB = ['id', 'nombre_cliente','nombre_producto','pdf'];

    public $id;
    public $nombre_cliente;
    public $nombre_producto;
    public $pdf;
    public $pdf_actual; // Definir la propiedad explícitamente


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre_cliente = $args['nombre_cliente'] ?? '';
        $this->nombre_producto = $args['nombre_producto'] ?? '';
        $this->pdf = $args['pdf'] ?? '';
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