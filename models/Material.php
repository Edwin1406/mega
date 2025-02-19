<?php

namespace Model;

class Material extends ActiveRecord {
    protected static $tabla = 'material';
    protected static $columnasDB = ['id_material', 'nombre', 'flauta'];

    public function getPapeles() {
        return Papel::where('material_id', $this->id_material);
    }

    public static function getAllWithPapeles() {
        $query = "SELECT m.id_material, m.nombre AS nombre_material, m.flauta, 
                         p.id_papel, p.codigo, p.descripcion, p.peso 
                  FROM material m
                  LEFT JOIN papel p ON m.id_material = p.material_id";
    
        // Convertimos los objetos devueltos en arreglos asociativos
        return array_map(function($obj) {
            return (array) $obj;
        }, self::consultarSQL($query));
    }
    
}
