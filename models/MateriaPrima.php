<?php

namespace Model;

class MateriaPrima extends ActiveRecord
{
    protected static $tabla = 'materia_prima';
    protected static $columnasDB = ['id','nombre_rollo','tipo', 'ancho','barcode','peso','gramaje','ced','proveedor','precio','created_at','updated_at'];

    public $id;
    public $nombre_rollo;
    public $tipo;
    public $ancho;
    public $barcode;
    public $peso;
    public $gramaje;
    public $ced;
    public $proveedor;
    public $precio;
    public $created_at;
    public $updated_at;
    public $menos_peso;
   
    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->nombre_rollo = $args['nombre_rollo'] ?? '';
        $this->tipo = $args['tipo'] ?? '';
        $this->ancho = $args['ancho'] ?? '';
        $this->barcode = $args['barcode'] ?? '';
        $this->peso = $args['peso'] ?? '0';
        $this->gramaje = $args['gramaje'] ?? '';
        $this->ced = $args['ced'] ?? '';
        $this->proveedor = $args['proveedor'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    }


    public function validar() {
        if(!$this->nombre_rollo) {
            self::$alertas['error'][] = 'El Campo Nombre del Rollo es Obligatorio';
        }
        if(!$this->tipo) {
            self::$alertas['error'][] = 'El Campo Tipo es Obligatorio';
        }

        if(!$this->ancho) {
            self::$alertas['error'][] = 'El Campo Ancho  es Obligatorio';
        }
        // quiero menos peso sea menor al peso actual caso contrario muestre un error
        if($this->menos_peso <= $this->peso){
            self::$alertas['error'][] = 'El Campo Menos Peso no puede ser mayor al Peso Actual';
        }
        if(!$this->gramaje) {
            self::$alertas['error'][] = 'El Campo Gramaje es Obligatorio';
        }

        if(!$this->ced) {
            self::$alertas['error'][] = 'El Campo CED es Obligatorio';
        }

        if(!$this->proveedor) {
            self::$alertas['error'][] = 'El Campo Proveedor es Obligatorio';
        }

    

        return self::$alertas;

    }


    public function sha1() {
        $this->barcode = substr(md5(uniqid(mt_rand(), true)), 0, 12);
    }
    



}



?>