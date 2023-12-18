<?php
if ($tengo_datos == true) {
    echo "Has elegido convertir de $moneda_origen a $moneda_destino<br>";
    echo "La cantidad en $moneda_origen es: $amount_in_moneda_origen<br>";

    // Verificar que la cantidad no sea 0
    if ($amount_in_moneda_origen == 0) {
        echo "Error: La cantidad a convertir debe ser mayor que 0.";
    } else {
        // Calcular la cantidad convertida
        if ($moneda_origen == "EUR") {
            // Si la moneda de origen es EUR, simplemente multiplica por el tipo de cambio de la moneda de destino
            $converted_amount = $amount_in_moneda_origen * $mi_cambio[$moneda_destino];
        } else {
            // Si la moneda de origen no es EUR, realiza la conversión normal
            $converted_amount = $amount_in_moneda_origen / $mi_cambio[$moneda_origen] * $mi_cambio[$moneda_destino];
        }

        echo "El equivalente en $moneda_destino es: " . number_format($converted_amount, 2) . "<br>";
    }
}
?>
