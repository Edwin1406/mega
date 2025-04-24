<?php
namespace Model;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;




class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Alertas y Mensajes
    protected static $alertas = [];
    
    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    // Setear un tipo de Alerta
    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Obtener las alertas
    public static function getAlertas() {
        return static::$alertas;
    }

    // Validación que se hereda en modelos
    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria (Active Record)
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    // public function sanitizarAtributos() {
    //     $atributos = $this->atributos();
    //     $sanitizado = [];
    //     foreach($atributos as $key => $value ) {
    //         $sanitizado[$key] = self::$db->escape_string($value);
    //     }
    //     return $sanitizado;
    // }
   


    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value ?? '');
        }
        return $sanitizado;
    }
    
    

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    // Registros - CRUD
    
    public function guardar() {
        $resultado = '';
        if(!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    // enviar on id para actualizar 
    public function guardarNuevo() {
        $resultado = '';
        if(!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crearNuevo();
        }
        return $resultado;
    }


    public function crearNuevo() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
    
        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
    
        // Resultado de la consulta
        $resultado = self::$db->query($query);
    
        // Asignar el ID generado al objeto
        if ($resultado) {
            $this->id = self::$db->insert_id;  // Asigna el ID generado
        }
    
        return [
            'resultado' =>  $resultado,
            'id' => $this->id // Retorna el ID asignado
        ];
    }
    

    
    



    // Obtener todos los Registros
    public static function all($orden = 'DESC') {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id {$orden}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }


    

    // devuelve array asociativo 
    public static function arrayasociativo($query) {
        $resultado = self::$db->query($query);
        $array = [];
    
        while ($fila = $resultado->fetch_assoc()) { // Devuelve un array asociativo en lugar de objetos
            $array[] = $fila;
        }
    
        return $array;
    }
    



    public static function datoscompletos($orden = 'DESC', $filtro = null) {
        $query = "SELECT * FROM " . static::$tabla;
        if ($filtro) {
            $query .= " WHERE linea LIKE '%{$filtro}%'";
        }
        $query .= " ORDER BY id {$orden}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
//-----------------------------------------------------------------------------

    public static function filtrarYPaginar($filtros, $limite, $offset)
{
    $query = "SELECT * FROM pedidos WHERE 1";

    if (!empty($filtros['fecha_entrega'])) {
        $query .= " AND fecha_entrega = '" . self::$db->escape_string($filtros['fecha_entrega']) . "'";
    }

    if (!empty($filtros['test'])) {
        $query .= " AND test LIKE '%" . self::$db->escape_string($filtros['test']) . "%'";
    }

    $query .= " LIMIT {$limite} OFFSET {$offset}";

    return self::consultarSQL($query);
}

public static function total1($filtros = [])
{
    $query = "SELECT COUNT(*) as total FROM pedidos WHERE 1";

    if (!empty($filtros['fecha_entrega'])) {
        $query .= " AND fecha_entrega = '" . self::$db->escape_string($filtros['fecha_entrega']) . "'";
    }

    if (!empty($filtros['test'])) {
        $query .= " AND test LIKE '%" . self::$db->escape_string($filtros['test']) . "%'";
    }

    $resultado = self::$db->query($query);
    $fila = $resultado->fetch_assoc();
    return $fila['total'] ?? 0;
}








    //TRIMAR OBTENER SOLO CAJAS 

    public static function trimarcj($orden = 'DESC', $filtro = null) {
        $query = "SELECT * FROM " . static::$tabla;
        if ($filtro) {
            $query .= " WHERE nombre_pedido LIKE '%{$filtro}%'";
        }
        $query .= " ORDER BY id {$orden}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }






    // Obtener todos los registros con menos de 100 en existencia
public static function menosDeCien($orden = 'DESC') {
    $query = "SELECT * FROM " . static::$tabla . " WHERE existencia <= 100 ORDER BY id {$orden}";
    $resultado = self::consultarSQL($query);
    return $resultado;
}

    
    
    

  
    // public static function filtrarPorGramajeYAncho($gramaje = null, $ancho = null, $orden = 'DESC') {
    //     // Construir la base de la consulta
    //     $query = "SELECT * FROM " . static::$tabla;
    
    //     // Crear un array para las condiciones
    //     $condiciones = [];
    
    //     // Agregar condiciones según los parámetros recibidos
    //     if (!empty($gramaje)) {
    //         $condiciones[] = "gramaje = '" . self::escape($gramaje) . "'";
    //     }
    //     if (!empty($ancho)) {
    //         $condiciones[] = "ancho = '" . self::escape($ancho) . "'";
    //     }
    //     // Si hay condiciones, añadirlas a la consulta
    //     if (!empty($condiciones)) {
    //         $query .= " WHERE " . implode(' AND ', $condiciones);
    //     }
    
    //     // Agregar orden
    //     $query .= " ORDER BY id {$orden}";
    
    //     // Ejecutar la consulta y devolver los resultados
    //     $resultado = self::consultarSQL($query);
    //     return $resultado;
    // }
    

    protected static function escape($valor) {
        return mysqli_real_escape_string(self::$db, $valor);
    }
    

    public static function filtrarPorGramajeYAncho($gramajeRango = null, $ancho = null, $orden = 'DESC') {
        // Construir la base de la consulta
        $query = "SELECT * FROM " . static::$tabla;
    
        // Crear un array para las condiciones
        $condiciones = [];
    
        // Descomponer el rango de gramaje
        if (!empty($gramajeRango)) {
            [$gramajeMin, $gramajeMax] = explode('-', $gramajeRango);
            $condiciones[] = "gramaje BETWEEN '" . self::escape($gramajeMin) . "' AND '" . self::escape($gramajeMax) . "'";
        }
    
        // Agregar condiciones para el ancho
        if (!empty($ancho)) {
            $condiciones[] = "ancho = '" . self::escape($ancho) . "'";
        }
    
        // Si hay condiciones, añadirlas a la consulta
        if (!empty($condiciones)) {
            $query .= " WHERE " . implode(' AND ', $condiciones);
        }
    
        // Agregar orden
        $query .= " ORDER BY id {$orden}";
    
        // Ejecutar la consulta y devolver los resultados
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    


    // // Obtener todos los Registros con una condición caja
    // public static function allc($orden = 'DESC', $linea = null) {
    //     // Construye la consulta SQL base
    //     // $query = "SELECT * FROM " . static::$tabla;
    //     $query = "SELECT id,existencia,linea,gramaje,proveedor,sustrato,ancho FROM " . static::$tabla;

    
    //     // Agrega una cláusula WHERE si se proporciona un valor para $linea
    //     if ($linea !== null) {
    //         $query .= " WHERE linea LIKE '%" . addslashes($linea) . "%'";
    //     }
    
    //     // Agrega la cláusula ORDER BY
    //     $query .= " ORDER BY id {$orden}";
    
    //     // Ejecuta la consulta y devuelve el resultado
    //     $resultado = self::consultarSQL($query);
    //     return $resultado;
    // }

    public static function allc($orden = 'DESC', $lineas = null) {
        // Construye la consulta base
        $query = "SELECT id, existencia, linea, gramaje, proveedor, sustrato, ancho FROM " . static::$tabla;
    
        // Manejar múltiples líneas con coincidencias parciales
        if ($lineas !== null) {
            if (is_array($lineas)) {
                // Crear condiciones con LIKE para cada línea
                $condiciones = array_map(function($linea) {
                    return "linea LIKE '%" . addslashes($linea) . "%'";
                }, $lineas);
                $query .= " WHERE " . implode(" OR ", $condiciones);
            } else {
                // Aplicar filtro normal si es solo un string
                $query .= " WHERE linea LIKE '%" . addslashes($lineas) . "%'";
            }
        }
    
        // Agrega la cláusula ORDER BY
        $query .= " ORDER BY id {$orden}";
    
        // Ejecuta la consulta y devuelve el resultado
        $resultado = self::consultarSQL($query);
        return $resultado;
    }





    public static function allcorrugador($orden = 'DESC', $lineas = null) {
        // Construye la consulta base
        $query = "SELECT id, existencia, linea, gramaje, proveedor, sustrato, ancho FROM " . static::$tabla;
    
        // Manejar múltiples líneas con coincidencias parciales
        $filtros = [];
    
        if ($lineas !== null) {
            if (is_array($lineas)) {
                // Crear condiciones con LIKE para cada línea
                $condiciones = array_map(function($linea) {
                    return "linea LIKE '%" . addslashes($linea) . "%'";
                }, $lineas);
                $filtros[] = "(" . implode(" OR ", $condiciones) . ")";
            } else {
                $filtros[] = "linea LIKE '%" . addslashes($lineas) . "%'";
            }
        }
    
        // Filtro adicional para los anchos específicos
        $filtros[] = "(ancho = 1880 OR ancho = 1100)";
    
        // Si hay filtros, agrégalos a la consulta
        if (!empty($filtros)) {
            $query .= " WHERE " . implode(" AND ", $filtros);
        }
    
        // Agrega la cláusula ORDER BY
        $query .= " ORDER BY id {$orden}";
    
        // Ejecuta la consulta y devuelve el resultado
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    
    
    public static function allcorrugadorsobrante($orden = 'DESC', $lineas = null) {
        // Construye la consulta base
        $query = "SELECT id, existencia, linea, gramaje, proveedor, sustrato, ancho FROM " . static::$tabla;
    
        // Manejar múltiples líneas con coincidencias parciales
        $filtros = [];
    
        if ($lineas !== null) {
            if (is_array($lineas)) {
                // Crear condiciones con LIKE para cada línea
                $condiciones = array_map(function($linea) {
                    return "linea LIKE '%" . addslashes($linea) . "%'";
                }, $lineas);
                $filtros[] = "(" . implode(" OR ", $condiciones) . ")";
            } else {
                $filtros[] = "linea LIKE '%" . addslashes($lineas) . "%'";
            }
        }
    
        // Filtro adicional para excluir anchos específicos
        $filtros[] = "(ancho <> 1880 AND ancho <> 1100)";
    
        // Si hay filtros, agrégalos a la consulta
        if (!empty($filtros)) {
            $query .= " WHERE " . implode(" AND ", $filtros);
        }
    
        // Agrega la cláusula ORDER BY
        $query .= " ORDER BY id {$orden}";
    
        // Ejecuta la consulta y devuelve el resultado
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    



    

    // Obtener todos los Registros con una condición caja
    public static function allcc($orden = 'DESC', $linea = null) {
        // Construye la consulta SQL base
        // $query = "SELECT * FROM " . static::$tabla;
        $query = "SELECT * FROM " . static::$tabla;

    
        // Agrega una cláusula WHERE si se proporciona un valor para $linea
        if ($linea !== null) {
            $query .= " WHERE linea LIKE '%" . addslashes($linea) . "%'";
        }
    
        // Agrega la cláusula ORDER BY
        $query .= " ORDER BY id {$orden}";
    
        // Ejecuta la consulta y devuelve el resultado
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    







    
    // contador de registro por linea
    public static function countByLinea($linea = null) {
        // Construye la consulta base
        $query = "SELECT COUNT(*) as total FROM " . static::$tabla;
        // Agrega una cláusula WHERE si se proporciona un valor para $linea
        if ($linea !== null) {
            $query .= " WHERE linea LIKE '%" . addslashes($linea) . "%'";
        }
        // Ejecuta la consulta y obtiene el resultado
        $resultado = self::consultarSQL1($query);
        // Devuelve el total si existe en el resultado
        if (is_array($resultado) && isset($resultado[0]['total'])) {
            return (int) $resultado[0]['total'];
        }
        return 0;
    }
    
    public static function consultarSQL1($query) {
        $resultado = self::$db->query($query);
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = $registro;
        }
        return $array;
    }
    
    // sumar existencia 

    public static function sumarExistencia($linea = null) {
        // Construye la consulta SQL base
        $query = "SELECT  SUM(existencia) as total FROM " . static::$tabla;
    
        // Agrega una cláusula WHERE si se proporciona un valor para $linea
        if ($linea !== null) {
            $query .= " WHERE linea LIKE '%" . addslashes($linea) . "%'";
        }
        // Ejecutar la consulta usando `consultarValor`
        return (float) self::consultarValor($query);
    }




    // sumar costo
    public static function sumarCosto($linea = null) {
        // Construye la consulta SQL base
        $query = "SELECT SUM(costo) as total FROM " . static::$tabla;
    
        // Agrega una cláusula WHERE si se proporciona un valor para $linea
        if ($linea !== null) {
            $query .= " WHERE linea LIKE '%" . addslashes($linea) . "%'";
        }
        // Ejecutar la consulta usando `consultarValor`
        return (float) self::consultarValor($query);
    }


    
    public static function allKilogramos() {
        // Construye la consulta SQL base
        $query = "SELECT SUM(existencia) as total FROM " . static::$tabla;
        // Ejecutar la consulta usando `consultarValor`
        return (float) self::consultarValor($query);
    }
    

    
    public static function consultarValor($query) {
        // Ejecutar la consulta
        $resultado = self::$db->query($query);
        // Obtener la primera fila del resultado
        $fila = $resultado->fetch_assoc();
        // Liberar la memoria
        $resultado->free();
    
        // Retornar el primer valor (primer columna de la fila)
        return $fila ? array_values($fila)[0] : 0;
    }
    





    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

  
    

    // Obtener Registros con cierta cantidad
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite} ORDER BY id DESC" ;
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // del paginador 
    public static function paginar($por_pagina,$offset){
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC LIMIT {$por_pagina}  OFFSET {$offset} " ;
        $resultado = self::consultarSQL($query);
        return  $resultado ;
        
     }



    // Busqueda Where con Columna 
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }


    public static function wherenuevo($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return $resultado; // Ahora devuelve todos los resultados
    }
    

    // Retornar los registros por un orden 

    public static function ordenar($columna, $orden) {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY {$columna} {$orden}";
        $resultado = self::consultarSQL($query);
        return  $resultado ;
    }





    // Busqueda Where con multiples columnas
    public static function whereArray($array=[]) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ";
        foreach($array as $key => $value) {
            if($key === array_key_last($array)){

                $query .= "{$key} = '{$value}'";
            }else{

                $query .= "{$key} = '{$value}' AND ";
            }
        }
        // echo $query;
        
        $resultado = self::consultarSQL($query);
        return  $resultado ;
    }


     // traer un total de registros count
     public static function total( $columna='',$valor=''):string{
        $query = "SELECT COUNT(*) FROM " . static::$tabla;
        if($columna){
            $query .= " WHERE {$columna} = '{$valor}'";
        }
        $resultado = self::$db->query($query);
        $total= $resultado->fetch_array();
        return array_shift($total);
        
     }
    
 

    //  Total con un array where
    public static function totalArray( $array=[]){
        $query = "SELECT COUNT(*) FROM " . static::$tabla ."WHERE ";
        foreach($array as $key => $value) {
            if($key == array_key_last($array)){
                $query .= "{$key} = '{$value}'";
            }else{

                $query .= "  {$key} = '{$value}' AND ";
            }
        }
        $resultado = self::$db->query($query);
        $total= $resultado->fetch_array();
        return array_shift($total);
        
     }


       public static function topProductos($columna){
            // Cambiar la agrupación por 'nombre' en lugar de 'cantidad'
            $query = "SELECT nombre, SUM(cantidad) AS total FROM " . static::$tabla . " GROUP BY nombre ORDER BY total DESC LIMIT 10";
            $resultado = self::consultarSQL($query);
            return  $resultado ;
        }





    // crea un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        // debuguear($query); // Descomentar si no te funciona algo

        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
           'resultado' =>  $resultado,
           'id' => self::$db->insert_id
        ];
    }

//    // Procesar un archivo Excel-----------------------------------------------------------------------------------------------------------------------------------



// public static function procesarArchivoExcel($filePath)
// {
//     $spreadsheet = IOFactory::load($filePath);
//     $sheet = $spreadsheet->getActiveSheet();

//     // Crear la tabla si no existe
//     $queryCrearTabla = "
//         CREATE TABLE IF NOT EXISTS " . static::$tabla . " (
//             almacen VARCHAR(255),
//             nombre_cliente VARCHAR(255),
//             ruc_cliente VARCHAR(255),
//             numero_pedido VARCHAR(255),
//             fecha_pedido DATE,
//             vendedor VARCHAR(255),
//             plazo_entrega DATE,
//             estado_pedido VARCHAR(255),
//             codigo_producto VARCHAR(255),
//             nombre_producto VARCHAR(255),
//             cantidad INT,
//             pvp DECIMAL(10, 2),
//             subtotal DECIMAL(10, 2),
//             total DECIMAL(10, 2),
//             PRIMARY KEY (numero_pedido, codigo_producto)  -- Asegúrate de tener una clave primaria
//         )
//     ";

//     // Ejecutar la creación de la tabla
//     self::$db->query($queryCrearTabla);

//     // Insertar los datos de cada fila
//     foreach ($sheet->getRowIterator(2) as $row) {
//         $data = [];
//         $cellIterator = $row->getCellIterator();
//         $cellIterator->setIterateOnlyExistingCells(false);

//         foreach ($cellIterator as $cell) {
//             $data[] = $cell->getValue(); // No usamos trim aquí, lo haremos más abajo
//         }

//         // Mapear los datos a las columnas con verificación para null
//         list(
//             $almacen, $nombre_cliente, $ruc_cliente, $numero_pedido, $fecha_pedido,
//             $vendedor, $plazo_entrega, $estado_pedido, $codigo_producto, $nombre_producto,
//             $cantidad, $pvp, $subtotal, $total
//         ) = array_map(function ($value) {
//             return trim($value ?? '');  // Verifica si el valor es null y aplica trim
//         }, $data);

//         // Verificar si el registro ya existe
//         $queryVerificar = "
//             SELECT COUNT(*) as total 
//             FROM " . static::$tabla . " 
//             WHERE numero_pedido = '$numero_pedido' AND codigo_producto = '$codigo_producto'
//         ";
//         $resultado = self::$db->query($queryVerificar)->fetch_assoc();

//         if ($resultado['total'] > 0) {
//             // Actualizar el registro existente
//             $queryActualizar = "
//                 UPDATE " . static::$tabla . "
//                 SET 
//                     almacen = '$almacen',
//                     nombre_cliente = '$nombre_cliente',
//                     ruc_cliente = '$ruc_cliente',
//                     fecha_pedido = '$fecha_pedido',
//                     vendedor = '$vendedor',
//                     plazo_entrega = '$plazo_entrega',
                   
//                     nombre_producto = '$nombre_producto',
//                     cantidad = '$cantidad',
//                     pvp = '$pvp',
//                     subtotal = '$subtotal',
//                     total = '$total'
//                 WHERE numero_pedido = '$numero_pedido' AND codigo_producto = '$codigo_producto'
//             ";
//             self::$db->query($queryActualizar);
//         } else {
//             // Insertar un nuevo registro
//             $queryInsertar = "
//                 INSERT INTO " . static::$tabla . " (
//                     almacen, nombre_cliente, ruc_cliente, numero_pedido, fecha_pedido,
//                     vendedor, plazo_entrega, estado_pedido, codigo_producto, nombre_producto,
//                     cantidad, pvp, subtotal, total
//                 ) VALUES (
//                     '$almacen', '$nombre_cliente', '$ruc_cliente', '$numero_pedido', '$fecha_pedido',
//                     '$vendedor', '$plazo_entrega', '$estado_pedido', '$codigo_producto', '$nombre_producto',
//                     '$cantidad', '$pvp', '$subtotal', '$total'
//                 )
//             ";
//             self::$db->query($queryInsertar);
//         }
//     }

//     return true;
// }
public static function procesarArchivoExcel($filePath)
{
    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();

    // Crear la tabla si no existe
    $queryCrearTabla = "
        CREATE TABLE IF NOT EXISTS " . static::$tabla . " (
            almacen VARCHAR(255),
            nombre_cliente VARCHAR(255),
            ruc_cliente VARCHAR(255),
            numero_pedido VARCHAR(255),
            fecha_pedido DATE,
            vendedor VARCHAR(255),
            plazo_entrega DATE,
            estado_pedido VARCHAR(255),
            codigo_producto VARCHAR(255),
            nombre_producto VARCHAR(255),
            cantidad INT,
            pvp DECIMAL(10, 2),
            subtotal DECIMAL(10, 2),
            total DECIMAL(10, 2),
            PRIMARY KEY (numero_pedido, codigo_producto)  -- Asegúrate de tener una clave primaria
        )
    ";

    // Ejecutar la creación de la tabla
    self::$db->query($queryCrearTabla);

    // Insertar los datos de cada fila
    foreach ($sheet->getRowIterator(2) as $row) {
        $data = [];
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        foreach ($cellIterator as $cell) {
            $data[] = $cell->getValue(); // No usamos trim aquí, lo haremos más abajo
        }

        // Mapear los datos a las columnas con verificación para null
        list(
            $almacen, $nombre_cliente, $ruc_cliente, $numero_pedido, $fecha_pedido,
            $vendedor, $plazo_entrega, $estado_pedido, $codigo_producto, $nombre_producto,
            $cantidad, $pvp, $subtotal, $total
        ) = array_map(function ($value) {
            return trim($value ?? '');  // Verifica si el valor es null y aplica trim
        }, $data);

        // Comprobar si el nombre_producto comienza con alguno de los valores no deseados
        if (preg_match('/^(LM|CIRELES|CHRYSAL|Z|GUANTE)/', $nombre_producto)) {
            // Si coincide, se omite el registro
            continue;
        }

        // Verificar si el registro ya existe
        $queryVerificar = "
            SELECT COUNT(*) as total 
            FROM " . static::$tabla . " 
            WHERE numero_pedido = '$numero_pedido' AND codigo_producto = '$codigo_producto'
        ";
        $resultado = self::$db->query($queryVerificar)->fetch_assoc();

        if ($resultado['total'] > 0) {
            // Actualizar el registro existente
            $queryActualizar = "
                UPDATE " . static::$tabla . "
                SET 
                    almacen = '$almacen',
                    nombre_cliente = '$nombre_cliente',
                    ruc_cliente = '$ruc_cliente',
                    fecha_pedido = '$fecha_pedido',
                    vendedor = '$vendedor',
                    plazo_entrega = '$plazo_entrega',
                    nombre_producto = '$nombre_producto',
                    cantidad = '$cantidad',
                    pvp = '$pvp',
                    subtotal = '$subtotal',
                    total = '$total'
                WHERE numero_pedido = '$numero_pedido' AND codigo_producto = '$codigo_producto'
            ";
            self::$db->query($queryActualizar);
        } else {
            // Insertar un nuevo registro
            $queryInsertar = "
                INSERT INTO " . static::$tabla . " (
                    almacen, nombre_cliente, ruc_cliente, numero_pedido, fecha_pedido,
                    vendedor, plazo_entrega, estado_pedido, codigo_producto, nombre_producto,
                    cantidad, pvp, subtotal, total
                ) VALUES (
                    '$almacen', '$nombre_cliente', '$ruc_cliente', '$numero_pedido', '$fecha_pedido',
                    '$vendedor', '$plazo_entrega', '$estado_pedido', '$codigo_producto', '$nombre_producto',
                    '$cantidad', '$pvp', '$subtotal', '$total'
                )
            ";
            self::$db->query($queryInsertar);
        }
    }

    return true;
}


// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------


// public static function procesarArchivoExcelMateria($filePath)
// {
//     $spreadsheet = IOFactory::load($filePath);
//     $sheet = $spreadsheet->getActiveSheet();

//     // Crear la tabla si no existe
//     $queryCrearTabla = "
//         CREATE TABLE IF NOT EXISTS " . static::$tabla . " (
//             id INT AUTO_INCREMENT PRIMARY KEY,
//             almacen VARCHAR(255),
//             codigo VARCHAR(255) UNIQUE,
//             descripcion VARCHAR(500),
//             existencia INT,
//             costo DECIMAL(10, 2),
//             promedio DECIMAL(10, 2),
//             talla VARCHAR(255),
//             linea VARCHAR(255),
//             gramaje VARCHAR(255),
//             proveedor VARCHAR(255),
//             sustrato VARCHAR(255),
//             ancho VARCHAR(255)
//         )
//     ";

//     // Ejecutar la creación de la tabla
//     self::$db->query($queryCrearTabla);

//     // Procesar cada fila del Excel
//     foreach ($sheet->getRowIterator(2) as $row) {
//         $data = [];
//         $cellIterator = $row->getCellIterator();
//         $cellIterator->setIterateOnlyExistingCells(false);

//         foreach ($cellIterator as $cell) {
//             $data[] = $cell->getValue(); // Obtener el valor de la celda
//         }

//         // Mapear los datos a las columnas
//         list(
//             $almacen, $codigo, $descripcion, $nueva_existencia, $costo,
//             $promedio, $talla, $linea, $gramaje, $proveedor,
//             $sustrato, $ancho
//         ) = array_map(function ($value) {
//             return trim($value ?? '');  // Limpia los valores y reemplaza null con cadena vacía
//         }, $data);

//         // Normalizar el separador decimal
//         $costo = str_replace(',', '.', $costo);
//         $promedio = str_replace(',', '.', $promedio);

//         // Verificar si el registro ya existe
//         $queryVerificar = "
//             SELECT existencia 
//             FROM " . static::$tabla . " 
//             WHERE codigo = '$codigo'
//         ";
//         $resultado = self::$db->query($queryVerificar)->fetch_assoc();

//         if ($resultado) {
//             // Si existe el registro, calcular la diferencia
//             $existencia_actual = (int)$resultado['existencia'];
//             $nueva_existencia = (int)$nueva_existencia;

//             if ($nueva_existencia != $existencia_actual) {
//                 // Calcular la nueva existencia como la diferencia
//                 $diferencia = $nueva_existencia - $existencia_actual;

//                 // Actualizar la existencia en la base de datos
//                 $queryActualizar = "
//                     UPDATE " . static::$tabla . "
//                     SET 
//                         almacen = '$almacen',
//                         descripcion = '$descripcion',
//                         existencia = $diferencia, -- Actualizar con la diferencia
//                         costo = '$costo',
//                         promedio = '$promedio',
//                         talla = '$talla',
//                         linea = '$linea',
//                         gramaje = '$gramaje',
//                         proveedor = '$proveedor',
//                         sustrato = '$sustrato',
//                         ancho = '$ancho'
//                     WHERE codigo = '$codigo'
//                 ";
//                 self::$db->query($queryActualizar);
//             } else {
//                 // No hacer nada si la existencia es igual
//                 error_log("La existencia para el código $codigo no cambió.");
//             }
//         } else {
//             // Insertar un nuevo registro si no existe
//             $queryInsertar = "
//                 INSERT INTO " . static::$tabla . " (
//                     almacen, codigo, descripcion, existencia, costo,
//                     promedio, talla, linea, gramaje, proveedor,
//                     sustrato, ancho
//                 ) VALUES (
//                     '$almacen', '$codigo', '$descripcion', '$nueva_existencia', '$costo',
//                     '$promedio', '$talla', '$linea', '$gramaje', '$proveedor',
//                     '$sustrato', '$ancho'
//                 )
//             ";
//             self::$db->query($queryInsertar);
//         }
//     }

//     return true;
// }

public static function procesarArchivoExcelMateria($filePath)
{
    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();

    // Crear la tabla SIN restricciones de UNIQUE en 'codigo'
    $queryCrearTabla = "
        CREATE TABLE IF NOT EXISTS " . static::$tabla . " (
            id INT AUTO_INCREMENT PRIMARY KEY,
            almacen VARCHAR(255),
            codigo VARCHAR(255),
            descripcion VARCHAR(500),
            existencia INT,
            costo DECIMAL(10, 2),
            promedio DECIMAL(10, 2),
            talla VARCHAR(255),
            linea VARCHAR(255),
            gramaje VARCHAR(255),
            proveedor VARCHAR(255),
            sustrato VARCHAR(255),
            ancho VARCHAR(255),
            fecha_corte DATE DEFAULT CURRENT_DATE
        )
    ";
    self::$db->query($queryCrearTabla);

    // Procesar cada fila del Excel (desde la fila 2)
    foreach ($sheet->getRowIterator(2) as $row) {
        $data = [];
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        foreach ($cellIterator as $cell) {
            $data[] = trim((string)$cell->getFormattedValue());
        }

        // Validar al menos 12 columnas (sin fecha_corte)
        if (count($data) < 12) {
            continue;
        }

        // Mapear los datos (sin fecha_corte)
        list(
            $almacen, $codigo, $descripcion, $existencia, $costo,
            $promedio, $talla, $linea, $gramaje, $proveedor,
            $sustrato, $ancho
        ) = array_map(function ($value) {
            return trim($value ?? '');
        }, $data);

        // Convertir tipos
        $costo = floatval(str_replace(',', '.', $costo));
        $promedio = floatval(str_replace(',', '.', $promedio));
        $existencia = intval($existencia);

        // Insertar SIN fecha_corte (MySQL la pone automáticamente)
        $queryInsertar = "
            INSERT INTO " . static::$tabla . " (
                almacen, codigo, descripcion, existencia, costo,
                promedio, talla, linea, gramaje, proveedor,
                sustrato, ancho
            ) VALUES (
                '" . self::$db->real_escape_string($almacen) . "',
                '" . self::$db->real_escape_string($codigo) . "',
                '" . self::$db->real_escape_string($descripcion) . "',
                $existencia,
                $costo,
                $promedio,
                '" . self::$db->real_escape_string($talla) . "',
                '" . self::$db->real_escape_string($linea) . "',
                '" . self::$db->real_escape_string($gramaje) . "',
                '" . self::$db->real_escape_string($proveedor) . "',
                '" . self::$db->real_escape_string($sustrato) . "',
                '" . self::$db->real_escape_string($ancho) . "'
            )
        ";
        self::$db->query($queryInsertar);
    }

    return true;
}



// ----------------------------------------------------------------------------EXCEL COMERCIAL---------------------------------------------------------------------------
public static function procesarArchivoExcelComercial($filePath)
{
    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    
    // Crear la tabla si no existe
    $queryCrearTabla = "
        CREATE TABLE IF NOT EXISTS " . static::$tabla . " (
            id INT AUTO_INCREMENT PRIMARY KEY,
            import VARCHAR(255),
            proyecto VARCHAR(255),
            pedido_interno VARCHAR(255),
            fecha_solicitud DATE,
            trader VARCHAR(255),
            marca VARCHAR(255),
            linea VARCHAR(255),
            producto VARCHAR(500),
            gramaje VARCHAR(255),
            ancho VARCHAR(255),
            cantidad VARCHAR(255),
            precio VARCHAR(255),
            total_item VARCHAR(255),
            fecha_produccion DATE,
            ets DATE,
            eta DATE,
            arribo_planta DATE,
            transito INT,
            fecha_en_planta DATE,
            estado VARCHAR(255),
            UNIQUE KEY (import, proyecto, pedido_interno, fecha_solicitud, trader, marca, linea, producto, gramaje, ancho, cantidad, precio, total_item, fecha_produccion, ets, eta, arribo_planta, transito, fecha_en_planta, estado)
        )
    ";

    self::$db->query($queryCrearTabla);

    $highestRow = $sheet->getHighestRow();
    for ($row = 2; $row <= $highestRow; $row++) {
        $data = [];
        for ($col = 'A'; $col <= 'U'; $col++) {
            $data[] = trim($sheet->getCell($col . $row)->getFormattedValue() ?? '');
        }

        list(
            $import, $proyecto, $pedido_interno, $fecha_solicitud,
            $trader, $marca, $linea, $producto, $gramaje, $ancho, $cantidad,
            $precio, $total_item, $fecha_produccion, $ets, $eta,
            $arribo_planta, $transito, $fecha_en_planta, $estado
        ) = array_map(fn($value) => is_numeric(str_replace(',', '.', $value)) ? str_replace(',', '.', $value) : trim($value), $data);

        // Validación de fechas
        $fechas = ['fecha_solicitud', 'fecha_produccion', 'ets', 'eta', 'arribo_planta', 'fecha_en_planta'];
        foreach ($fechas as $fecha) {
            if (!empty($$fecha) && strtotime($$fecha) !== false) {
                $$fecha = date('Y-m-d', strtotime($$fecha));
            } else {
                $$fecha = null; // Evita insertar valores inválidos
            }
        }

        // Asegurar que `gms` y `ancho` sean numéricos
        $gramaje = is_numeric($gramaje) ? floatval($gramaje) : null;
        $ancho = is_numeric($ancho) ? floatval($ancho) : null;

        // **Verificar si el registro ya existe antes de insertarlo**
        $queryExistente = "
            SELECT id FROM " . static::$tabla . "
            WHERE import = '$import' 
            AND proyecto = '$proyecto'
            AND pedido_interno = '$pedido_interno'
            AND fecha_solicitud = '$fecha_solicitud'
            AND trader = '$trader'
            AND marca = '$marca'
            AND linea = '$linea'
            AND producto = '$producto'
            AND gramaje = '$gramaje'
            AND ancho = '$ancho'
            AND cantidad = '$cantidad'
            AND precio = '$precio'
            AND total_item = '$total_item'
            AND fecha_produccion = '$fecha_produccion'
            AND ets = '$ets'
            AND eta = '$eta'
            AND arribo_planta = '$arribo_planta'
            AND transito = '$transito'
            AND fecha_en_planta = '$fecha_en_planta'
            AND estado = '$estado'
        ";

        $resultado = self::$db->query($queryExistente);
        if ($resultado->num_rows == 0) {
            // Solo insertar si NO existe
            $queryInsertar = "
                INSERT INTO " . static::$tabla . " (
                    import, proyecto, pedido_interno, fecha_solicitud, trader, marca, linea, producto,
                    gramaje, ancho, cantidad, precio, total_item, fecha_produccion, ets, eta,
                    arribo_planta, transito, fecha_en_planta, estado
                ) VALUES (
                    '$import', '$proyecto', '$pedido_interno', '$fecha_solicitud', '$trader',
                    '$marca', '$linea', '$producto', '$gramaje', '$ancho', '$cantidad',
                    '$precio', '$total_item', '$fecha_produccion', '$ets', '$eta',
                    '$arribo_planta', '$transito', '$fecha_en_planta', '$estado'
                )
            ";
            self::$db->query($queryInsertar);
        }
    }

    return true;
}

// ---------------------------------------------------------- EXCEL PROYECCIONES -------------------------------------------------------------------------


public static function procesarArchivoExcelProyecciones($filePath)
{
    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();

    // Crear la tabla con los nuevos campos que se ven en la imagen
    $queryCrearTabla = "
        CREATE TABLE IF NOT EXISTS " . static::$tabla . " (
            id INT AUTO_INCREMENT PRIMARY KEY,
            fecha_consumo DATE,
            linea VARCHAR(255),
            producto VARCHAR(255),
            gms INT,
            ancho INT,
            cantidad DECIMAL(10,2)
        )
    ";
    self::$db->query($queryCrearTabla);

    // Procesar cada fila del Excel (desde la fila 2)
    foreach ($sheet->getRowIterator(2) as $row) {
        $data = [];
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        foreach ($cellIterator as $cell) {
            $data[] = trim((string)$cell->getFormattedValue());
        }

        // Validar al menos 6 columnas
        if (count($data) < 6) {
            continue;
        }

        // Mapear columnas
        list($fecha_consumo, $linea, $producto, $gms, $ancho, $cantidad) = array_map(function ($v) {
            return trim($v ?? '');
        }, $data);

        // Convertir valores numéricos
        $gms = intval($gms);
        $ancho = intval($ancho);
        $cantidad = floatval(str_replace(',', '.', $cantidad));

        // Insertar en la base de datos
        $queryInsertar = "
            INSERT INTO " . static::$tabla . " (
                fecha_consumo, linea, producto, gms, ancho, cantidad
            ) VALUES (
                '" . self::$db->real_escape_string($fecha_consumo) . "',
                '" . self::$db->real_escape_string($linea) . "',
                '" . self::$db->real_escape_string($producto) . "',
                $gms,
                $ancho,
                $cantidad
            )
        ";
        self::$db->query($queryInsertar);
    }

    return true;
}


    
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------




    // Actualizar el registro
    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un Registro por su ID
    public function eliminar() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function eliminarTabla() {
        $query = "DROP TABLE " . static::$tabla;
        $resultado = self::$db->query($query);
        return $resultado;
    }
    

     // Busqueda todos los registros que pertenecen a un id
     public static function belongsTo($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }




    // invetario de materia prima de sistemas 

    public static function allSis($id,$orden = 'DESC') {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id_{$id} {$orden}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function findSis($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id_producto= {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }



    public static function countinventario() {
        // Construye la consulta base sin filtro
        $query = "SELECT COUNT(*) as total FROM " . static::$tabla;
    
        // Ejecuta la consulta y obtiene el resultado
        $resultado = self::consultarSQL1($query);
    
        // Devuelve el total si existe en el resultado
        if (is_array($resultado) && isset($resultado[0]['total'])) {
            return (int) $resultado[0]['total'];
        }
    
        return 0;
    }


    public static function countTicketsAbiertos() {
        $query = "SELECT COUNT(*) as total FROM " . static::$tabla . " WHERE estado = 'abierto'";
        
        $resultado = self::consultarSQL1($query);
    
        if (is_array($resultado) && isset($resultado[0]['total'])) {
            return (int) $resultado[0]['total'];
        }
    
        return 0;
    }

    public static function countTicketsCerrados() {
        $query = "SELECT COUNT(*) as total FROM " . static::$tabla . " WHERE estado = 'cerrado'";
        
        $resultado = self::consultarSQL1($query);
    
        if (is_array($resultado) && isset($resultado[0]['total'])) {
            return (int) $resultado[0]['total'];
        }
    
        return 0;
    }
    
    
  
    



}