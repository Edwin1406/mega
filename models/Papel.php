<?php

namespace Model;

class Papel extends ActiveRecord {
    protected static $tabla = 'papel';
    protected static $columnasDB = ['id_papel', 'codigo', 'descripcion', 'peso', 'gramaje'];

    public $id_papel;
    public $codigo;
    public $descripcion;
    public $peso;
    public $gramaje;


    
}





