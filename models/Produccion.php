<?php
namespace Model;

class Produccion extends ActiveRecord{
    protected static $tabla = 'area_produccion';
    protected static $columnasDB = ['id','area_produccion','url','propietarioId'];

    public $id;
    public $area_produccion;
    public $url;
    public $propietarioId;
    public $total;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->area_produccion = $args['area_produccion'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->propietarioId = $args['propietarioId'] ?? '';
    }
   
    public function validar() {

        if(!$this->area_produccion) {
            self::$alertas['error'][] = 'El Campo Area es Obligatorio';
        }
       
        return self::$alertas;
    }


}




?>