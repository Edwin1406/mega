<?php 
namespace Model;

use Classes\ValidarCedula;


class Cliente extends ActiveRecord {

    protected static $tabla = 'clientes';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'ruc', 'telefono', 'email','direccion', 'ciudad','pais','fecha_registro'];

    public $id;
    public $nombre;
    public $apellido;
    public $ruc;
    public $telefono;
    public $email;
    public $direccion;
    public $ciudad;
    public $pais;
    public $fecha_registro;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->ruc = $args['ruc'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->ciudad = $args['ciudad'] ?? '';
        $this->pais = $args['pais'] ?? '';
        $this->fecha_registro = date('Y/m/d');
    }

    



    public function validar() {

        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Campo Nombre es Obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Campo Apellido es Obligatorio';
        }
        if(!$this->ruc) {
            self::$alertas['error'][] = 'El Campo Ruc es Obligatorio';
        }
      

        if(!ValidarCedula::validarCedula($this->ruc)) {
            self::$alertas['error'][] = 'El Campo Ruc no es Valido';
        }


        if(!$this->telefono) {
            self::$alertas['error'][] = 'El Campo Telefono es Obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El Campo Email es Obligatorio';
        }
        if(!$this->direccion) {
            self::$alertas['error'][] = 'El Campo Direccion es Obligatorio';
        }
        if(!$this->ciudad) {
            self::$alertas['error'][] = 'El Campo Ciudad es Obligatorio';
        }
        if(!$this->pais) {
            self::$alertas['error'][] = 'El Campo Pais es Obligatorio';
        }
        return self::$alertas;
    }


} 