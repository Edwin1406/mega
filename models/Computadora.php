<?php


namespace Model;

class Computadora extends ActiveRecord {
    
    protected static $tabla = 'computadoras';
    protected static $columnasDB = ['id', 'numero_interno','email_usuario','email_usuario', 'area', 'usuario_asignado', 'fecha_compra', 'marca_modelo', 'procesador', 'ram', 'disco_duro', 'sistema_operativo', 'estado_actual', 'direccion_ip','contrasena','created_at'];

   
    public $id;
    public $numero_interno;
    public $email_usuario;
    public $area;
    public $usuario_asignado;
    public $fecha_compra;
    public $marca_modelo;
    public $procesador;
    public $ram;
    public $disco_duro;
    public $sistema_operativo;
    public $estado_actual;
    public $direccion_ip;
    public $contrasena;
    public $created_at;


    // public $pdf_actual; // Definir la propiedad explícitamente


    public function __construct($args = [])
    {

        // fecha y hora de guayaquil ecuador 
        date_default_timezone_set('America/Guayaquil');
        $fecha = date('Y-m-d H:i:s'); 

        $this->id = $args['id'] ?? null;
        $this->numero_interno = $args['numero_interno'] ?? '';
        $this->email_usuario = $args['email_usuario'] ?? '';
        $this->area = $args['area'] ?? '';
        $this->usuario_asignado = $args['usuario_asignado'] ?? '';
        $this->fecha_compra = $args['fecha_compra'] ?? '';
        $this->marca_modelo = $args['marca_modelo'] ?? '';
        $this->procesador = $args['procesador'] ?? '';
        $this->ram = $args['ram'] ?? '';
        $this->disco_duro = $args['disco_duro'] ?? '';
        $this->sistema_operativo = $args['sistema_operativo'] ?? '';
        $this->estado_actual = $args['estado_actual'] ?? '';
        $this->direccion_ip = $args['direccion_ip'] ?? '';
        $this->contrasena = $args['contrasena'] ?? '';
        $this->created_at = $args['created_at'] ?? $fecha;
    }




}