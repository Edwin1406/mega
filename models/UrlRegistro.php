<?php 
namespace Model;

class UrlRegistro extends ActiveRecord{
    protected static $tabla = 'area_registro';
    protected static $columnasDB = ['id','area_registro','url','propietarioId'];

    public $id;
    public $area_registro;
    public $url;
    public $propietarioId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->url = $args['url'] ?? '';
        $this->propietarioId = $args['propietarioId'] ?? '';
    }
   
}