<?php

namespace Model;

class Material extends ActiveRecord {
    protected static $tabla = 'material';
    protected static $columnasDB = ['id_material', 'nombre', 'flauta'];

    public $id_material;
    public $nombre;
    public $flauta;
    
    
}
