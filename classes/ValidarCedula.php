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

    public static function validarRuc($ruc)
    {
        $ruc = trim($ruc);
        if (strlen($ruc) !== 13) {
            return false;
        }
    
        $provincia = substr($ruc, 0, 2);
        $tercerDigito = $ruc[2];
        $verificador = (int)$ruc[9]; // Modificado al índice correcto para el verificador
        $establecimiento = substr($ruc, 10, 3);
    
        // Validar el rango de provincia y el código de establecimiento
        if ($provincia < 1 || $provincia > 24 || $establecimiento < '001') {
            return false;
        }
    
        // Validación para personas naturales (tercer dígito entre 0-5)
        if ($tercerDigito >= 0 && $tercerDigito <= 5) {
            return self::validarCedula(substr($ruc, 0, 10));
        }
    
        // Validación para entidades públicas (tercer dígito igual a 6)
        elseif ($tercerDigito == 6) {
            $coeficientes = [3, 2, 7, 6, 5, 4, 3, 2];
            $suma = 0;
            for ($i = 0; $i < 8; $i++) {
                $suma += (int)$ruc[$i] * $coeficientes[$i];
            }
            $modulo = 11 - ($suma % 11);
            return ($modulo == $verificador || ($modulo == 11 && $verificador == 0));
        }
    
        // Validación para sociedades privadas (tercer dígito igual a 9)
        elseif ($tercerDigito == 9) {
            $coeficientes = [4, 3, 2, 7, 6, 5, 4, 3, 2];
            $suma = 0;
            for ($i = 0; $i < 9; $i++) {
                $suma += (int)$ruc[$i] * $coeficientes[$i];
            }
            $modulo = 11 - ($suma % 11);
            return ($modulo == $verificador || ($modulo == 11 && $verificador == 0));
        }
    
        return false;
    }
    

    
}