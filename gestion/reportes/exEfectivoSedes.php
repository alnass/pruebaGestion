<?php
// Activacion de almacenamiento en buffer 
ob_start();
// Inicio de sesion 
if (strlen(session_id()) < 1) {
  session_start();
}
if (!isset($_SESSION["usu_nombre"])) {
  
  echo "Debe ingresar al sistema correctamente ";

}else{
  // Validacion de permisos mediante variable de sesion 
  if ($_SESSION['recaudos']==1) {
?>


<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../public/css/exCierreParcial.css">
</head>
<body onload="window.print();">

<!-- Inicio de los datos de la empresa -->
<?php
// Se incluye la clase recaudos
require_once "../modelos/Consultas.php";

// Insatnciamieto de la clase con el objeto recaudos
$efectivosedes = new Consultas();
date_default_timezone_set("America/Bogota");
$hoy = date("Y-m-d");

// Obtener los valores de la consulta en Recaudo
$respuesta = $efectivosedes->efectivoensedes($hoy, $hoy);
// Recorrer todos los valores obtenidos 


?>
<!-- Fin de los datos de la empreasa -->

<!-- Inicio de la Zona de imprsion -->
  <div class="zona_impresion">
    <h1>Reporte de efectivo en cajas por sede</h1>
    <?php echo "Fecha de reporte: ".$hoy ?><br>
    <?php echo "Usuario : ".$_SESSION["usu_nombre"]." ".$_SESSION['usu_apellido']; ?>
    <br>
    <br>
    <table class="tblefectivo">
      <tr>
        <td class="efe_doc">Ciudad</td>
        <td class="efe_nombre">Sede</td>
        <td class="efe_doc">Registros</td>
        <td class="efe_doc">Efectivo</td>
      </tr>
      <?php 
        $total = 0;
        while ($reg = $respuesta->fetch_object()) {
          echo "<tr>";
            echo "<td>".$reg->ciu_nombre."</td>";
            echo "<td>".$reg->sed_nombre."</td>";
            echo "<td class='val_efe_reg'>".$reg->registros."</td>";
            echo "<td class='val_efe_valor'>$ ".number_format($reg->efectivo)."</td>";
          echo "</tr>";

          $total += $reg->efectivo;

        }
      ?>
      <tr>
        <td colspan="3" class="efe_total">
          <strong>
            TOTAL
          </strong>
        </td>
        <td class='val_efe_valor'>
          <strong>
            <?php echo "$ ".number_format($total); ?>
          </strong>
        </td>
      </tr>
    </table>
  </div>
<!-- Fin de la zona de impresion  -->


</body>
</html>
<?php
// Redireccionamiento a por validacion de permisos
  }else{
  
    echo "No cuenta con los permisos para generar este reporte";

  }
}
// luberar el espacio del bufer
ob_end_flush();
?>