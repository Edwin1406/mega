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


    public static function sumarExistenciaPorFecha($tipo, $fecha)
    {
        $query = "SELECT SUM(existencia) as total FROM " . static::$tabla . " 
                  WHERE linea = '" . self::$db->real_escape_string($tipo) . "'
                  AND fecha_corte = '$fecha'";
        $resultado = self::$db->query($query);
        $fila = $resultado->fetch_assoc();
        return (float) $fila['total'] ?? 0;
    }
    
    public static function allkilogramosPorFecha($orden = 'DESC', $fecha)
    {
        $query = "SELECT * FROM " . static::$tabla . " 
                  WHERE fecha_corte = '$fecha'
                  ORDER BY existencia $orden";
        return self::consultarSQL($query);
    }
    


}
