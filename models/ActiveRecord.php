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

    // Obtener todos los Registros
    public static function all($orden = 'DESC') {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id {$orden}";
        $resultado = self::consultarSQL($query);
        return $resultado;
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





public static function procesarArchivoExcelMateria($filePath)
{
    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();

    // Crear la tabla si no existe
    $queryCrearTabla = "
        CREATE TABLE IF NOT EXISTS " . static::$tabla . " (
            id INT AUTO_INCREMENT PRIMARY KEY,
            almacen VARCHAR(255),
            codigo VARCHAR(255),
            descripcion VARCHAR(255),
            existencia INT,
            costo DECIMAL(10, 2),
            promedio DECIMAL(10, 2),
            talla VARCHAR(255),
            linea VARCHAR(255),
            gramaje VARCHAR(255),
            proveedor VARCHAR(255),
            sustrato VARCHAR(255),
            ancho DECIMAL(10, 2)
        )
    ";
    self::$db->query($queryCrearTabla);

    foreach ($sheet->getRowIterator(2) as $row) {
        $data = [];
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
    
        foreach ($cellIterator as $cell) {
            $data[] = $cell->getValue() ?? ''; // Captura valores nulos como cadenas vacías
        }

	 // Aquí imprimimos los datos para depurar
      	echo '<pre>';
      	print_r($data); // Esto mostrará los datos de cada fila del Excel
      	echo '</pre>';
  

        // Mapear los datos a las columnas y asegurar que siempre haya suficientes valores
        list(
            $almacen, $codigo, $descripcion, $existencia, $costo,
            $promedio, $talla, $linea, $gramaje, $proveedor,
            $sustrato, $ancho
        ) = array_pad(array_map(function ($value) {
            return trim($value ?? ''); // Captura valores nulos y elimina espacios
        }, $data), 12, null);
        
    
        // Validar descripción y asignar valor predeterminado si está vacía
        if (empty($descripcion)) {
            $descripcion = 'Sin descripción'; // Valor predeterminado si está vacío
        }
    
        if (empty($codigo)) {
            // Si no hay código, omitir la fila
            continue;
        }
    
        // Comprobar si el registro ya existe en la base de datos
        $queryVerificar = "
            SELECT COUNT(*) as total 
            FROM " . static::$tabla . " 
            WHERE codigo = ?
        ";
    
        $stmt = self::$db->prepare($queryVerificar);
        $stmt->bind_param('s', $codigo);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
    
        if ($resultado['total'] > 0) {
            // Actualizar el registro existente
            $queryActualizar = "
                UPDATE " . static::$tabla . "
                SET 
                    almacen = ?,
                    descripcion = ?,
                    existencia = ?,
                    costo = ?,
                    promedio = ?,
                    talla = ?,
                    linea = ?,
                    gramaje = ?,
                    proveedor = ?,
                    sustrato = ?,
                    ancho = ?
                WHERE codigo = ?
            ";
    
            $stmt = self::$db->prepare($queryActualizar);
            $stmt->bind_param(
                'ssiddssssssd',
                $almacen, $descripcion, $existencia, $costo, $promedio,
                $talla, $linea, $gramaje, $proveedor, $sustrato, $ancho,
                $codigo
            );
            $stmt->execute();
        } else {
            // Insertar un nuevo registro
            $queryInsertar = "
                INSERT INTO " . static::$tabla . " (
                    almacen, codigo, descripcion, existencia, costo,
                    promedio, talla, linea, gramaje, proveedor,
                    sustrato, ancho
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ";
    
            $stmt = self::$db->prepare($queryInsertar);
            $stmt->bind_param(
                'ssiddssssssd',
                $almacen, $codigo, $descripcion, $existencia, $costo, $promedio,
                $talla, $linea, $gramaje, $proveedor, $sustrato, $ancho
            );
            $stmt->execute();
        }
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

     // Busqueda todos los registros que pertenecen a un id
     public static function belongsTo($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }






}