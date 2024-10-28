<?php

namespace Classes;

class ValidarCedula
{
    public static function validarCedula($cedula)
    {
        $cedula = trim($cedula);
        $tamano = strlen($cedula);
        if ($tamano == 10) {
            $coeficientes = array(2, 1, 2, 1, 2, 1, 2, 1, 2);
            $verificador = $cedula[9];
            $suma = 0;
            for ($i = 0; $i < 9; $i++) {
                $valor = $cedula[$i] * $coeficientes[$i];
                if ($valor >= 10) {
                    $valor -= 9;
                }
                $suma += $valor;
            }
            $suma = $suma % 10;
            if ($suma == 0) {
                $digito = 0;
            } else {
                $digito = 10 - $suma;
            }
            if ($digito == $verificador) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    
}