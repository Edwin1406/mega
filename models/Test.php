<?php 

  namespace Model;
  
  class Test extends ActiveRecord {
  
      protected static $tabla = 'test';
      protected static $columnasDB = ['id','ect','test','liner_interno','liner_externo','peso'];
  
        public $id;
        public $ect;
        public $test;
        public $liner_interno;
        public $liner_externo;
        public $peso;

  
        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->ect = $args['ect'] ?? '';
            $this->test = $args['test'] ?? '';
            $this->liner_interno = $args['liner_interno'] ?? '';
            $this->liner_externo = $args['liner_externo'] ?? '';
            $this->peso = $args['peso'] ?? '';
        }
    }