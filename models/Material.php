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

        $resultado = self::arrayasociativo($query);

        // Agrupar los materiales y sus papeles en un array estructurado
        $materiales = [];
        foreach ($resultado as $fila) {
            $nombreMaterial = $fila['nombre_material'];
            $flauta = $fila['flauta'];

            // Si el material no está en la lista, lo agregamos
            if (!isset($materiales[$nombreMaterial])) {
                $materiales[$nombreMaterial] = [
                    'id' => $fila['material_id'],
                    'material' => $nombreMaterial,
                    'flauta' => $flauta,
                    'papeles' => []
                ];
            }

            // Agregar los papeles al material correspondiente
            $materiales[$nombreMaterial]['papeles'][] = [
                'codigo' => $fila['codigo_papel'],
                'peso' => $fila['peso'],
                'descripcion' => $fila['descripcion_papel']
            ];
        }

        return array_values($materiales); // Convertir a array indexado para el JSON
    }

    

    
}
