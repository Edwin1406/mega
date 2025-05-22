<?php

namespace Model;

class Empaque extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_empaque';

protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'tipo_clasificacion',
    'GALLET',
    'COMBADO',
    'HUMEDO',
    'FRENO',
    'DESPE',
    'PRESION',
    'ERROM',
    'CUADRE',
    'RECUB',
    'FALTA_TINTA',
    'DERRAME_TINTA',
    'SUSTRATO',
    'MAL_DOBLADO_CEJA',
    'EXCESO_GOMA',
    'CUADRE_SIERRA',
    'CONSUMO',
    'TOTAL',
    'PORCENTAJE',
    'created_at'
];


    public $id;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $GALLET;
    public $COMBADO;
    public $HUMEDO;
    public $FRENO;
    public $DESPE;
    public $PRESION;
    public $ERROM;
    public $CUADRE;
    public $RECUB;
    public $FALTA_TINTA;
    public $DERRAME_TINTA;
    public $SUSTRATO;
    public $MAL_DOBLADO_CEJA;
    public $EXCESO_GOMA;
    public $CUADRE_SIERRA;    
    public $CONSUMO;
    public $TOTAL;
    public $PORCENTAJE;
    public $created_at;
   

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? '';
        
    
        $this->CONSUMO = $args['CONSUMO'] ?? '';
        $this->TOTAL = $args['TOTAL'] ?? '';
        $this->PORCENTAJE = $args['PORCENTAJE'] ?? '';
        $this->created_at = $args['created_at'] ?? date('Y-m-d');
        
    }


    
    public function validar() {

        if(!$this->tipo_maquina) {
            self::$alertas['error'][] = 'El Campo Tipo papel es Obligatorio';
        }
       
        
        return self::$alertas;
    }



public static function sumarTodasLasColumnas()
{
    $columnas = [
        'SINGLEFACE', 'EMPALME', 'RECUB', 'MECANICO', 'GALLET',
        'HUMEDO', 'COMBADO', 'DESPE', 'ERROM', 'DESHOJE',
        'CAMBIO_PEDIDO', 'FILOS_ROTOS','REFILE_PEQUENO', 'PEDIDOS_CORTOS',
        'DIFER_ANCHO', 'CAMBIO_GRAMAJE', 'EXTRA_TRIM',
        'CONSUMO', 'TOTAL', 'PORCENTAJE'
    ];

    $columnasEscapadas = array_map(fn($col) => "`" . self::$db->real_escape_string($col) . "`", $columnas);
    $query = "SELECT " . implode(", ", array_map(fn($col) => "SUM($col) AS $col", $columnasEscapadas)) . " FROM " . static::$tabla;

    $resultado = self::$db->query($query);
    return $resultado->fetch_assoc();
}




public function calcularTotal()
{
    $this->TOTAL =  
        floatval($this->SINGLEFACE) +
        floatval($this->EMPALME) +
        floatval($this->RECUB) +
        floatval($this->GALLET) +
        floatval($this->HUMEDO) +
        floatval($this->COMBADO) +
        floatval($this->DESPE) +
        floatval($this->ERROM) +
        floatval($this->DESHOJE) +
        floatval($this->MECANICO) +
        floatval($this->ELECTRICO) +
        floatval($this->FILOS_ROTOS) +
        floatval($this->REFILE_PEQUENO) +
        floatval($this->PEDIDOS_CORTOS) +
        floatval($this->DIFER_ANCHO) +
        floatval($this->SUSTRATO) +
        floatval($this->CAMBIO_GRAMAJE) +
        floatval($this->CAMBIO_PEDIDO) +
        floatval($this->EXTRA_TRIM) +
        floatval($this->CONSUMO);
    $this->PORCENTAJE = ($this->TOTAL / 100) * 100; // Cambia esto según tu lógica
}




}




