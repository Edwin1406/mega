<?php

namespace Model;

class Bobina extends ActiveRecord
{
    
    protected static $tabla = 'bobinas';
    protected static $columnasDB = ['id', 'tipo_maquina', 'SF', 'LG','ERRO','HUN','MDO','consumo_papel', 'TOTAL','created_at','updated_at'];

    public $id;
    public $tipo_maquina;
    public $SF;
    public $LG;
    public $ERRO;
    public $HUN;
    public $MDO;
    public $consumo_papel;
    public $TOTAL;
    public $created_at;
    public $updated_at;

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->SF = $args['SF'] ?? '';
        $this->LG = $args['LG'] ?? '';
        $this->ERRO = $args['ERRO'] ?? '';
        $this->HUN = $args['HUN'] ?? '';
        $this->MDO = $args['MDO'] ?? '';
        $this->TOTAL = $args['TOTAL'] ?? '';
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');        
    }


    
    public function validar() {

        if(!$this->tipo_maquina) {
            self::$alertas['error'][] = 'El Campo Tipo papel es Obligatorio';
        }
        if(!$this->SF) {
            self::$alertas['error'][] = 'El Campo SF es Obligatorio';
        }
        if(!$this->LG) {
            self::$alertas['error'][] = 'El Campo LG es Obligatorio';
        }
        if(!$this->ERRO) {
            self::$alertas['error'][] = 'El Campo ERRO es Obligatorio';
        }
        if(!$this->HUN) {
            self::$alertas['error'][] = 'El Campo HUN es Obligatorio';
        }
        if(!$this->MDO) {
            self::$alertas['error'][] = 'El Campo MDO es Obligatorio';
        }
        
        return self::$alertas;
    }


}