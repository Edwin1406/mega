<?php

namespace Model;

class Quejas extends ActiveRecord {

    protected static $tabla = 'quejas_reclamos';
    protected static $columnasDB = ['id','fecha','responsable_reporte','cliente','per_reporta_reclamo','factura','fecha_factura','descripcion_producto','motivo_reclamo','accion_solicitada'];

    public $id;
    public $fecha;
    public $responsable_reporte;
    public $cliente;
    public $per_reporta_reclamo;
    public $factura;
    public $fecha_factura;
    public $descripcion_producto;
    public $motivo_reclamo;
    public $accion_solicitada;
    


    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->responsable_reporte = $args['responsable_reporte'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->per_reporta_reclamo = $args['per_reporta_reclamo'] ?? '';
        $this->factura = $args['factura'] ?? '';
        $this->fecha_factura = $args['fecha_factura'] ?? '';
        $this->descripcion_producto = $args['descripcion_producto'] ?? '';
        $this->motivo_reclamo = $args['motivo_reclamo'] ?? '';
        $this->accion_solicitada = $args['accion_solicitada'] ?? '';
    }




}