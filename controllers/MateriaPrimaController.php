<?php


namespace Controllers;

use MVC\Router;
use Model\MateriaPrima;




class MateriaPrimaController
{
   public static function materia(Router $router)
   {
      $alertas = [];
      $materiaprima = new MateriaPrima;

      if($_SERVER['REQUEST_METHOD'] === 'POST') {
         $materiaprima->sincronizar($_POST);
         $alertas = $materiaprima->validar();
         // // generar codigo de barras md5
         // $materiaprima->barcode = md5();
         // // generar codigo de barras sha1
         // $materiaprima->barcode = sha1($materiaprima->barcode);
         // // generar codigo de barras sha256
         $materiaprima->barcode = hash('sha256', $materiaprima->barcode);
         // Paso 1: Generar el código de barras EAN-13
$prefijoGS1 = '786'; // Ecuador
$codigoEmpresa = '12345'; // Código asignado por GS1
$codigoProducto = '67890'; // Código interno para el producto

// Calcular el dígito de control
function calcularDigitoControl($codigoSinControl) {
    $sumaImpares = 0;
    $sumaPares = 0;

    for ($i = 0; $i < strlen($codigoSinControl); $i++) {
        $digito = (int) $codigoSinControl[$i];
        if (($i + 1) % 2 == 0) { // Índices pares
            $sumaPares += $digito;
        } else { // Índices impares
            $sumaImpares += $digito;
        }
    }

    $total = $sumaImpares + ($sumaPares * 3);
    $digitoControl = (10 - ($total % 10)) % 10; // Asegura que sea 0 si es divisible
    return $digitoControl;
}

// Concatenar y calcular el dígito de control
$codigoSinControl = $prefijoGS1 . $codigoEmpresa . $codigoProducto;
$digitoControl = calcularDigitoControl($codigoSinControl);

// Código EAN-13 completo
$codigoEAN13 = $codigoSinControl . $digitoControl;

// Paso 2: Generar el hash SHA-256
$materiaprima = new MateriaPrima(); // Simulando una instancia de materia prima
$materiaprima->barcode = $codigoEAN13; // Asignar el código generado
$hashedBarcode = hash('sha256', $materiaprima->barcode);

// Mostrar resultados
echo "Código EAN-13: $codigoEAN13\n";
echo "Hash SHA-256: $hashedBarcode\n";

         
         debuguear($materiaprima);
            

      }

      $router->render('admin/produccion/materia/crear' , [
         'titulo' => 'MEGASTOCK-MATERIA PRIMA',
         'alertas' => $alertas
      ]);
   }
}