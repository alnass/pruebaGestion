<?php
	// # encodé par @Anderson Ferrucho 
// maintenance effectuee par Anderson Ferrucho
include 'plantilla_individual.php';
// llamado a clase
require "../modelos/Contrato.php";
require "../modelos/OrdenTrabajo.php";
require "../modelos/CuentaCobro.php";
require_once "../modelos/CobroAutomatico.php";


$objContrato 	=	new Contrato();
$cuentaCobro 	= 	new CuentaCobro();
$cobro 		 	=	new CobroAutomatico();// maintenance
$call_producto	=  	new OrdenTrabajo();

/// CONSULTA A BD INDIVIDUAL 
$cont_id 	= 	$_REQUEST['cont'];
$respuesta 	=	$objContrato->mostrar($cont_id);

$pdf= new PDF();
$pdf->AliasNbPages();
	
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial', 'B', 10);

$aplica_descuento	=	'';
$aplica_descuento2	=	'';
	
$fecha 			= 	date("d" ."/". "m" ."/". "Y" );
$fecha_actual 	= 	date("d" ."/". "m" ."/". "Y" );
// $fecha 		= 	'01/10/2018';
$month 			=  	date('n');// recibe la representación númerica del mes
$year 			= 	date('Y');
// VALIDA SI EL DÍA DEL SISTEMA ES MAYOR O IGUAL A 26 PARA CAMBIAR LA FECHA DE LA CUENTA DE COBRO
if(date('d')>=26)
{
	$lastday 		= 	date('d', mktime(0,0,0,$month+2,0,$year));// llama el último día del mes siguiente
	// valida el mes en número
	if(date('n')==12)
	{	
		$limite_pago 	= 	'10/' .$month .'/'.$year;
	}
	else
	{
		$limite_pago 	= 	'10/' .$month .'/'.$year;
	}
}
else
{
	$lastday 		= 	date("d", mktime(0,0,0,$month+1,0,$year));	
	$limite_pago 	= 	'10/' .$month .'/'.$year;
}



$meses 			= 	array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
$mes 			= 	$meses[date('m')-1];
$validar_cobro	=	$cobro->ultimoCobro($cont_id);

$limite_pago 	= 	'10/' .$month .'/'.$year;
$evitar_suspencion 	= 	date("20" ."/". $month ."/". "Y" );
 
