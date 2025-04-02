<?php

namespace Model;


class Ticket extends ActiveRecord {

    protected static $tabla = 'Tickets';
    protected static $columnasDB = [
        'id',                  
        'computadora_id',      
        'descripcion',         
        'fecha_creacion',      
        'estado',              
        'prioridad',           
        'categoria',            
        'comentarios'              
    ];
    

    public $id;
    public $computadora_id;
    public $descripcion;
    public $fecha_creacion;
    public $estado;
    public $prioridad;
    public $categoria;
    public $comentarios;
    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->computadora_id = $args['computadora_id'] ?? null;
        $this->descripcion = $args['descripcion'] ?? '';
        $this->fecha_creacion = $args['fecha_creacion'] ?? date('Y-m-d H:i:s');
        $this->estado = $args['estado'] ?? 'abierto';
        $this->prioridad = $args['prioridad'] ?? 'baja';
        $this->categoria = $args['categoria'] ?? 'general';
        $this->comentarios = $args['comentarios'] ?? '';
    }
    
}