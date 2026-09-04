<?php

namespace App\Validation;

class CustomRules
{
    /**
     * Valida si un número de cédula ecuatoriana es válido.
     */
    public function validar_cedula(string $str): bool
    {
        $cedula = trim($str);

        // Debe tener exactamente 10 dígitos numéricos
        if (strlen($cedula) !== 10 || !ctype_digit($cedula)) {
            return false;
        }

        // Obtener código de provincia (dos primeros dígitos)
        $provincia = (int) substr($cedula, 0, 2);
        if (($provincia < 1 || $provincia > 24) && $provincia !== 30) {
            return false;
        }

        // El tercer dígito debe ser menor a 6 para personas naturales
        $tercerDigito = (int) $cedula[2];
        if ($tercerDigito >= 6) {
            return false;
        }

        // Algoritmo Módulo 10
        $coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2];
        $digitoVerificador = (int) $cedula[9];
        $suma = 0;

        for ($i = 0; $i < 9; $i++) {
            $valor = (int) $cedula[$i] * $coeficientes[$i];
            if ($valor >= 10) {
                $valor -= 9;
            }
            $suma += $valor;
        }

        // Cálculo del dígito esperado
        $decenaSuperior = (int) ceil($suma / 10) * 10;
        $digitoObtenido = $decenaSuperior - $suma;

        if ($digitoObtenido === 10) {
            $digitoObtenido = 0;
        }

        return $digitoObtenido === $digitoVerificador;
    }
}