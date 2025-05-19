<?php

namespace Model;

class Datareclamos extends ActiveRecord {
    protected static $tabla = 'data_reclamos';
    protected static $columnasDB = ['id','numero','emision','cliente','codigo','descripcion','cantidad','pvp_total','costo','pvp_unid','costo_unid','margen'];


    public $id;
    public $numero;
    public $emision;
    public $cliente;
    public $codigo;
    public $descripcion;
    public $cantidad;
    public $pvp_total;
    public $costo;
    public $pvp_unid;
    public $costo_unid;
    public $margen;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->numero = $args['numero'] ?? '';
        $this->emision = $args['emision'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->codigo = $args['codigo'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->pvp_total = $args['pvp_total'] ?? '';
        $this->costo = $args['costo'] ?? '';
        $this->pvp_unid = $args['pvp_unid'] ?? '';
        $this->costo_unid = $args['costo_unid'] ?? '';
        $this->margen = $args['margen'] ?? '';

    }





    
}





