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


public static function clientesUnicos()
{
    $sql = "SELECT DISTINCT cliente FROM " . static::$tabla . " ORDER BY cliente ASC";
    return self::consultarSQL($sql);
}

public static function facturasPorCliente($cliente)
{
    $cliente = self::$db->real_escape_string($cliente);
    $sql = "SELECT DISTINCT numero FROM " . static::$tabla . " WHERE cliente = '{$cliente}' ORDER BY numero ASC";
    $resultados = self::consultarSQL($sql);
    return array_map(fn($row) => $row->numero, $resultados);
}

// factura por numeropordescricion del cliente
public static function descripcionesPorClienteFactura($cliente, $factura)
{
    $cliente = self::$db->real_escape_string($cliente);
    $factura = self::$db->real_escape_string($factura);

    $sql = "SELECT DISTINCT descripcion 
            FROM " . static::$tabla . " 
            WHERE cliente = '{$cliente}' AND numero = '{$factura}'
            ORDER BY descripcion ASC";

    $resultados = self::consultarSQL($sql);
    return array_map(fn($row) => $row->descripcion, $resultados);
}


public static function fechaPorClienteDescripcion($cliente, $descripcion)
{
    $cliente = self::$db->real_escape_string($cliente);
    $descripcion = self::$db->real_escape_string($descripcion);

    $sql = "SELECT emision 
            FROM " . static::$tabla . " 
            WHERE cliente = '{$cliente}' 
              AND descripcion = '{$descripcion}' 
            LIMIT 1";

    $resultado = self::consultarSQL($sql);
    return $resultado[0]->emision ?? '';
}



    
}





