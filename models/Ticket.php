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
        'calificacion', 
        'estado_email'             
    ];
    

    public $id;
    public $computadora_id;
    public $descripcion;
    public $fecha_creacion;
    public $estado;
    public $prioridad;
    public $categoria;
    public $calificacion;
    public $estado_email;

    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->computadora_id = $args['computadora_id'] ?? null;
        $this->descripcion = $args['descripcion'] ?? '';
        $this->fecha_creacion = $args['fecha_creacion'] ?? date('Y-m-d H:i:s');
        $this->estado = $args['estado'] ?? '';
        $this->prioridad = $args['prioridad'] ?? '';
        $this->categoria = $args['categoria'] ?? '';
        $this->calificacion = $args['calificacion'] ?? '';
        $this->estado_email = $args['estado_email'] ?? 0;
    }

    public function validar() {
        if (!$this->computadora_id) {
            self::$alertas['error'][] = 'El ID de la computadora es obligatorio';
        }
        if (!$this->descripcion) {
            self::$alertas['error'][] = 'La descripción es obligatoria';
        }
        if (!$this->prioridad) {
            self::$alertas['error'][] = 'La prioridad es obligatoria';
        }
        if (!$this->categoria) {
            self::$alertas['error'][] = 'La categoría es obligatoria';
        }
        return self::$alertas;
    }
    
}