<!DOCTYPE html>
<html>
<head>
<style>
  table {
    width: 100%;
    height: 100vh;
  }

  td {
    width: 33.33%;
    height: 33.33%;
    text-align: center;
    vertical-align: middle;
  }
</style>
</head>
<body>
  <table>
    <tr>
      <td></td>
	 <td style="background-color: #FF0000; width: 20%; height: 20%;">
        <?php
        $op1 = $_GET['op1'];
        $op2 = $_GET['op2'];
        $operacion = $_GET['operacion'];

        if (!is_numeric($op1) || !is_numeric($op2)) {
          echo "Introduce valores numéricos en op1 y op2, y la operación debe ser suma, resta, multiplicación o división.";
       
 } else
 {

          if ($operacion == "suma") {
            $resultado = $op1 + $op2;
          } elseif ($operacion == "resta") {
            $resultado = $op1 - $op2;
          } elseif ($operacion == "multiplicacion") {
            $resultado = $op1 * $op2;
          } elseif ($operacion == "division") {
            $resultado = $op1 / $op2;
          } else {
            echo "Introduce solo suma, resta, multiplicación o división como operación.";
          }

          echo "Operación: $operacion<br>";
          echo "Resultado: $resultado";
        }
        ?>
      </td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </table>
</body>
</html>
