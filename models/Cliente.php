<?php 
namespace Model;

use Classes\ValidarCedula;


class Cliente extends ActiveRecord {

    protected static $tabla = 'visor';
    protected static $columnasDB = ['id', 'codigo','nombre','imagen'];

    public $id;
    public $codigo;
    public $nombre;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->codigo = $args['codigo'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }

    



    public function validar() {

        if(!$this->codigo) {
            self::$alertas['error'][] = 'El Campo Codigo es Obligatorio';
        }
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Campo Nombre es Obligatorio';
        }
       
        return self::$alertas;
    }


} 