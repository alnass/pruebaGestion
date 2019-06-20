<?php
	// # encodé par @Anderson Ferrucho 
// maintenance effectuee par Anderson Ferrucho
include 'plantilla_duo.php';
// llamado a clase
require "../modelos/Contrato.php";
require "../modelos/CuentaCobro.php";
require_once "../modelos/CobroAutomatico.php";

$cuentaCobro 	= 	new CuentaCobro();
$cobro 		 	=	new CobroAutomatico();// maintenance
$cobro2 	 	=	new CobroAutomatico();// maintenance
/// CONSULTA A BD INDIVIDUAL 
// $sede 		= 	$_REQUEST['sede_id'];
$respuesta 		=	$cobro->listarporSedeImpar(3);
$respuesta2 	=	$cobro2->listarporSedePar(3);

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
}
else
{
	$lastday 		= 	date("d", mktime(0,0,0,$month,0,$year));	
}

$meses 			= 	array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
$mes 			= 	$meses[date('m')-1];
$limite_pago 	= 	'10/' .$month .'/'.$year;
$limite_pago2 	= 	'10/' .$month .'/'.$year;

$contador = 0; 
$contador_ciclo	=  Ceil(($respuesta2->num_rows + $respuesta->num_rows)/2);

// while ($row = $respuesta->fetch_assoc() AND $row2 = $respuesta2->fetch_assoc())
while ($contador <= $contador_ciclo)	
{
	$contador++;
	$cuentaCobro 	= 	new CuentaCobro();// llamado a la clase 
	
	$row = $respuesta->fetch_assoc();
	$row2 = $respuesta2->fetch_assoc();

	$pdf->AddPage();// define tamaño del papel margen maximo inferior 116

	$validar_cobro	=	$cobro->ultimoCobro($row['cont_id']);
	$prontopago 	=	$cuentaCobro->prontopago($row['cont_id']);
	$saldos			=	$cuentaCobro->saldos($row['cont_id']);
	$ult_cobro 		= 	$validar_cobro->fetch_assoc();

	if($ult_cobro)
	{
		if($row['cont_estado_servicio_id']!= 2)
		{
			$periodo 	=	'Servicio en estado '. $row['est_serv_nombre']. ' Ultimo cobro emitido por '. $ult_cobro['con_tran_nombre'] .' de ' .$ult_cobro['est_cta_observacion'];
		}
		else
		{
			if(date('d')>=26)
			{
				if($month == 12)
				{
					$month = 0;
					$year = $year+1;
					$periodo  	= 	"Periodo del 1 al " .$lastday . " de ".$meses[$month] ." de " .$year;	
				}
				else
				{
					$periodo  	= 	"Periodo del 1 al " .$lastday . " de ".$meses[$month] ." de " .$year;
				}
			}
			else
			{
				$periodo  	= 	"Periodo del 1 al " .$lastday . " de ".$meses[$month-1] ." de " .$year;	
			}
		}
	}
	else
	{
		echo '<script type="text/javascript">
    			alert("El servicio es un contrato nuevo o lleva mas de 3 meses suspendido, comuniquese con la extención 322 para mas Información");
    			//window.location.href="../vistas/cuentaCobro.php";
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

	$NoCobro 		= 	$ult_cobro['est_cta_no_transaccion'];// INDIVIDIAL
	$SALDO 			= 	$saldos['est_cta_saldo_anterior'];
	$MENSUALIDAD 	= 	$row['cont_valor_total_mes'];	
	if(empty($prontopago['prod_valor_pronto_pago']))
	{
		$P_PAGO 	= 	0;
	}
	else
	{
		$P_PAGO 		= 	$prontopago['prod_valor_pronto_pago'];	
	}
	$SUBTOTAL 		= 	$saldos['est_cta_saldo_actual'];
	$SUBTOTAL_PP	=	$SUBTOTAL - $P_PAGO;
	$TOTAL			= 	$SUBTOTAL;
	$VALIDAR		= 	$MENSUALIDAD - $P_PAGO;
	$nombres 		=	$row['per_nombre'].' '.$row['per_apellido'];
	$contrato 		= 	$row['cont_no_contrato'].'-'.$row['cont_id'];
	$documento 		= 	$row['per_num_documento'];
	$direccion 		= 	$row['cont_direccion_serv'].' '.$row['cont_barrio'];
	$direc_sede 	=	$row['sed_direccion'];
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

	$pdf->SetFont('Arial', 'B', 10);
	// PRIMER CUPON
	//NUMERO COBRO
	$pdf->SetXY(130,20);
	$pdf->Cell(55,6,$NoCobro,0,0,'R',0);
	//ESTADO DE CUENTA	
	$pdf->SetXY(169,31);
	$pdf->Cell(25,6,$row['est_serv_nombre'],0,0,'R',0);
	//FECHA FACTURA
	$pdf->SetXY(169,35.5);
	$pdf->Cell(25,6,$fecha,0,0,'R',0);
	//FECHA LIMITE
	$pdf->SetXY(169,40);
	$pdf->Cell(25,6,$limite_pago,0,0,'R',0);
	//SALDO
	$pdf->SetXY(169,48);
	$pdf->Cell(25,6,"$ ".number_format($SALDO),0,0,'R',0);
	//MENSUALIDAD
	$pdf->SetXY(169,52.5);
	$pdf->Cell(25,6,"$ ".number_format($MENSUALIDAD),0,0,'R',0);
	//SUBTOTAL
	$pdf->SetXY(169,57);
	$pdf->Cell(25,6,"$ ". number_format($SUBTOTAL),0,0,'R',0);
	// $pdf->Cell(25,6,"$ 70.000",0,0,'R',0);
	//FECHA LIMITE PRONTO PAGO 
	$pdf->SetXY(169,68.5);
	$pdf->Cell(25,6,$limite_pago,0,0,'R',0);
	//FECHA DESCUENTO PRONTO PAGO
	// $pdf->SetXY(135,67.5);
	// $pdf->Cell(30,6,'10-01-18',0,0,'C',0);
	$pdf->SetXY(169,64);
	$pdf->Cell(25,6,"$ ".number_format($P_PAGO),0,0,'R',0);
	//TOTAL PAGAR CON PRONTO PAGO
	$pdf->SetXY(169,74);
	$pdf->Cell(25,6,"$ ". number_format($SUBTOTAL_PP),0,0,'R',0);
	// $pdf->Cell(25,6,"$ 70.000",0,0,'R',0);
	//TOTAL PAGAR
	$pdf->SetXY(169,79.5);
	$pdf->Cell(25,6,"$ ". number_format($TOTAL),0,0,'R',0);
	// $pdf->Cell(25,6,"$ 70.000",0,0,'R',0);
	//NOMBRES Y APELLIDOS
	$pdf->SetXY(12,30);
	$pdf->Cell(55,6,utf8_decode($nombres),0,0,'L',0);
	// CODIGO EN LA BD
	$pdf->SetXY(100,30);
	$pdf->Cell(10,6,$contrato,0,0,'L',0);	
	//DOCUMENTO
	$pdf->SetXY(12,35);
	$pdf->Cell(40,6,"Documento: " . $documento,0,0,'L',0);
	//DIRECCION
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->SetXY(12,40);
	$pdf->Cell(40,6,$direccion,0,0,'L',0);
	$pdf->SetXY(12,59);
	$pdf->Cell(40,6,$aplica_descuento,0,0,'L',0); 
	// $pdf->Cell(40,6,"Saldo generado, por cobro de traslado",0,0,'L',0); 
	//PRODUCTO
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->SetXY(12,51);
	$pdf->Cell(40,6,"Servicio " .$producto,0,0,'L',0);
	// //PRODUCTO
	$pdf->SetXY(12,56);
	$pdf->MultiCell(110,4,$periodo,0,1);  
	//$pdf->MultiCell(165,3.5,utf8_decode($observac).' '.utf8_decode($obser_OT).', '. utf8_decode($ultima_observacion),0,1);

	// //PRODUCTO
	// $pdf->SetXY(12,55);
	// $pdf->Cell(40,6,"!! Esta cuenta presenta un saldo en mora de $ " . number_format($row['cli_saldo_anterior']),0,0,'L',0);
	// $pdf->SetXY(12,59);
	// $pdf->Cell(40,6,"realice su pago de inmediato, evite reporte a centrales de riesgo!! ",0,0,'L',0);
	// CUPON EMPRESA
	$pdf->SetXY(128,100);
	$pdf->Cell(55,6,$NoCobro,0,0,'R',0);
	// $pdf->SetXY(48,109.5);
	$pdf->SetXY(100,109.5);
	$pdf->Cell(55,6,utf8_decode($nombres),0,0,'L',0);
	$pdf->SetXY(160,109.5);
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
	// CUPON 2 EMPRESA
	$pdf->SetFont('Arial', 'B', 8);
	//DIRECCION SEDE CUPON 1
	$pdf->SetXY(32,75.9);
	$pdf->Cell(40,6,$telef_sede,0,0,'L',0);
	// $pdf->Cell(40,6,'Realice su pago en nuestra nueva Oficina: ',0,0,'L',0);// FORMATO FOMEQUE
	$pdf->SetXY(29,79.5);
	$pdf->Cell(40,6,$direc_sede,0,0,'L',0);

	// **** SEGUNDO RECIBO **** ///
	$pdf->SetFont('Arial', 'B', 10);

	$cuentaCobro2 	= 	new CuentaCobro();// llamado a la clase 

	$validar_cobro2	=	$cobro2->ultimoCobro($row2['cont_id']);
	$prontopago2 	=	$cuentaCobro2->prontopago($row2['cont_id']);
	$saldos2		=	$cuentaCobro2->saldos($row2['cont_id']);
	$ult_cobro2		= 	$validar_cobro2->fetch_assoc();

	if($ult_cobro2)
	{
		if($row2['cont_estado_servicio_id']!= 2)
		{
			$periodo2 	=	'Servicio en estado '. $row2['est_serv_nombre']. ' Ultimo cobro emitido por '. $ult_cobro2['con_tran_nombre'] .' de ' .$ult_cobro2['est_cta_observacion'];
		}
		else
		{
			if(date('d')>=26)
			{
				if($month == 12)
				{
					$month = 0;
					$year = $year+1;
					$periodo2  	= 	"Periodo del 1 al " .$lastday . " de ".$meses[$month] ." de " .$year;	
				}
				else
				{
					$periodo2  	= 	"Periodo del 1 al " .$lastday . " de ".$meses[$month] ." de " .$year;
				}
			}
			else
			{
				$periodo2  	= 	"Periodo del 1 al " .$lastday . " de ".$meses[$month-1] ." de " .$year;	
			}
		}
	}
	else
	{
		echo '<script type="text/javascript">
    			alert("El servicio es un contrato nuevo o lleva mas de 3 meses suspendido, comuniquese con la extención 322 para mas Información");
    			//window.location.href="../vistas/cuentaCobro.php";
    		</script>';
	}

	$producto2 	= '';

	if ($row2['cont_tv_analogica'] == 1) 
	{
		$producto2 = " TV-ANALOGA ";
	}
	if ($row2['cont_tv_digital'] == 1) 
	{
		$producto2 =$producto2." TV-DIGITAL";
	}
	if ($row2['cont_internet'] == 1) 
	{
		$producto2 =$producto2. "+ INTERNET";
	}

	$NoCobro2 	= 	$ult_cobro2['est_cta_no_transaccion'];// INDIVIDIAL
	$SALDO2			= 	$saldos2['est_cta_saldo_anterior'];
	$MENSUALIDAD2 	= 	$row2['cont_valor_total_mes'];	
	if(empty($prontopago2['prod_valor_pronto_pago']))
	{
		$P_PAGO2 	= 	0;
	}
	else
	{
		$P_PAGO2 		= 	$prontopago2['prod_valor_pronto_pago'];	
	}
	$SUBTOTAL2 		= 	$saldos2['est_cta_saldo_actual'];
	$SUBTOTAL_PP2	=	$SUBTOTAL2 - $P_PAGO2;
	$TOTAL2			= 	$SUBTOTAL2;
	$VALIDAR2		= 	$MENSUALIDAD2 - $P_PAGO2;
	$nombres2 		=	$row2['per_nombre'].' '.$row2['per_apellido'];
	$contrato2 		= 	$row2['cont_no_contrato'].'-'.$row2['cont_id'];
	$documento2		= 	$row2['per_num_documento'];
	$direccion2		= 	$row2['cont_direccion_serv'].' '.$row2['cont_barrio'];
	$direc_sede2 	=	$row2['sed_direccion'];
	$telef_sede2 	= 	$row2['sed_telefono_2'];

	if($saldos2['est_cta_saldo_anterior'] <= $VALIDAR2 * -1)
	{
		if($saldos2['est_cta_saldo_anterior'] < $VALIDAR2 * -1 )
		{
			$aplica_descuento2	= 'Pago anticipado aplica descuento pronto pago a la mensualidad actual';
			$MENSUALIDAD2 		= 	$MENSUALIDAD2 - $P_PAGO2;
			$SUBTOTAL2 			= 	$SALDO2 + $MENSUALIDAD2;	
			$TOTAL2				= 	0;	
			$SUBTOTAL_PP2 		=	0;
		}
		else
		{
			$aplica_descuento2	= 'Pago anticipado aplica descuento pronto pago a la mensualidad actual';
			$MENSUALIDAD2 		= 	$MENSUALIDAD2 - $P_PAGO2;
			$TOTAL2				= 	0;	
			$SUBTOTAL_PP2 		=	0;
		}
	}
	else
	{
		$aplica_descuento2 = '';
	}

	// SEGUNDO RECIBO 
	//NUMERO COBRO
	$pdf->SetXY(130,159.5);
	$pdf->Cell(55,6,$NoCobro2,0,0,'R',0);
	//ESTADO DE CUENTA	
	$pdf->SetXY(169,171);
	$pdf->Cell(25,6,$row2['est_serv_nombre'],0,0,'R',0);
	//FECHA FACTURA
	$pdf->SetXY(169,175.5);
	$pdf->Cell(25,6,$fecha,0,0,'R',0);
	//FECHA LIMITE
	$pdf->SetXY(169,180);
	$pdf->Cell(25,6,$limite_pago2,0,0,'R',0);
	//SALDO
	$pdf->SetXY(169,187.5);
	$pdf->Cell(25,6,"$ ".number_format($SALDO2),0,0,'R',0);
	//MENSUALIDAD
	$pdf->SetXY(169,192);
	$pdf->Cell(25,6,"$ ".number_format($MENSUALIDAD2),0,0,'R',0);
	//SUBTOTAL
	$pdf->SetXY(169,197);
	$pdf->Cell(25,6,"$ ". number_format($SUBTOTAL2),0,0,'R',0);
	// $pdf->Cell(25,6,"$ 70.000",0,0,'R',0);
	//FECHA LIMITE PRONTO PAGO 
	$pdf->SetXY(169,208);
	$pdf->Cell(25,6,$limite_pago2,0,0,'R',0);
	//FECHA DESCUENTO PRONTO PAGO
	// $pdf->SetXY(135,67.5);
	// $pdf->Cell(30,6,'10-01-18',0,0,'C',0);
	$pdf->SetXY(169,204);
	$pdf->Cell(25,6,"$ ".number_format($P_PAGO2),0,0,'R',0);
	//TOTAL PAGAR CON PRONTO PAGO
	$pdf->SetXY(169,213.5);
	$pdf->Cell(25,6,"$ ". number_format($SUBTOTAL_PP2),0,0,'R',0);
	// $pdf->Cell(25,6,"$ 70.000",0,0,'R',0);
	//TOTAL PAGAR
	$pdf->SetXY(169,219);
	$pdf->Cell(25,6,"$ ". number_format($TOTAL2),0,0,'R',0);
	// $pdf->Cell(25,6,"$ 70.000",0,0,'R',0);
	//NOMBRES Y APELLIDOS
	$pdf->SetXY(12,171);
	$pdf->Cell(55,6,utf8_decode($nombres2),0,0,'L',0);
	// CODIGO EN LA BD
	$pdf->SetXY(100,176);
	$pdf->Cell(10,6,$contrato2,0,0,'L',0);	
	//DOCUMENTO
	$pdf->SetXY(12,176);
	$pdf->Cell(40,6,"Documento: " . $documento2,0,0,'L',0);
	//DIRECCION
	$pdf->SetFont('Arial', 'B', 8);
	$pdf->SetXY(12,181);
	$pdf->Cell(40,6,$direccion2,0,0,'L',0);
	$pdf->SetXY(12,199);
	$pdf->Cell(40,6,$aplica_descuento2,0,0,'L',0); 
	// $pdf->Cell(40,6,"Saldo generado, por cobro de traslado",0,0,'L',0); 
	//PRODUCTO
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->SetXY(12,190.5);
	$pdf->Cell(40,6,"Servicio " .$producto2,0,0,'L',0);
	// //PRODUCTO
	$pdf->SetXY(12,194.5);
	$pdf->MultiCell(110,4,$periodo2,0,1);  
	//$pdf->MultiCell(165,3.5,utf8_decode($observac).' '.utf8_decode($obser_OT).', '. utf8_decode($ultima_observacion),0,1);

	// //PRODUCTO
	// $pdf->SetXY(12,55);
	// $pdf->Cell(40,6,"!! Esta cuenta presenta un saldo en mora de $ " . number_format($row['cli_saldo_anterior']),0,0,'L',0);
	// $pdf->SetXY(12,59);
	// $pdf->Cell(40,6,"realice su pago de inmediato, evite reporte a centrales de riesgo!! ",0,0,'L',0);
	// CUPON EMPRESA
	$pdf->SetXY(128,239.5);
	$pdf->Cell(55,6,$NoCobro2,0,0,'R',0);
	// $pdf->SetXY(48,109.5);
	$pdf->SetXY(100,249.5);
	$pdf->Cell(55,6,utf8_decode($nombres2),0,0,'L',0);
	$pdf->SetXY(160,249.5);
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
	// CUPON 2 EMPRESA
	$pdf->SetFont('Arial', 'B', 8);
	//DIRECCION SEDE CUPON 1
	$pdf->SetXY(32,215.7);
	$pdf->Cell(40,6,$telef_sede2,0,0,'L',0);
	// $pdf->Cell(40,6,'Realice su pago en nuestra nueva Oficina: ',0,0,'L',0);// FORMATO FOMEQUE
	$pdf->SetXY(29,219);
	$pdf->Cell(40,6,$direc_sede2,0,0,'L',0);

	
}

	$pdf->Output();

?>