<?php 
namespace Model;


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

    function validarCedula($cedula) {
        // Verificar longitud de 10 dígitos
        if (strlen($cedula) != 10 || !ctype_digit($cedula)) {
            return false;
        }
    
        // Verificar código de provincia (primeros dos dígitos)
        $provincia = intval(substr($cedula, 0, 2));
        if ($provincia < 1 || $provincia > 24) {
            return false;
        }
    
        // Cálculo de dígitos verificadores
        $suma = 0;
        for ($i = 0; $i < 9; $i++) {
            $num = intval($cedula[$i]);
            if ($i % 2 == 0) {
                $num *= 2;
                if ($num > 9) $num -= 9;
            }
            $suma += $num;
        }
    
        $verificador = 10 - ($suma % 10);
        $verificador = $verificador == 10 ? 0 : $verificador;
    
        return $verificador == intval($cedula[9]);
    }



    public function validar() {

        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Campo Nombre es Obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Campo Apellido es Obligatorio';
        }
        if (!validarCedula($this->cedula)) {
            self::$alertas['error'][] = 'La Cédula es inválida';
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