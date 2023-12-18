<?php
function validarDNI($dni) {
    // Eliminar espacios en blanco y convertir a mayúsculas
    $dni = strtoupper(trim($dni));

    // Comprobar la longitud
    if (strlen($dni) !== 9) {
        return false;
    }

    // Verificar que los  8 caracteres sean números
    if (!ctype_digit($numeros)) {
        return false;
    }

    // Calcular la letra correspondiente a los números
    $letrasValidas = "TRWAGMYFPDXBNJZSQVHLCKE";
    $indice = $numeros % 23;
    $letraCalculada = $letrasValidas[$indice];

    // Comparar la letra calculada con la letra del DNI
    if ($letra === $letraCalculada) {
        return true;
    } else {
        return false;
    }
}

// Validar el DNI
$numeroDNI = "12345678A";
if (validarDNI($numeroDNI)) {
    echo "El DNI es válido.";
} else {
    echo "El DNI no es válido.";
}
?>
