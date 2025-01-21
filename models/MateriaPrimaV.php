<?php

namespace Model;

class MateriaPrimaV extends ActiveRecord
{   
    protected static $tabla = 'materia_prima_v';
    protected static $columnasDB = ['id','almacen', 'codigo','descripcion','existencia','costo','promedio','talla','linea','gramaje','proveedor','sustrato','created_at','updated_at'];

    public $id;
    public $almacen;
    public $codigo;
    public $descripcion;
    public $existencia;
    public $costo;
    public $promedio;
    public $talla;
    public $linea;
    public $gramaje;
    public $proveedor;
    public $sustrato;
    public $created_at;
    public $updated_at;


    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->almacen = $args['almacen'] ?? '';
        $this->codigo = $args['codigo'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->existencia = $args['existencia'] ?? '';
        $this->costo = $args['costo'] ?? '';
        $this->promedio = $args['promedio'] ?? '';
        $this->talla = $args['talla'] ?? '';
        $this->linea = $args['linea'] ?? '';
        $this->gramaje = $args['gramaje'] ?? '';
        $this->proveedor = $args['proveedor'] ?? '';
        $this->sustrato = $args['sustrato'] ?? '';
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    }





}
