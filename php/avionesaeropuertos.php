<?php
// Funcion para buscar informacion en el archivo CSV
function buscarInformacion($archivo, $codigo) {
    if (($handle = fopen($archivo, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($data[0] == $codigo) {
                fclose($handle);
                return $data[1]; // Devuelve el valor correspondiente
            }
        }
        fclose($handle);
    }
    return "No se encontro informacion para el codigo $codigo"; // Mensaje de error si no se encuentra el codigo
}

// Verificar si se proporciono un codigo de compania aerea
if (isset($_GET['compania'])) {
    $codigoCompania = $_GET['compania'];
    $compania = buscarInformacion('companias.csv', $codigoCompania);
    echo "Compania Aerea: $compania";
}

// Verificar si se proporciono un codigo de aeropuerto
if (isset($_GET['aeropuerto'])) {
    $codigoAeropuerto = $_GET['aeropuerto'];
    $aeropuerto = buscarInformacion('aeropuertos.csv', $codigoAeropuerto);
    echo "Aeropuerto: $aeropuerto";
}
?>