while ($row = $respuesta->fetch_assoc())/// INDIVIDUAL
{

	$prontopago =	$cuentaCobro->prontopago($cont_id);
	$saldos		=	$cuentaCobro->saldos($cont_id);
	$ult_cobro 	= 	$validar_cobro->fetch_assoc();

	if($ult_cobro)
	{
		if($row['cont_estado_servicio_id']!= 2)
		{
			if(date('d')>=26)
			{
				if($month == 12)
				{
					$month 			= 	0;
					$year 			= 	$year+1;
					$mes_lmt 		=  	$month + 1;
					$limite_pago 	= 	'10/' .$mes_lmt .'/'.$year;
					$fecha 			= 	date("01" ."/". $mes_lmt ."/". "Y" );
					$evitar_suspencion 	= 	date("20" ."/". $month ."/". "Y" );
				}
				else
				{
					$mes_lmt 		=  	$month + 1;
					$limite_pago 	= 	'10/' .$mes_lmt .'/'.$year;
					$fecha 			= 	date("01" ."/". $mes_lmt ."/". "Y" );
					$evitar_suspencion 	= 	date("20" ."/". $month ."/". "Y" );
				}
			}
			else
			{
				$limite_pago 	= 	'10/' .$month .'/'.$year;
				$fecha 			= 	date("d" ."/". "m" ."/". "Y" );
				$evitar_suspencion 	= 	date("20" ."/". $month ."/". "Y" );
			}

			$P_PAGO 	= 	0;	
			$periodo 	=	utf8_decode('Servicio en estado '. $row['est_serv_nombre']. ' último cobro emitido '. $ult_cobro['con_tran_nombre'] .' de ' .$ult_cobro['est_cta_observacion']);
		}
		else
		{
			if(date('d')>=26)
			{
				if($month == 12)
				{
					$month 			= 	0;
					$year 			= 	$year+1;
					$mes_lmt 		=  	$month + 1;
					$periodo  		= 	"Periodo del 1 al " .$lastday . " de ".$meses[$month] ." de " .$year;	
					$limite_pago 	= 	'10/' .$mes_lmt .'/'.$year;
					$fecha 			= 	date("01" ."/". $mes_lmt ."/". "Y" );
					$evitar_suspencion 	= 	date("20" ."/". $month ."/". "Y" );
				}
				else
				{
					$mes_lmt 		=  	$month + 1;
					
					if($mes_lmt < 10)
					{
						$mes_lmt 		=  	'0'.$mes_lmt;
					}
					
					$periodo  		= 	"Periodo del 1 al " .$lastday . " de ".$meses[$month] ." de " .$year;
					$limite_pago 	= 	'10/' .$mes_lmt .'/'.$year;
					$fecha 			= 	date("01" ."/". $mes_lmt ."/". "Y" );
					$evitar_suspencion 	= 	date("20" ."/". $mes_lmt ."/". "Y" );
				}
			}
			else
			{
				$periodo  		= 	"Periodo del 1 al " .$lastday . " de ".$meses[$month-1] ." de " .$year;	
				
				if($month < 10)
				{
					$limite_pago 	= 	'10/0' .$month .'/'.$year;	
					$evitar_suspencion 	= 	date("20" ."/0". $month ."/". "Y" );
				}
				else
				{
					$limite_pago 	= 	'10/' .$month .'/'.$year;
					$evitar_suspencion 	= 	date("20" ."/". $month ."/". "Y" );
				}
				$fecha 			= 	date("d" ."/". "m" ."/". "Y" );
			}

			$P_PAGO 	= 	$prontopago['prod_valor_pronto_pago'];	
		}
	}
	else
	{
		echo '<script type="text/javascript">
    			alert("El servicio es un contrato nuevo o lleva mas de 3 meses suspendido, comuniquese con la extención 322 para mas Información");
    			window.location.href="../vistas/cuentaCobro.php";
    		</script>';
	}

	$producto 	= '';

	if ($row['cont_tv_analogica'] == 1) 
	{
		$producto = " TV-ANALOGA ";
	}
	if ($row['cont_tv_digital'] == 1) 
	{
		$producto =$producto." TV-DIGITAL";
	}
	if ($row['cont_internet'] == 1) 
	{
		$producto =$producto. "+ INTERNET";
	}

	$cuentaCobro 	= 	$ult_cobro['est_cta_no_transaccion'];// INDIVIDIAL
	$MENSUALIDAD 	= 	$row['cont_valor_total_mes'];	
	$SUBTOTAL 		= 	$saldos['est_cta_saldo_actual'];

	if($SUBTOTAL == $MENSUALIDAD)
	{
		$SALDO 	= 0;	
	}
	else
	{
		$SALDO 			= 	$saldos['est_cta_saldo_anterior'];
	}

	if($SUBTOTAL <= 0)
	{
		$SUBTOTAL_PP	= 	0;
	}
	else
	{
		$SUBTOTAL_PP	=	$SUBTOTAL - $P_PAGO;
	}
	$TOTAL			= 	$SUBTOTAL;
	$VALIDAR		= 	$MENSUALIDAD - $P_PAGO;
	$nombres 		=	$row['per_nombre'].' '.$row['per_apellido'];
	$contrato 		= 	$row['cont_no_contrato'].'-'.$row['cont_id'];
	$documento 		= 	$row['per_num_documento'];
	$direccion 		= 	$row['cont_direccion_serv'].' '.$row['cont_barrio'];
	$direc_sede 	=	$row['sed_direccion'];
	$barrio_sede 	=	$row['sed_direccion'];
	$telef_sede 	= 	$row['sed_telefono_2'];

	if($saldos['est_cta_saldo_anterior'] <= $VALIDAR * -1)
	{
		if($saldos['est_cta_saldo_anterior'] < $VALIDAR * -1 )
		{
			$aplica_descuento	= 'Pago anticipado aplica descuento pronto pago a la mensualidad actual';
			$MENSUALIDAD 		= 	$MENSUALIDAD - $P_PAGO;
			$SUBTOTAL 			= 	$SALDO + $MENSUALIDAD;	
			$TOTAL 				= 	0;	
			$SUBTOTAL_PP 		=	0;
		}
		else
		{
			$aplica_descuento	= 'Pago anticipado aplica descuento pronto pago a la mensualidad actual';
			$MENSUALIDAD 		= 	$MENSUALIDAD - $P_PAGO;
			$TOTAL 				= 	0;	
			$SUBTOTAL_PP 		=	0;
		}
	}
	else
	{
		$aplica_descuento = '';
	}

	/*-------------------------
	| CAMBIA FECHA LIMITE PAGO |
	 --------------------------*/

	$pdf->SetFont('Arial', 'B', 10);
	$pdf->AddPage();// define tamaño del papel margen maximo inferior 116

	/// **** SECCIÓN DERECHA SERVICIO **** /////

	// PRIMER CUPON
	//NUMERO COBRO
	$pdf->SetXY(130,18);
	$pdf->Cell(55,6,$cuentaCobro,0,0,'R',0);
	//ESTADO DE CUENTA	
	$pdf->SetXY(169,29);
	$pdf->Cell(25,6,$row['est_serv_nombre'],0,0,'R',0);
	//FECHA FACTURA
	$pdf->SetXY(169,33.5);
	$pdf->Cell(25,6,$fecha,0,0,'R',0);
	//FECHA LIMITE
	$pdf->SetXY(169,38);
	$pdf->Cell(25,6,$limite_pago,0,0,'R',0);
	//FECHA EVITAR SUSPENCION	
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetXY(169,43);
	$pdf->Cell(25,6,$evitar_suspencion,0,0,'R',0);
	//SALDO
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->SetXY(169,52);
	$pdf->Cell(25,6,"$ ".number_format($SALDO),0,0,'R',0);
	//MENSUALIDAD
	$pdf->SetXY(169,56.5);
	$pdf->Cell(25,6,"$ ".number_format($MENSUALIDAD),0,0,'R',0);
	//SUBTOTAL
	$pdf->SetXY(169,61);
	$pdf->Cell(25,6,"$ ". number_format($SUBTOTAL),0,0,'R',0);
	// $pdf->Cell(25,6,"$ 70.000",0,0,'R',0);
	//FECHA LIMITE PRONTO PAGO 
	$pdf->SetXY(169,72.5);
	$pdf->Cell(25,6,$limite_pago,0,0,'R',0);
	//FECHA DESCUENTO PRONTO PAGO
	// $pdf->SetXY(135,67.5);
	// $pdf->Cell(30,6,'10-01-18',0,0,'C',0);
	$pdf->SetXY(169,68);
	$pdf->Cell(25,6,"$ ".number_format($P_PAGO),0,0,'R',0);
	//TOTAL PAGAR CON PRONTO PAGO
	$pdf->SetXY(169,78);
	$pdf->Cell(25,6,"$ ". number_format($SUBTOTAL_PP),0,0,'R',0);
	// $pdf->Cell(25,6,"$ 70.000",0,0,'R',0);
	//TOTAL PAGAR
	$pdf->SetXY(169,83.5);
	$pdf->Cell(25,6,"$ ". number_format($TOTAL),0,0,'R',0);

	/// **** FIN SECCIÓN DERECHA SERVICIO **** /////


	// $pdf->Cell(25,6,"$ 70.000",0,0,'R',0);

	//// *** SECCION IZQ DATOS DEL USUARIO ***** /// 
	//NOMBRES Y APELLIDOS
	$pdf->SetXY(12,30);
	$pdf->Cell(55,6,utf8_decode($nombres),0,0,'L',0);
	// CODIGO EN LA BD
	$pdf->SetXY(100,30);
	$pdf->Cell(10,6,$contrato,0,0,'L',0);	
	//DOCUMENTO
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->SetXY(12,33.2);
	$pdf->Cell(40,6,"Documento: " . $documento,0,0,'L',0);
	//DIRECCION
	$pdf->SetXY(12,37.5);
	$pdf->MultiCell(110,3,$direccion,0,1);  
	// $pdf->Cell(40,6,$direccion,0,0,'L',0);
	$pdf->SetXY(12,59);
	$pdf->Cell(40,6,$aplica_descuento,0,0,'L',0); 

	/// **** FIN SECCIÓN IZQUIERDA DATOS DEL USUARIO *** /// 


	// $pdf->Cell(40,6,"Saldo generado, por cobro de traslado",0,0,'L',0); 
	

	// ****  SECCION CONCEPTO ***** /////
	// PRODUCTOS
	// $pdf->SetFont('Arial', 'B', 10);

	$producto_clie 	= $call_producto->listarProducto($cont_id);

	$xprd	= 	12;
	$yprd 	= 	46.5;
	$xvprd	= 	58;
	$yvprd	= 	46.5;
	$xvprdd	= 	73;
	$yvprdd	= 	46.5;
	$xtvprd	= 	96;
	$ytvprd	= 	46.5;

	$pdf->SetXY($xprd, $yprd);
	$pdf->Cell(20,6,"Descripcion:",0,0,'L',0);
	$pdf->SetXY($xvprd, $yvprd);
	$pdf->Cell(20,6,"Valor: ",0,0,'L',0);
	
	if($producto_clie->num_rows > 1)
	{
		$pdf->SetXY($xvprdd, $yvprdd);
		$pdf->Cell(20,6,'Dscto X Combo',0,0,'C',0);
		$pdf->SetXY($xtvprd, $ytvprd);
		$pdf->Cell(20,6,"Total Servicio ",0,0,'C',0);
	}
	else
	{
		$pdf->SetXY($xvprdd, $yvprdd);
		$pdf->Cell(20,6,"Total Servicio ",0,0,'C',0);	
	}
	
	$total_prod 	=	0;
	$total_desc 	= 	0;

	while ($reg_prod = $producto_clie->fetch_object()) 
	{
		$yprd 	= 	$yprd + 3.5;
		$yvprd 	= 	$yvprd + 3.5;
		$yvprdd	= 	$yvprdd+ 3.5;
		$ytvprd	= 	$ytvprd+ 3.5;

		$pdf->SetXY($xprd, $yprd);
		$pdf->Cell(20,6,utf8_decode($reg_prod->prod_nombre),0,0,'L',0);
		$pdf->SetXY($xvprd, $yvprd);
		$pdf->Cell(20,6,"$ ". number_format($reg_prod->prod_valor),0,0,'L',0);
		
		if($producto_clie->num_rows > 1)
		{
			$pdf->SetXY($xvprdd, $yvprdd);
			$pdf->Cell(20,6,"$ " .number_format($reg_prod->prod_descuento_x_combo),0,0,'R',0);
			$total_servicio 	= 	$reg_prod->prod_valor - $reg_prod->prod_descuento_x_combo;
			$pdf->SetXY($xtvprd, $ytvprd);
			$pdf->Cell(20,6,"$ " .number_format($total_servicio),0,0,'R',0);
		}
		else
		{
			$total_servicio 	= 	$reg_prod->prod_valor;
			$pdf->SetXY($xvprdd, $yvprdd);
			$pdf->Cell(20,6,"$ " .number_format($total_servicio),0,0,'R',0);	
		}
		
		$total_prod 	= 	$total_prod + $reg_prod->prod_valor;
		$total_desc 	= 	$total_desc + $reg_prod->prod_descuento_x_combo;

	}

	$ytvprd	= 	$ytvprd+ 3.5;
	$yvprd 	= 	$yvprd + 3.5;
	$yvprdd	= 	$yvprdd+ 3.5;	
	$yprd 	= 	$yprd + 3.5;
	
	$pdf->SetXY($xprd, $yprd);
	$pdf->Cell(20,6,"VALOR TOTAL ",0,0,'L',0);

	$pdf->SetXY($xvprd, $yvprd);
	$pdf->Cell(20,6,"$ ". number_format($total_prod),0,0,'L',0);
	
	if($producto_clie->num_rows > 1)
	{
		$pdf->SetXY($xvprdd, $yvprdd);
		$pdf->Cell(20,6,"$ ". number_format($total_desc),0,0,'R',0);
		$total_servicio 	= 	$total_prod - $total_desc;
		$pdf->SetXY($xtvprd, $ytvprd);
		$pdf->Cell(20,6,"$ " .number_format($total_servicio),0,0,'R',0);
	}
	else
	{
		$total_servicio 	= 	$total_prod;
		$pdf->SetXY($xvprdd, $yvprdd);
		$pdf->Cell(20,6,"$ " .number_format($total_servicio),0,0,'R',0);	
	}
	// FIN PRODUCTOS
	// //PERIODO FACTURACION
	$yprd 	= 	$yprd + 4.5;
	$pdf->SetXY($xprd, $yprd);
	$pdf->MultiCell(110,4,$periodo,0,1);  

	// **** FIN CONCEPTO *** //// 

	

	//$pdf->MultiCell(165,3.5,utf8_decode($observac).' '.utf8_decode($obser_OT).', '. utf8_decode($ultima_observacion),0,1);

	// //PRODUCTO
	// $pdf->SetXY(12,55);
	// $pdf->Cell(40,6,"!! Esta cuenta presenta un saldo en mora de $ " . number_format($row['cli_saldo_anterior']),0,0,'L',0);
	// $pdf->SetXY(12,59);
	// $pdf->Cell(40,6,"realice su pago de inmediato, evite reporte a centrales de riesgo!! ",0,0,'L',0);
	// CUPON EMPRESA
	$pdf->SetXY(128,101);
	$pdf->Cell(55,6,$cuentaCobro,0,0,'R',0);
	// $pdf->SetXY(48,109.5);
	// DATOS SUSCRIPTOR
	$pdf->SetXY(100,110.5);
	$pdf->Cell(55,6,utf8_decode($nombres),0,0,'L',0);
	// $pdf->SetXY(160,109.5);
	// $pdf->Cell(40,6,"Documento: " . $row['cli_doc_cliente'],0,0,'L',0);
	// $pdf->SetXY(52.5,121);
	// $pdf->Cell(17.5,6,$fecha,0,0,'R',0);
	// $pdf->SetXY(80,121);
	// $pdf->Cell(25,6,$row['cli_estado'],0,0,'C',0);
	// $pdf->SetXY(112.5,121);
	// $pdf->Cell(25,6,$mes,0,0,'C',0);
	// /// PAGAR CON PRONTO PAGO 
	// $pdf->SetXY(139,121);
	// $pdf->Cell(25,6,"$ ". number_format($SUBTOTAL_PP),0,0,'R',0);
	// // $pdf->Cell(25,6,"$ 70.000",0,0,'R',0);
	// /// PAGAR SIN PRONTO PAGO
	// $pdf->SetXY(171,121);
	// $pdf->Cell(25,6,"$ ".number_format($TOTAL),0,0,'C',0);
	// $pdf->Cell(25,6,"$ 70.000",0,0,'C',0);
	
	// EFECTUE SU PAGO EN 
	$pdf->SetFont('Arial', 'B', 8);
	//DIRECCION SEDE CUPON 1
	$pdf->SetXY(32,80.72);
	$pdf->Cell(40,6,$telef_sede,0,0,'L',0);
	// $pdf->Cell(40,6,'Realice su pago en nuestra nueva Oficina: ',0,0,'L',0);// FORMATO FOMEQUE
	$pdf->SetXY(29,84.2);
	$pdf->Cell(40,6,utf8_decode($direc_sede),0,0,'L',0);
	
}

	$pdf->Output();

?>