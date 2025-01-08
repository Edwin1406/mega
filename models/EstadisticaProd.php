<?php

namespace Model;

class EstadisticaProd extends ActiveRecord {
    protected static $tabla = 'pedidos_proyectos';
    protected static $columnasDB = [
        'id',
        'import',
        'proyecto',
        'pedido_interno',
        'fecha_solicitud',
        'trader',
        'marca',
        'producto',
        'gms',
        'ancho',
        'cantidad',
        'precio',
        'total_item',
        'fecha_produccion',
        'ets',
        'eta',
        'arribo_planta',
        'transito',
        'fecha_en_planta',
        'observaciones'
    ];

    public $id;
    public $import;
    public $proyecto;
    public $pedido_interno;
    public $fecha_solicitud;
    public $trader;
    public $marca;
    public $producto;
    public $gms;
    public $ancho;
    public $cantidad;
    public $precio;
    public $total_item;
    public $fecha_produccion;
    public $ets;
    public $eta;
    public $arribo_planta;
    public $transito;
    public $fecha_en_planta;
    public $observaciones;



    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->import = $args['import'] ?? '';
        $this->proyecto = $args['proyecto'] ?? '';
        $this->pedido_interno = $args['pedido_interno'] ?? '';
        $this->fecha_solicitud = $args['fecha_solicitud'] ?? '';
        $this->trader = $args['trader'] ?? '';
        $this->marca = $args['marca'] ?? '';
        $this->producto = $args['producto'] ?? '';
        $this->gms = $args['gms'] ?? '';
        $this->ancho = $args['ancho'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->total_item = $args['total_item'] ?? '';
        $this->fecha_produccion = $args['fecha_produccion'] ?? '';
        $this->ets = $args['ets'] ?? '';
        $this->eta = $args['eta'] ?? '';
        $this->arribo_planta = $args['arribo_planta'] ?? '';
        $this->transito = $args['transito'] ?? '';
        $this->fecha_en_planta = $args['fecha_en_planta'] ?? '';
        $this->observaciones = $args['observaciones'] ?? '';
    }














}

