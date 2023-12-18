<?php
function validarDNI($dni) {
    $dni = strtoupper(trim($dni));

    if (strlen($dni) !== 9) {
        return "Faltan caracteres en el DNI";
    }

    $numeros = substr($dni, 0, 8);
    $letra = substr($dni, 8, 1);

    if (!ctype_digit($numeros)) {
        return "Error en la introducción de caracteres";
    }

    $letrasValidas = "TRWAGMYFPDXBNJZSQVHLCKE";
    $indice = $numeros % 23;
    $letraCalculada = $letrasValidas[$indice];

    if ($letra === $letraCalculada) {
        return "El DNI $dni es válido.";
    } else {
        return "Debes introducir una letra al final de tu DNI";
    }
}

if (isset($_GET['numeroDNI'])) {
    $numeroDNI = $_GET['numeroDNI'];
    $resultado = validarDNI($numeroDNI);
    echo $resultado;
} else {
    echo "Por favor, ingrese un número de DNI como parámetro en la URL (ejemplo: ?numeroDNI=12345678A).";
}
?>
