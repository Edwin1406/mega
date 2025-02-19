<?php

namespace Model;

class Material extends ActiveRecord {
    protected static $tabla = 'material';
    protected static $columnasDB = ['id_material', 'nombre', 'flauta'];

    public $id_material;
    public $nombre;
    public $flauta;


    public static function obtenerMaterialesConPapeles() {
        $query = "SELECT 
                    m.id_material AS material_id,
                    m.nombre AS nombre_material,
                    m.flauta,
                    p.id_papel AS papel_id,
                    p.codigo AS codigo_papel,
                    p.descripcion AS descripcion_papel,
                    p.peso
                  FROM material m
                  LEFT JOIN papel p ON m.id_material = p.material_id
                  ORDER BY m.id_material, p.id_papel";
        
        $resultado = self::consultarSQL($query);
    
        return $resultado;
    }
    

    

    
}
