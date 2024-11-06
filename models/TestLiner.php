<?php 

  namespace Model;
  
  class TestLiner extends ActiveRecord {
  
      protected static $tabla = 'test-liner';
      protected static $columnasDB = ['id','ect','test','liner_interno','liner_externo'];
  
        public $id;
        public $ect;
        public $test;
        public $liner_interno;
        public $liner_externo;

  
        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->ect = $args['ect'] ?? '';
            $this->test = $args['test'] ?? '';
            $this->liner_interno = $args['liner_interno'] ?? '';
            $this->liner_externo = $args['liner_externo'] ?? '';
        }
    }