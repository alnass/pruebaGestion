<?php 
session_start();
// # encoded by @Francisco Monsalve
// maintenance effectuee par Anderson Ferrucho
require "../modelos/Cierres.php";

$cierres = new Cierres();

$usu_id = $_SESSION['usu_id'];
$sede = $_SESSION['usu_sede_id'];
$cie_fin_observacion = "";
$saldoDia = "";
$saldoGeneral="";

switch ($_GET["op"]) {
	case 'guardar':
		$respuesta = $cierres->insertarcierreparcial($usu_id);
		break;
	
	case 'insertarcierrefinal':
		date_default_timezone_set("America/Bogota");
		$hoy = date("Y-m-d H:m:s");
		$respuesta = $cierres->insertarcierrefinal($usu_id, $hoy, $sede, $cie_fin_observacion);
		//Limpiar las variables de sesion
		break;
	case 'correoInformeDiario':

		// $fecha = date('Y-m-d');
		$fecha = date('2019-05-23');
		$nombreSede = $cierres->nombreSede($sede);

		require "../modelos/CuadreCaja.php";
		$cuadreCaja = new CuadreCaja();

		$efectivoDiaSede		= 	$cuadreCaja->efectivoDiaSede($fecha, $fecha, $sede);//maintenance
		$efectivoDia 			= 	$cuadreCaja->efectivoDia($fecha, $fecha, $sede);
		$efectivoDiaConsgncion	= 	$cuadreCaja->consignacionDiaSede($fecha, $fecha, $sede);
		$efectivoCorporativo	= 	$cuadreCaja->efectivoCorporativo($fecha, $fecha, $sede);//maintenance
		$efectivoMes 			= 	$cuadreCaja->recaudoMes($sede);
		$efectivoMesCorp		= 	$cuadreCaja->recaudoMesCorp($sede);
		$consignacionMesMsv		= 	$cuadreCaja->recaudoMesConsigMsv($sede);
		$consignacionMesCorp	= 	$cuadreCaja->recaudoMesConsigCorp($sede);
		$consignacionDia		= 	$cuadreCaja->consignacionDia($fecha, $fecha, $sede);
		$totalSalidasDia 		= 	$cuadreCaja->totalSalidasDia($fecha, $fecha, $sede);
		$saldoDia 				= 	$efectivoDia['efectivo']-$totalSalidasDia['totalDia'];
		$totalConsignacion 		= 	$consignacionDia['consignacion'];
		$totalGeneralIngreso 	= 	$cuadreCaja->totalGeneralIngreso($sede);
		$totalGeneralSalida 	= 	$cuadreCaja->totalGeneralSalida($sede);
		$saldoGeneral 			= 	$totalGeneralIngreso['efectivoGeneral'] - $totalGeneralSalida['salidaGeneral'];
		$totalRecogida 			= 	$cuadreCaja->totalRecogida($fecha, $fecha, $sede);
		$otrasSalidas 			=	$cuadreCaja->otrasSalidas($fecha, $fecha, $sede);
		$saldoAnterior 			= 	$saldoGeneral - $saldoDia;
		$totalEfectivo 			= 	$efectivoDia['efectivo'] + $saldoAnterior;

		echo "<h3>Inforación general del cierre</h3>";
		echo "<table width='200px'>
			<tbody>
				<tr style='border-bottom: solid gray 1px;'>
					<td><strong>Efectivo del mes clientes masivos:</td>
					<td style='text-align:right;'>$".number_format($efectivoMes['efectivoMes'])."</strong></td>
				</tr>
				<tr style='border-bottom: solid gray 1px;'>
					<td><strong>Efectivo del mes clientes corporativos:</td>
					<td style='text-align:right;'>$".number_format($efectivoMesCorp['efectivoMes'])."</strong></td>
				</tr>
				<tr style='border-bottom: solid gray 1px;'>
					<td><strong>Recaudo consignaciones del día Sede:</td>
					<td style='text-align:right;'>$".number_format($efectivoDiaConsgncion['efectivo'])."</strong></td>
				</tr>
				<tr style='border-bottom: solid gray 1px;'>
					<td><strong>Consignaciones mes masivos:</td>
					<td style='text-align:right;'>$".number_format($consignacionMesMsv['consignacionMes'])."</strong></td>
				</tr>
				<tr style='border-bottom: solid gray 1px;'>
					<td><strong>Consignaciones mes corporativo:</td>
					<td style='text-align:right;'>$".number_format($consignacionMesCorp['consignacionMes'])."</strong></td>
				</tr>
				<tr>
					<td>Recaudo del día Sede:</td>
					<td style='text-align:right;'>$".number_format($efectivoDiaSede['efectivo'])."</td>
				</tr>
				<tr>
					<td>Recaudo Corporativo:</td>
					<td style='text-align:right;'>$".number_format($efectivoCorporativo['efectivo'])."</td>
				</tr>
				<tr>
					<td>Saldo anterior:</td>
					<td style='text-align:right;'>$".number_format($saldoAnterior)."</td>
				</tr>
				<tr  style='border-bottom: solid gray 1px;'>
					<td><strong>Total efectivo:</td>
					<td style='text-align:right;'>$".number_format($totalEfectivo)."</strong></td>
				</tr>
				<tr>
					<td>Total Consignaciones:</td>
					<td style='text-align:right;'>$".number_format($consignacionDia['consignacion'])."</td>
				</tr>
				<tr>
					<td>Dinero Consignado:</td>
					<td style='text-align:right;'>$".number_format($totalRecogida['recogidaTotal'])."</td>
				</tr>
				<tr>
					<td>Otras salidas:</td>
					<td style='text-align:right;'>$".number_format($otrasSalidas['otrasSalidas'])."</td>
				</tr>
				<tr  style='border-bottom: solid gray 1px;'>
					<td><strong>Total salidas día:</td>
					<td style='text-align:right;'>$".number_format($totalSalidasDia['totalDia'])."</strong></td>
				</tr>
				<tr>
					<td><strong><strong>Saldo del día:</td>
					<td style='text-align:right;'>$".number_format($saldoGeneral)."</strong></td>
				</tr>
			</tbody>
		</table>";
		echo "<br>Este informa ha sido enviado automáticamente a los correos administrativos";
		
	
		
		$asunto = "Cierre ".$nombreSede['sed_nombre']." ".$fecha; 
		$cuerpo = " 
		<html> 
		<head> 
		   <title>".utf8_decode('Informe diario de cierre'). "</title> 
		</head> 
		<body> 
		<h4>".$nombreSede['sed_nombre']." - ".$fecha."</h4> 
		
			<table width='300px'>
				<tbody>
					<tr>
						<td colspan='2'><h3>Recaudo</h3></td>
					</tr>
					<tr>
						<td>Recaudo en efectivo del día Sede:</td>
						<td style='text-align:right;'>$".number_format($efectivoDiaSede['efectivo'])."</td>
					</tr>
					<tr>
						<td>Recaudo consignaciones del día Sede:</td>
						<td style='text-align:right;'>$".number_format($efectivoDiaConsgncion['efectivo'])."</td>
					</tr>
					<tr>
						<td>Recaudo Corporativo:</td>
						<td style='text-align:right;'>$".number_format($efectivoCorporativo['efectivo'])."</td>
					</tr>
					<tr> 
						<td colspan='2' style='text-align:right;'>---------------------------------------</td> 
					</tr>
					<tr>
						<td><strong>Efectivo del mes masivos:</td>
						<td style='text-align:right;'>$".number_format($efectivoMes['efectivoMes'])."</strong></td>
					</tr>
					<tr>
						<td><strong>Efectivo del mes corporativos:</td>
						<td style='text-align:right;'>$".number_format($efectivoMesCorp['efectivoMes'])."</strong></td>
					</tr>
					<tr> 
						<td colspan='2' style='text-align:right;'>---------------------------------------</td> 
					</tr>
					<tr style='border-bottom: solid gray 1px;'>
						<td><strong>Consignaciones masivos mes:</td>
						<td style='text-align:right;'>$".number_format($consignacionMesMsv['consignacionMes'])."</strong></td>
					</tr>
					<tr style='border-bottom: solid gray 1px;'>
						<td><strong>Consignaciones corporativo mes:</td>
						<td style='text-align:right;'>$".number_format($consignacionMesCorp['consignacionMes'])."</strong></td>
					</tr>
					<tr> 
						<td colspan='2'><br><h3>Caja</h3> </td> 
					</tr>
					<tr>
						<td>Recaudo del día:</td>
						<td style='text-align:right;'>$".number_format($efectivoDia['efectivo'])."</td>
					</tr>
					<tr>
						<td>Saldo anterior:</td>
						<td style='text-align:right;'>$".number_format($saldoAnterior)."</td>
					</tr>
					<tr>
						<td><strong>Total efectivo:</td>
						<td style='text-align:right;'>$".number_format($totalEfectivo)."</strong></td>
					</tr>
					<tr>
						<td><strong>Total consignaciones:</td>
						<td style='text-align:right;'>$".number_format($totalConsignacion)."</strong></td>
					</tr>
					<tr> 
						<td colspan='2' style='text-align:right;'>---------------------------------------</td> 
					</tr>
					<tr>
						<td>Consignaciones Realizadas:</td>
						<td style='text-align:right;'>$".number_format($totalRecogida['recogidaTotal'])."</td>
					</tr>
					<tr>
						<td>Otras salidas:</td>
						<td style='text-align:right;'>$".number_format($otrasSalidas['otrasSalidas'])."</td>
					</tr>
					<tr>
						<td><strong>Total salidas día:</td>
						<td style='text-align:right;'>$".number_format($totalSalidasDia['totalDia'])."</strong></td>
					</tr>
					<tr> 
						<td colspan='2' style='text-align:right;'>---------------------------------------</td> 
					</tr>
					<tr>
						<td><strong><strong>Saldo del día:</td>
						<td style='text-align:right;'>$".number_format($saldoGeneral)."</strong></td>
					</tr>
				</tbody>
			</table>
		
		<p>Informe generado automaticamente por el sistema de Gestión GlobalPlay</p>
		</body> 
		</html> 
		"; 
	
		//para el envío en formato HTML 
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=UTF-8\r\n"; 
	
		//dirección del remitente 
		$headers .= 'From:'. utf8_decode('Sistema de gestión Globalplay').'<servicioalcliente@globalplay.tv>\r\n'; 
	
		// //dirección de respuesta, si queremos que sea distinta que la del remitente 
		// $headers .= "Reply-To: desarrolloweb@global.net.co\r\n"; 
	
		// //ruta del mensaje desde origen a destino 
		// $headers .= "Return-path: holahola@desarrolloweb.com\r\n"; 
	
		//direcciones que recibián copia 
		$headers .= "CC:dpto.base.usuarios@global.net.co\r\n"; 
	
		// //direcciones que recibirán copia oculta 
		// $headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n"; 
		$correo = 'dpto.base.usuarios@global.net.co , gerencia@global.net.co , erika.redondo@global.net.co , dpto.financiero@global.net.co';
		mail($correo,$asunto,$cuerpo,$headers);
		
   			echo ". El email fué enviado correctamente!";
		
		break;
}
 
 ?>