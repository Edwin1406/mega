<?php

namespace Model;

class Cotizar extends ActiveRecord{
    protected static $tabla = 'combinaciones';
    protected static $columnasDB = ['id','bobina_interna_id','bobina_media_id','bobina_externa_id','num_piezas','posicion_cuchillas','desperdicio','gramaje_total','estado_combinacion','maquina_id',];

    public $id;
    public $bobina_interna_id;
    public $bobina_media_id;
    public $bobina_externa_id;
    public $num_piezas;
    public $posicion_cuchillas;
    public $desperdicio;
    public $gramaje_total;
    public $estado_combinacion;
    public $maquina_id;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->bobina_interna_id = $args['bobina_interna_id'] ?? '';
        $this->bobina_media_id = $args['bobina_media_id'] ?? '';
        $this->bobina_externa_id = $args['bobina_externa_id'] ?? '';
        $this->num_piezas = $args['num_piezas'] ?? '';
        $this->posicion_cuchillas = $args['posicion_cuchillas'] ?? '';
        $this->desperdicio = $args['desperdicio'] ?? '';
        $this->gramaje_total = $args['gramaje_total'] ?? '';
        $this->estado_combinacion = $args['estado_combinacion'] ?? '';
        $this->maquina_id = $args['maquina_id'] ?? '';
    }


    









}


?>