<?php
// maintenance effectuee par Anderson Ferrucho
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

<?php 

date_default_timezone_set("America/Bogota");
// $hoy = date("2018-11-07");
$hoy = date("Y-m-d H:i:s");
$fecha_reporte = date("Y-m-d");
$fecha_inicio  = date("Y-m-01");
//$fecha_reporte = date("2018-11-09");

$nombre = $_SESSION['usu_nombre']." ".$_SESSION['usu_apellido'];
// Inclusion de la clase 
require_once "../modelos/Cierres.php";

// Instanciamiento de la clase con el objeto
$cierres = new Cierres();

// Obtener los valores de la consulta
$respuesta 	= 	$cierres->efectivoMes($fecha_inicio, $fecha_reporte);
$repons 	= 	$cierres->corporativosMes($fecha_inicio, $fecha_reporte);// maintenance
// Recorrer los valores de la consulta 


$sederpta = $cierres->sede();
$sede = $sederpta->fetch_object();

?>

<div class="zona_impresion">
	<br>
	<?php 
		echo "<h1>".$_GET['cierre'] ."</h1>";		
	?>
	<!-- <h1>Cierre parcial de caja </h1> -->
	<?php echo "Fecha y hora de impresion del reporte: ".$hoy; ?><br>
	<!-- <?php //echo "Fecha de reporte: ".$fecha_reporte; ?><br> -->
	<?php echo "Usuario: ".$nombre; ?><br>
	<?php echo "Sede: ".$sede->sed_nombre; ?><br>
	<h3>Recaudo de efectivo</h3>

	<!-- Inicio de la tabla efectivo -->
	<table  class="tblefectivo">
	
		<tr>
			<td class="efe_reg">Reg</td>
			<td class="efe_nombre">Nombre del suscriptor</td>
			<td class="efe_doc">No Documento</td>
			<td class="efe_valor">Valor</td>
		</tr>

		<?php 
			$totalefectivo = 0;
			if($respuesta->num_rows > 0)
			{
				while ($reg = $respuesta->fetch_object()) 
				{
					echo "<tr>"; 
						echo "<td class='val_efe_reg'>".$reg->est_cta_no_transaccion."</td>";
						echo "<td class='val_efe_nombre'>".$reg->per_nombre." ".$reg->per_apellido."</td>";
						echo "<td class='efe_doc_val'>".number_format($reg->per_num_documento) ."</td>";
						echo "<td class='val_efe_valor'> $ ".number_format($reg->est_cta_debe) ."</td>";
					echo "</tr>";
					$totalefectivo += $reg->est_cta_debe;
				}
			}
			// début maintenance
			// if($repons->num_rows > 0)
			// {
			// echo '<tr>
			// 		<td colspan="3" class="efe_total">
			// 		 	<strong>TOTAL RECAUDO SEDE</strong>	
			// 		</td>
			// 		<td class="efe_total_valor">
			// 			<strong>$ ' .number_format($totalefectivo).'</strong>	
			// 		</td>
			// 	</tr>';
			// 	echo '<tr>
			// 			<td colspan="3" >
			// 			 	<strong>RECAUDO CORPORATIVOS</strong>	
			// 			</td>
			// 		</tr>';
			// 	while ($reg_corp = $repons->fetch_object()) {
			// 		echo "<tr>"; 
			// 			echo "<td class='val_efe_reg'>".$reg_corp->est_cta_no_transaccion."</td>";
			// 			echo "<td class='val_efe_nombre'>".$reg_corp->per_nombre." ".$reg_corp->per_apellido."</td>";
			// 			echo "<td class='efe_doc_val'>".number_format($reg_corp->per_num_documento) ."</td>";
			// 			echo "<td class='val_efe_valor'> $ ".number_format($reg_corp->est_cta_debe) ."</td>";
			// 		echo "</tr>";
			// 		if(!empty($totalCorporativo))
			// 		{
			// 			$totalCorporativo += $reg_corp->est_cta_debe;	
			// 		}
			// 		$totalefectivo += $reg_corp->est_cta_debe;
			// 	}
			// 	echo '<tr>
			// 			<td colspan="3" class="efe_total">
			// 			 	<strong>TOTAL RECAUDO CORPORATIVOS SEDE</strong>	
			// 			</td>
			// 			<td class="efe_total_valor">
			// 				<strong>$ '.number_format($totalCorporativo).'</strong>	
			// 			</td>
			// 		</tr>';
			// }
			// fin maintenance

		?>
		<tr>
			<td colspan="3" class="efe_total">
			 	<strong>TOTAL GENERAL</strong>	
			</td>
			<td class="efe_total_valor">
				<strong><?php echo "$ ".number_format($totalefectivo); ?></strong>	
			</td>
		</tr>
	</table>
	<!-- Fin de la tabla efectivo -->

	<!-- Inicio de la tabla notas credito -->
	<h3>Notas credito o descuentos</h3>
	<table class="tbldescuento">
		<tr>
			<td class="dcto_reg">Reg</td>
			<td class="dcto_nombre">Nombre del suscriptor</td>
			<td class="dcto_doc">No Documento</td>
			<td class="dcto_concepto">Concepto</td>
			<td class="dcto_valor">Valor</td>
		</tr>
		<?php 

		$respdcto = $cierres->descuentoshoy($fecha_reporte);
		$totaldcto = 0;
		while ($dcto = $respdcto->fetch_object()) {
			echo "<tr>";
				echo "<td class='dcto_reg_val'>".$dcto->est_cta_no_transaccion."</td>";
				echo "<td class='dcto_nombre_val'>".$dcto->per_nombre." ".$dcto->per_apellido."</td>";
				echo "<td class='dcto_doc_val'>".number_format($dcto->per_num_documento) ."</td>";
				echo "<td class='dcto_concepto_val'>".$dcto->con_tran_nombre."</td>";
				echo "<td class='dcto_valor_val'>$ ".number_format($dcto->est_cta_debe)."</td>";
			echo "</tr>";
			$totaldcto += $dcto->est_cta_debe;
		}

		?>

		<tr>
			<td colspan="4" class="dcto_total">
				<strong>TOTAL</strong>
			</td>
			<td class="dcto_total_val">
				<strong>
					<?php echo "$ ".number_format($totaldcto); ?>
				</strong>
			</td>
		</tr>
	</table>
	<!-- Fin de la tabla notas credito -->

	<!-- Inicio de la tabla de Bancos  -->
	<h3>Transacciones bancarias y digitales</h3>
	<table class="tblbancos">
		<tr>
			<td class="banco_reg">Reg</td>
			<td class="banco_nombre">Nombre del suscriptor</td>
			<td class="dcto_doc">No Documento</td>
			<td class="banco_concepto">Concepto</td>
			<td class="banco_valor">Valor</td>
		</tr>
		<?php 

		$respbanco = $cierres->corporativosMes($fecha_inicio, $fecha_reporte);
		$totalbanco = 0;
		while ($banco = $respbanco->fetch_object()) {
			echo "<tr>";
				echo "<td class='banco_reg_val'>".$banco->est_cta_no_transaccion."</td>";
				echo "<td class='banco_nombre_val'>".$banco->per_nombre." ".$banco->per_apellido."</td>";
				echo "<td class='dcto_doc_val'>".number_format($banco->per_num_documento) ."</td>";
				echo "<td class='banco_concepto_val'>".$banco->con_tran_nombre."</td>";
				echo "<td class='banco_valor_val'>$ ".number_format($banco->est_cta_debe)."</td>";
			echo "</tr>";
			$totalbanco += $banco->est_cta_debe;
		}

		?>

		<tr>
			<td colspan="4" class="banco_total">
				<strong>TOTAL</strong>
			</td>
			<td class="banco_total_val">
				<strong>
					<?php echo "$ ".number_format($totalbanco); ?>
				</strong>
			</td>
		</tr>
	</table>
	<!-- Fin de la tabla Bancos -->
</div>

<?php
// Redireccionamiento a por validacion de permisos
  }else{
  
    echo "No cuenta con los permisos para generar este reporte";

  }
}
// luberar el espacio del bufer
ob_end_flush();
?>