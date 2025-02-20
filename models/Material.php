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
                  LEFT JOIN papel_material pm ON m.id_material = pm.id_material
                  LEFT JOIN papel p ON pm.id_papel = p.id_papel
                  ORDER BY m.id_material, p.id_papel";
    
        $resultado = self::arrayasociativo($query);
    
        // Agrupar los materiales y sus papeles en un array estructurado
        $materiales = [];
        foreach ($resultado as $fila) {
            $materialId = $fila['material_id'];
    
            // Si el material no está en la lista, lo agregamos
            if (!isset($materiales[$materialId])) {
                $materiales[$materialId] = [
                    'id' => $materialId,
                    'material' => $fila['nombre_material'],
                    'flauta' => $fila['flauta'],
                    'papeles' => []
                ];
            }
    
            // Verificamos si el papel tiene valores antes de agregarlo (evita entradas nulas)
            if (!is_null($fila['papel_id'])) {
                $materiales[$materialId]['papeles'][] = [
                    'codigo' => $fila['codigo_papel'],
                    'peso' => $fila['peso'],
                    'descripcion' => $fila['descripcion_papel']
                ];
            }
        }
    
        return array_values($materiales); // Convertir a array indexado para JSON limpio
    }
    

    
    // public static function obtenerMaterialesConPapeles() {
    //     $query = "SELECT 
    //                 m.id_material AS material_id,
    //                 m.nombre AS nombre_material,
    //                 m.flauta,
    //                 p.id_papel AS papel_id,
    //                 p.codigo AS codigo_papel,
    //                 p.descripcion AS descripcion_papel,
    //                 p.peso,
    //                 f.id_formato AS formato_id,
    //                 f.ancho,
    //                 f.rifile,
    //                 f.max_kg
    //               FROM material m
    //               LEFT JOIN papel p ON m.id_material = p.material_id
    //               LEFT JOIN formatos_disponibles f ON m.id_material = f.material_id
    //               ORDER BY m.id_material, p.id_papel, f.id_formato";
    
    //     $resultado = self::arrayasociativo($query);
    
    //     // Agrupar los materiales con sus papeles y formatos en un array estructurado
    //     $materiales = [];
    //     foreach ($resultado as $fila) {
    //         $nombreMaterial = $fila['nombre_material'];
    //         $flauta = $fila['flauta'];
    
    //         // Si el material no está en la lista, lo agregamos
    //         if (!isset($materiales[$nombreMaterial])) {
    //             $materiales[$nombreMaterial] = [
    //                 'id' => $fila['material_id'],
    //                 'material' => $nombreMaterial,
    //                 'flauta' => $flauta,
    //                 'papeles' => [],
    //                 'formatos_disponibles' => []
    //             ];
    //         }
    
    //         // Agregar los papeles al material correspondiente (evitar duplicados)
    //         $papel = [
    //             'codigo' => $fila['codigo_papel'],
    //             'peso' => $fila['peso'],
    //             'descripcion' => $fila['descripcion_papel']
    //         ];
    
    //         if (!in_array($papel, $materiales[$nombreMaterial]['papeles'])) {
    //             $materiales[$nombreMaterial]['papeles'][] = $papel;
    //         }
    
    //         // Agregar los formatos disponibles al material correspondiente (evitar duplicados)
    //         $formato = [
    //             'ancho' => $fila['ancho'],
    //             'rifile' => $fila['rifile'],
    //             'max_kg' => $fila['max_kg']
    //         ];
    
    //         if (!in_array($formato, $materiales[$nombreMaterial]['formatos_disponibles'])) {
    //             $materiales[$nombreMaterial]['formatos_disponibles'][] = $formato;
    //         }
    //     }
    
    //     return array_values($materiales); // Convertir a array indexado para el JSON
    // }
    

    
}
