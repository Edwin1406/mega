<?php

namespace Model;

class Comercial extends ActiveRecord {
    protected static $tabla = 'pedidos_proyectos';
    protected static $columnasDB = [
        'id',
        'import',
        'proyecto',
        'pedido_interno',
        'fecha_solicitud',
        'puerto_destino',
        'trader',
        'marca',
        'linea',
        'producto',
        'gramaje',
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
        'estado',
        'fecha_corte',
    ];

    public $id;
    public $import;
    public $proyecto;
    public $pedido_interno;
    public $fecha_solicitud;
    public $puerto_destino;
    public $trader;
    public $marca;
    public $linea;
    public $producto;
    public $gramaje;
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
    public $estado;
    public $fecha_corte;



    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->import = $args['import'] ?? '';
        $this->proyecto = $args['proyecto'] ?? '';
        $this->pedido_interno = $args['pedido_interno'] ?? '';
        $this->fecha_solicitud = date('Y-m-d H:i:s'); 
        $this->puerto_destino = $args['puerto_destino'] ?? '';
        $this->trader = $args['trader'] ?? '';
        $this->marca = $args['marca'] ?? '';
        $this->linea = $args['linea'] ?? '';
        $this->producto = $args['producto'] ?? '';
        $this->gramaje = $args['gramaje'] ?? '';
        $this->ancho = $args['ancho'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->total_item = $args['total_item'] ?? '';
        $this->fecha_produccion = $args['fecha_produccion'] ?? '';
        $this->arribo_planta = $args['arribo_planta'] ?? '';
        $this->transito = $args['transito'] ?? '';
        $this->fecha_en_planta = $args['fecha_en_planta'] ?? '';
        $this->estado = $args['estado'] ?? '';
        $this->fecha_corte = $args['fecha_corte'] ?? '';
    }


  public function validar() {

        if(!$this->import) {
            self::$alertas['error'][] = 'El Campo Import es Obligatorio';
        }


        if(!$this->pedido_interno) {
            self::$alertas['error'][] = 'El Campo Pedido Interno es Obligatorio';
        }


        if(!$this->puerto_destino) {
            self::$alertas['error'][] = 'El Campo Puerto Destino es Obligatorio';
        }

        if(!$this->trader) {
            self::$alertas['error'][] = 'El Campo Trader es Obligatorio';
        }

        if(!$this->marca) {
            self::$alertas['error'][] = 'El Campo Marca es Obligatorio';
        }

        if(!$this->producto) {
            self::$alertas['error'][] = 'El Campo Producto es Obligatorio';
        }

        if(!$this->gramaje) {
            self::$alertas['error'][] = 'El Campo GMS es Obligatorio';
        }

        if(!$this->ancho) {
            self::$alertas['error'][] = 'El Campo Ancho es Obligatorio';
        }

        if(!$this->cantidad) {
            self::$alertas['error'][] = 'El Campo Cantidad es Obligatorio';
        }

        if(!$this->precio) {
            self::$alertas['error'][] = 'El Campo Precio es Obligatorio';
        }


        if(!$this->fecha_produccion) {
            self::$alertas['error'][] = 'El Campo Fecha Producción es Obligatorio';
        }

        if(!$this->arribo_planta) {
            self::$alertas['error'][] = 'El Campo Arribo Planta es Obligatorio';
        }

        if(!$this->estado) {
            self::$alertas['error'][] = 'El Campo Estado es Obligatorio';
        }
        
        return self::$alertas;

}
     

public function calcularTotal() {  
    $this->total_item = $this->cantidad * $this->precio;
    return $this->total_item;
 }


 public function calcularTransito() {
    $diferenciaDias = strtotime($this->fecha_produccion) - strtotime($this->arribo_planta);
    $diferenciaDias = $diferenciaDias / (60 * 60 * 24);
    $this->transito = (int)$diferenciaDias;
    return $this->transito;  
 }


 public  static function convertirFechaExcel($fechaExcel) {
    $fecha = date('Y-m-d', ($fechaExcel - 25569) * 86400);
    return $fecha;
}


 public static function sumarExistenciaPorMes($tipo)
    {
        $query = "SELECT SUM(cantidad) AS total 
                  FROM " . static::$tabla . " 
                  WHERE linea = '" . self::$db->real_escape_string($tipo) . "'
                  AND MONTH(fecha_corte) = MONTH(CURDATE())
                  AND YEAR(fecha_corte) = YEAR(CURDATE())";
        $resultado = self::$db->query($query);
        $fila = $resultado->fetch_assoc();
        return (float) $fila['total'] ?? 0;
    }

public static function sumarExistenciaPorMesComercial($tipo)
{
    $query = "SELECT SUM(cantidad) AS total 
              FROM " . static::$tabla . " 
              WHERE linea = '" . self::$db->real_escape_string($tipo) . "'
              AND MONTH(fecha_corte) = MONTH(CURDATE())
              AND YEAR(fecha_corte) = YEAR(CURDATE())";
    
    $resultado = self::$db->query($query);
    $fila = $resultado->fetch_assoc();

    // Convertimos a float y lo formateamos con 2 decimales, usando punto como separador decimal
    $total = (float) ($fila['total'] ?? 0);
    return number_format($total, 3, '.', '');
}










}

