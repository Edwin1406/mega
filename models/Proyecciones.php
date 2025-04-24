<?php

namespace Model;

class Proyecciones extends ActiveRecord
{   
    protected static $tabla = 'proyecciones';
    protected static $columnasDB = ['id','fecha_consumo','linea','producto','gms','ancho','cantidad'];

    public $id;
    public $fecha_consumo;
    public $linea;
    public $producto;
    public $gms;
    public $ancho;
    public $cantidad;
    
   


    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->fecha_consumo = $args['fecha_consumo'] ?? '';
        $this->linea = $args['linea'] ?? '';
        $this->producto = $args['producto'] ?? '';
        $this->gms = $args['gms'] ?? '';
        $this->ancho = $args['ancho'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        
       
    }





}
