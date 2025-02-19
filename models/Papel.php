<?php

namespace Model;

class Papel extends ActiveRecord {
    protected static $tabla = 'papel';
    protected static $columnasDB = ['id_papel', 'codigo', 'descripcion', 'peso', 'material_id'];
}
