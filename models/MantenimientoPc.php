<?php

namespace Model;

class MantenimientoPc extends ActiveRecord {

    protected static $tabla = 'mantenimiento';
    protected static $columnasDB = ['id', 'computadora_id', 'fecha_mantenimiento', 'tipo', 'descripcion', 'repuesto_usado', 'fecha_cambio_repuesto', 'costo'];

    public $id;
    public $computadora_id;
    public $fecha_mantenimiento;
    public $tipo;
    public $descripcion;
    public $repuesto_usado;
    public $fecha_cambio_repuesto;
    public $costo;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->computadora_id = $args['computadora_id'] ?? '';
        $this->fecha_mantenimiento = $args['fecha_mantenimiento'] ?? '';
        $this->tipo = $args['tipo'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->repuesto_usado = $args['repuesto_usado'] ?? '';
        $this->fecha_cambio_repuesto = $args['fecha_cambio_repuesto'] ?? '';
        $this->costo = $args['costo'] ?? '';
    }
}