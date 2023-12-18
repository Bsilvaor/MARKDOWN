<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentacars Mallorca</title>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentacars Mallorca</title>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentacars Mallorca</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #F7F7F4;
        }
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #dddddd;
            font-weight: bold;
            text-align: center;
            padding: 12px;
            cursor: pointer;
            border-radius: 8px;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            padding: 20px;
            
            
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: x-large;
        }

        label.municipio {
            font-size: 1.2em; /* Ajusta el tamaño de fuente según tus preferencias */
            color: #333333; /* Cambia al color deseado */
        }

        label.codigo-postal, label.nombre {
            font-size: 1.2em; /* Ajusta el tamaño de fuente según tus preferencias */
            color: #333333; /* Cambia al color deseado */
        }

        input, select, button {
            margin-bottom: 16px;
            padding: 10px;
            box-sizing: border-box;
            
        }
        select {
            width: 10%;
            font-weight: bold;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 20%;
        }
        button:hover {
            background-color: #2980b9;
        }
        .municipio-container {
        
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
         margin-bottom: 10px;
        display: flex;
        flex-wrap: wrap;
        }
        .municipio {
        display: flex;
        align-items: center;
        margin-right: 20px;
        margin-bottom: 0.1cm;
        }
        .municipio input {
            margin-right: 5px;
        }
        h1, h2, h3 {
            color: #333333;
        }

        th.sortable:hover {
            background-color: #555;
            color: white;
            cursor: pointer;
        }
    </style>
    <script>

        //FUSILAMIENTO SIN COMPASIÓN

        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("rentacarTable");
            switching = true;
            // Set the sorting direction to ascending:
            dir = "asc";
            /* Make a loop that will continue until
            no switching has been done: */
            while (switching) {
                // Start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /* Loop through all table rows (except the
                first, which contains table headers): */
                for (i = 1; i < (rows.length - 1); i++) {
                    // Start by saying there should be no switching:
                    shouldSwitch = false;
                    /* Get the two elements you want to compare,
                    one from current row and one from the next: */
                    x = rows[i].getElementsByTagName("td")[n];
                    y = rows[i + 1].getElementsByTagName("td")[n];
                    /* Check if the two rows should switch place,
                    based on the direction, asc or desc: */
                    if (n === 4) { // Column index for "Número de vehículos"
                        let xNum = parseInt(x.innerHTML);
                        let yNum = parseInt(y.innerHTML);
                        if (dir == "asc" ? (xNum > yNum) : (xNum < yNum)) {
                            shouldSwitch = true;
                            break;
                        }
                    } else {
                        if (dir == "asc" ? (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) : (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase())) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /* If a switch has been marked, make the switch
                    and mark that a switch has been done: */
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    // Each time a switch is done, increase this count by 1:
                    switchcount++;
                } else {
                    /* If no switching has been done AND the direction is "asc",
                    set the direction to "desc" and run the while loop again. */
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }

        //NO HAN QUEDADO SUPERVIVIENTES

    </script>
</head>
<body>

<?php
// Función para obtener datos del XML
function obtenerDatosRentacars($url) {
    $xml = simplexml_load_file($url);

    $datosRentacars = [];

    foreach ($xml->rows->row as $row) {
        $datosRentacars[] = [
            'signatura' => (string)$row->signatura,
            'denominacion_comercial' => (string)$row->denominaci_comercial,
            'municipio' => (string)$row->municipi,
            'direccion' => (string)$row->adre_a_de_l_establiment,
            'codigo_postal' => obtenerCodigoPostal($row->adre_a_de_l_establiment),
            'numero_vehiculos' => (int)$row->nombre_de_vehicles,
            'nombre_explotador' => (string)$row->nom_explotador_s,
            'nif_explotador' => (string)$row->nif_cif_explotador_s,
        ];
    }

    return $datosRentacars;
}

// Función para obtener código postal desde la dirección
function obtenerCodigoPostal($direccion) {
    if (preg_match('/\b(\d{5})\b/', $direccion, $matches)) {
        return $matches[1];
    }
    return '';
}

// Obtener datos del XML
//Definimos las 3 variables $url y $rentacars para extraer los datos de la url.
$url = "https://catalegdades.caib.cat/resource/rjfm-vxun.xml";
$rentacars = obtenerDatosRentacars($url);

// Filtrar datos según los parámetros de búsqueda
$filtro_municipio = isset($_GET['municipio']) ? $_GET['municipio'] : '';
$filtro_codigo_postal = isset($_GET['codigo_postal']) ? $_GET['codigo_postal'] : '';
$filtro_nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';

//creamos la array vacía y empezamos el follón.
$rentacars_filtrados = [];

//Usamos un bucle para que busque en cada empresa de la variable $rentacars
foreach ($rentacars as $rentacar) {
    // Filtrar por municipio, el && para recordar sirve para que si los 2 valores
    //son verdaderos devuelve TRUE sino FALSE
    //!-- es un comparador de manera estricta de desigualdad.

    if ($filtro_municipio && $rentacar['municipio'] !== $filtro_municipio) {
        continue;
    }

    // Filtrar por código postal
    if ($filtro_codigo_postal && $rentacar['codigo_postal'] !== $filtro_codigo_postal) {
        continue;
    }

    // Filtrar por nombre
    if ($filtro_nombre &&
    
    /* stripos lo utilizamos para que busque en una subcadena de las cadenas denominacio comercial
    no distingue entre mayusculas y minusculas.

    al estar !==false y ser como una "contradicción"  la expresión !==, de manera que la condicion 
    se cumple si la subcadena no está presente.
    */
        !(stripos($rentacar['denominacion_comercial'], $filtro_nombre) !== false ||
          stripos($rentacar['nombre_explotador'], $filtro_nombre) !== false)) {
        continue;
    }

    $rentacars_filtrados[] = $rentacar;
}

// Mostrar formulario de búsqueda
echo '<form method="get">';
echo '<div class="municipio-container">';
echo '<label>Municipio:</label>';
foreach (array_unique(array_column($rentacars, 'municipio')) as $municipio) {
    echo '<label class="municipio">';
    echo '<input type="radio" name="municipio" value="' . $municipio . '"';
    if ($filtro_municipio === $municipio) {
        echo ' checked';
    }
    echo '> ' . $municipio . '<span>&nbsp;</span>';
    echo '</label>';
}
echo '</div>';

echo '<label>Código Postal:</label>';
echo '<select name="codigo_postal">';
echo '<option value="">Todos los códigos postales</option>';
foreach (array_unique(array_column($rentacars, 'codigo_postal')) as $codigo_postal) {
    echo '<option value="' . $codigo_postal . '"';
    if ($filtro_codigo_postal === $codigo_postal) {
        echo ' selected';
    }
    echo '>' . $codigo_postal . '</option>';
}
echo '</select><br>';

echo '<label>Nombre:</label>';
echo '<input type="text" name="nombre" value="' . htmlspecialchars($filtro_nombre) . '"><br>';

echo '<button type="submit">Buscar</button>';
echo '<button type="reset" onclick="location.href=\'?\'">Resetear</button>';
echo '</form>';

// Mostrar resultados en una tabla
//He añadido la parte de onclick="sortTable... lo que hace que se ensombrezca
//al pasar el cursor por encima.
echo '<table id="rentacarTable">';
echo '<tr>';
echo '<th class="sortable" onclick="sortTable(0)">Licencia de rentacar</th>';
echo '<th class="sortable" onclick="sortTable(1)">Nombre comercial</th>';
echo '<th class="sortable" onclick="sortTable(2)">Municipio</th>';
echo '<th class="sortable" onclick="sortTable(3)">Dirección completa</th>';
echo '<th class="sortable" onclick="sortTable(4)">Número de vehículos</th>';
echo '<th class="sortable" onclick="sortTable(5)">Explotador</th>';
echo '</tr>';

foreach ($rentacars_filtrados as $rentacar) {
    echo '<tr>';
    echo '<td>' . $rentacar['signatura'] . '</td>';
    echo '<td>' . $rentacar['denominacion_comercial'] . '</td>';
    echo '<td>' . $rentacar['municipio'] . '</td>';
    echo '<td>' . $rentacar['direccion'] . '</td>';
    echo '<td>' . $rentacar['numero_vehiculos'] . '</td>';
    echo '<td>' . $rentacar['nombre_explotador'] . ' (' . $rentacar['nif_explotador'] . ')</td>';
    echo '</tr>';
}

echo '</table>';
$totalVehiculos = 0;

foreach ($rentacars_filtrados as $rentacar) {
    $totalVehiculos += $rentacar['numero_vehiculos'];
}

echo '<p>Total de vehículos: ' . $totalVehiculos . '</p>';
?>
</body>
</html>
