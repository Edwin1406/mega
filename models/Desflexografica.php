<?php

namespace Model;

class Desflexografica extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_flexografica';
protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'tipo_clasificacion',
    'CUADRE',
    'FALTA_TINTA',
    'MALTRATO_TRASPORT',
    'MALTRATO_MONTACARGAS',
    'TONALIDAD_TINTAS',
    'TROQUEL',
    'MONTAJE_CLICHE',
    'MECANICO',
    'ELECTRICO',
    'GALLET',
    'COMBADO',
    'HUMEDO',
    'DESPEGADO',
    'ERROM',
    'SUSTRATO',
    'TOTAL'
  
];


    public $id;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $CUADRE;
    public $FALTA_TINTA;
    public $MALTRATO_TRASPORT;
    public $MALTRATO_MONTACARGAS;
    public $TONALIDAD_TINTAS;
    public $TROQUEL;
    public $MONTAJE_CLICHE;
    public $MECANICO;
    public $ELECTRICO;
    public $GALLET;
    public $COMBADO;
    public $HUMEDO;
    public $DESPEGADO;
    public $ERROM;
    public $SUSTRATO;
    public $TOTAL;

    
   

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? '';
        $this->CUADRE = $args['CUADRE'] ?? '';
        $this->FALTA_TINTA = $args['FALTA_TINTA'] ?? '';
        $this->MALTRATO_TRASPORT = $args['MALTRATO_TRASPORT'] ?? '';
        $this->MALTRATO_MONTACARGAS = $args['MALTRATO_MONTACARGAS'] ?? '';
        $this->TONALIDAD_TINTAS = $args['TONALIDAD_TINTAS'] ?? '';
        $this->TROQUEL = $args['TROQUEL'] ?? '';
        $this->MONTAJE_CLICHE = $args['MONTAJE_CLICHE'] ?? '';
        $this->MECANICO = $args['MECANICO'] ?? '';
        $this->ELECTRICO = $args['ELECTRICO'] ?? '';
        $this->GALLET = $args['GALLET'] ?? '';
        $this->COMBADO = $args['COMBADO'] ?? '';
        $this->HUMEDO = $args['HUMEDO'] ?? '';
        $this->DESPEGADO = $args['DESPEGADO'] ?? '';
        $this->ERROM = $args['ERROM'] ?? '';
        $this->SUSTRATO = $args['SUSTRATO'] ?? '';     
        $this->TOTAL = $args['TOTAL'] ?? '';
     
        
    }


    
    public function validar() {

        if(!$this->tipo_maquina) {
            self::$alertas['error'][] = 'El Campo Tipo papel es Obligatorio';
        }
       
        
        return self::$alertas;
    }

public function calcularTotal()
{
    $this->TOTAL =  
        floatval($this->CUADRE) +
        floatval($this->FALTA_TINTA) +
        floatval($this->MALTRATO_TRASPORT) +
        floatval($this->MALTRATO_MONTACARGAS) +
        floatval($this->TONALIDAD_TINTAS) +
        floatval($this->TROQUEL) +
        floatval($this->MONTAJE_CLICHE) +
        floatval($this->MECANICO) +
        floatval($this->ELECTRICO) +
        floatval($this->GALLET) +
        floatval($this->COMBADO) +
        floatval($this->HUMEDO) +
        floatval($this->DESPEGADO) +
        floatval($this->ERROM) +
        floatval($this->SUSTRATO);
    // $this->TOTAL = number_format($this->TOTAL, 2);
    $this->TOTAL = round($this->TOTAL, 2);
    return $this->TOTAL;
        
}




}