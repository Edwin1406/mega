<?php

namespace Model;

class MateriaPrimaV extends ActiveRecord
{   
    protected static $tabla = 'materia_prima_v';
    protected static $columnasDB = ['id','almacen','codigo','descripcion','existencia','costo','promedio','talla','linea','gramaje','proveedor','sustrato','ancho','fecha_corte'];

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
    public $ancho;
    public $fecha_corte;


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
        $this->ancho = $args['ancho'] ?? '';
        $this->fecha_corte = $args['fecha_corte'] ?? date('Y-m-d H:i:s');
        
    }


    public static function sumarExistenciaPorMes($tipo)
    {
        $query = "SELECT SUM(existencia) AS total 
                  FROM " . static::$tabla . " 
                  WHERE linea = '" . self::$db->real_escape_string($tipo) . "'
                  AND MONTH(fecha_corte) = MONTH(CURDATE())
                  AND YEAR(fecha_corte) = YEAR(CURDATE())";
        $resultado = self::$db->query($query);
        $fila = $resultado->fetch_assoc();
        return (float) $fila['total'] ?? 0;
    }
    
    public static function allkilogramosPorMes($orden = 'DESC')
{
    $query = "SELECT * FROM " . static::$tabla . "
              WHERE MONTH(fecha_corte) = MONTH(CURDATE())
              AND YEAR(fecha_corte) = YEAR(CURDATE())
              ORDER BY existencia $orden";
    return self::consultarSQL($query);
}



}
