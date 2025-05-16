<?php

namespace Model;

class Bobina extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_papel';
protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'tipo_clasificacion',
    'SINGLEFACE',
    'EMPALME',
    'RECUB',
    'MECANICO',
    'GALLET',
    'HUMEDO',
    'COMBADO',
    'DESPE',
    'ERROM',
    'DESHOJE',
    'CAMBIO_PEDIDO',
    'FILOS_ROTOS',
    'OTROS',
    'PEDIDOS_CORTOS',
    'DIFER_ANCHO',
    'CAMBIO_GRAMAJE',
    'EXTRA_TRIM',
    'CONSUMO',
    'TOTAL',
    'PORCENTAJE',
    'created_at'
];


    public $id;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $SINGLEFACE;
    public $EMPALME;
    public $RECUB;
    public $MECANICO;
    public $GALLET;
    public $HUMEDO;
    public $COMBADO;
    public $DESPE;
    public $ERROM;
    public $DESHOJE;
    public $CAMBIO_PEDIDO;
    public $FILOS_ROTOS;
    public $OTROS;
    public $PEDIDOS_CORTOS;
    public $DIFER_ANCHO;
    public $CAMBIO_GRAMAJE;
    public $EXTRA_TRIM;
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
        $this->SINGLEFACE = $args['SINGLEFACE'] ?? '';
        $this->EMPALME = $args['EMPALME'] ?? '';
        $this->RECUB = $args['RECUB'] ?? '';
        $this->MECANICO = $args['MECANICO'] ?? '';
        $this->GALLET = $args['GALLET'] ?? '';
        $this->HUMEDO = $args['HUMEDO'] ?? '';
        $this->COMBADO = $args['COMBADO'] ?? '';
        $this->DESPE = $args['DESPE'] ?? '';
        $this->ERROM = $args['ERROM'] ?? '';
        $this->DESHOJE = $args['DESHOJE'] ?? '';
        $this->CAMBIO_PEDIDO = $args['CAMBIO_PEDIDO'] ?? '';
        $this->FILOS_ROTOS = $args['FILOS_ROTOS'] ?? '';
        $this->OTROS = $args['OTROS'] ?? '';
        $this->PEDIDOS_CORTOS = $args['PEDIDOS_CORTOS'] ?? '';
        $this->DIFER_ANCHO = $args['DIFER_ANCHO'] ?? '';
        $this->CAMBIO_GRAMAJE = $args['CAMBIO_GRAMAJE'] ?? '';
        $this->EXTRA_TRIM = $args['EXTRA_TRIM'] ?? '';
        $this->CONSUMO = $args['CONSUMO'] ?? '';
        $this->TOTAL = $args['TOTAL'] ?? '';
        $this->PORCENTAJE = $args['PORCENTAJE'] ?? '';
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        
    }


    
    public function validar() {

        if(!$this->tipo_maquina) {
            self::$alertas['error'][] = 'El Campo Tipo papel es Obligatorio';
        }
       
        
        return self::$alertas;
    }



// public static function sumarTodasLasColumnas()
// {
//     $columnas = [
//         'SINGLEFACE', 'EMPALME', 'RECUB', 'MECANICO', 'GALLET',
//         'HUMEDO', 'COMBADO', 'DESPE', 'ERROM', 'DESHOJE',
//         'CAMBIO_PEDIDO', 'FILOS_ROTOS', 'OTROS', 'PEDIDOS_CORTOS',
//         'DIFER_ANCHO', 'CAMBIO_GRAMAJE', 'EXTRA_TRIM',
//         'CONSUMO', 'TOTAL', 'PORCENTAJE'
//     ];

//     $columnasEscapadas = array_map(fn($col) => "`" . self::$db->real_escape_string($col) . "`", $columnas);
//     $query = "SELECT " . implode(", ", array_map(fn($col) => "SUM($col) AS $col", $columnasEscapadas)) . " FROM " . static::$tabla;

//     $resultado = self::$db->query($query);
//     return $resultado->fetch_assoc();
// }


public static function contarFiltradas($where)
{
    $query = "SELECT COUNT(*) AS total FROM " . static::$tabla . " $where";
    $resultado = self::$db->query($query);
    $fila = $resultado->fetch_assoc();
    return (int) $fila['total'];
}
public static function filtrarPaginadas($where, $limit, $offset)
{
    $query = "SELECT * FROM " . static::$tabla . " $where ORDER BY fecha_corte DESC LIMIT $limit OFFSET $offset";
    $resultado = self::$db->query($query);
    return self::crearObjetos($resultado);
}

public static function crearObjetos($resultado)
{
    $bobinas = [];
    while ($fila = $resultado->fetch_assoc()) {
        $bobinas[] = new self($fila);
    }
    return $bobinas;
}

public static function sumarFiltradas($where)
{
    $columnas = [
        'SINGLEFACE', 'EMPALME', 'RECUB', 'MECANICO', 'GALLET',
        'HUMEDO', 'COMBADO', 'DESPE', 'ERROM', 'DESHOJE',
        'CAMBIO_PEDIDO', 'FILOS_ROTOS', 'OTROS', 'PEDIDOS_CORTOS',
        'DIFER_ANCHO', 'CAMBIO_GRAMAJE', 'EXTRA_TRIM',
        'CONSUMO', 'TOTAL', 'PORCENTAJE'
    ];

    $columnasEscapadas = array_map(fn($col) => "`" . self::$db->real_escape_string($col) . "`", $columnas);
    $query = "SELECT " . implode(", ", array_map(fn($col) => "SUM($col) AS $col", $columnasEscapadas)) . " FROM " . static::$tabla . " $where";

    $resultado = self::$db->query($query);
    return $resultado->fetch_assoc();
}


}