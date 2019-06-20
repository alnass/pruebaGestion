<?php
// # encodé par @Anderson Ferrucho 
$ot 	=	$_GET['ord_trab_id'];

require "../fpdf181/fpdf.php";
require "../modelos/SeguimientoOT.php";

date_default_timezone_set('America/Bogota');
$pdf	=	new FPDF();

$ordenTrabajo 	= 	new SeguimientoOT();

$contador 	=	0;
// METODO PARA CONSULTAR LA ORDEN DE TRABAJO 
$respuesta 	= 	$ordenTrabajo->mostrarOT($ot);

$ot_no 		=	$respuesta['ord_trab_id'];
$usuario	=	$respuesta['per_nombre'] . ' ' . $respuesta['per_apellido'];
$telefono 	=	$respuesta['per_telefono_1']. ' - '. $respuesta['per_telefono_2'];
$tipo_docu	=	$respuesta['tip_doc_nombre'];
$doc_no 	=	$respuesta['per_num_documento'];
$direccion	=	$respuesta['cont_direccion_serv'] .' B. ' .$respuesta['cont_barrio'];
$departmto	=	$respuesta['ciu_nombre'];
$municipio	=	$respuesta['ciu_nombre'];
$contrato 	= 	$respuesta['cont_id'];
$servicio 	= 	$respuesta['est_serv_nombre'];
$error 		= 	'BD_EST_CON_001';// ERROR QUE SE MOSTRARA SI EL ESTADO DEL CONTRATO ESTA EN 0 
$prdX 		= 	40;
$producto	=	'PRUEBA';
$observac 	=	$respuesta['cont_adicional'];
$obser_OT 	=	$respuesta['ord_trab_observacion'];

$validarOTS 	= 	$ordenTrabajo->validarSeguimientoOT($respuesta['ord_trab_id']);

if($validarOTS)
{
	$tec_ced	=	$validarOTS['tec_documento'];
	$tec_nom	=	$validarOTS['tec_nombre'] . " " . $validarOTS['tec_apellido'];
}
else
{
	$tec_ced	=	$respuesta['usu_num_documento'];
	$tec_nom	=	$respuesta['usu_nombre'].' '.$respuesta['usu_apellido'];	
}

$fech_prog	=	$respuesta['ord_trab_fecha_programacion'];
$fech_vcmt	=	$respuesta['ord_trab_fecha_vencimiento'];

/// metodo para buscar los productos del contrato
$productos 	=	$ordenTrabajo->listarProducto($contrato);

/// METODO PARA BUSCAR LOS EQUIPOS DEL CONTRATO
$equipo 	= 	$ordenTrabajo->listarEquipoInstalado($contrato);

$fecha 		=	(date('Y/m/d g:i a'));

$validarOTS 	= 	$ordenTrabajo->validarSeguimientoOT($respuesta['ord_trab_id']);

if(!empty($validarOTS))
{
	$ultima_observacion = $validarOTS['ots_observacion'];
}
else
{
	$ultima_observacion = '';	
}

if(empty($respuesta))
{
	printf('ERROR '.$error);
}
else{
		
		$pdf->AddPage();

		if($respuesta['est_serv_nombre'] == 'POR CORTAR')
		{
			$pdf->Image('contratoImg/formato_ot1_001_cortes.jpg',0,0,215);
			$YTEC		=	115;
			$CTEC		=	119.5;
			$equipo 	= 	'';
			$observac 	= 	'';
			$ob_x 		= 	142;
			$ob_y 		=	59.5;
		}
		elseif($respuesta['est_serv_nombre'] == 'POR RECONECTAR')
		{
			$pdf->Image('contratoImg/formato_ot_reconexion-001.jpg',0,0,215);
			$YTEC	=	119.5;
			$CTEC	=	123.5;	
			$equipo = 	'';
			$observac 	= 	'';
			$pdf->SetXY(43,63.5);
			$ob_x 	= 	43;
			$ob_y 	=	63.5;
		}
		else
		{
			$pdf->Image('contratoImg/formato_ot1_001.jpg',0,0,215);	
			$YTEC	=	250;
			$CTEC 	=	254.5;
			$pdf->SetXY(43,63.5);
			$ob_x 	= 	43;
			$ob_y 	=	63.5;
		}
		
		$pdf->SetFont('Arial', 'B', 11);
		$pdf->SetXY(127,15.5);
		$pdf->Cell(55,6,$ot_no,0,0,'R',0);
		$pdf->SetXY(63,22);
		$pdf->Cell(55,6,$fech_prog,0,0,'R',0);
		$pdf->SetXY(106,22);
		$pdf->Cell(55,6,$fech_vcmt,0,0,'R',0);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetXY(150,22);
		$pdf->Cell(55,6,$fecha,0,0,'R',0);
		$contador 	=	0;
		$pdf->SetFont('Arial', 'B', 8);

		$Yeq 	=	116;
		$Yeq_p 	=	116.3;


	if(!empty($equipo))
	{
		while($registro = $equipo->fetch_object())
		{
			if(empty($registro))
			{
				echo 'No hay equipos instalados';
			}
			else
			{
				$equipos[$contador]['tipo']			=	$registro->equi_tip_nombre;
				$equipos[$contador]['referencia']	=	$registro->equi_referencia;
				$equipos[$contador]['mac']			=	$registro->equi_det_mac;
				$equipos[$contador]['sn']			=	$registro->equi_det_sn;
				$equipos[$contador]['marca']		=	$registro->fab_nombre;
				$equipos[$contador]['propiedad']	=	$registro->ot_equi_propiedad;
				$equipos[$contador]['estado']		=	$registro->ot_equi_estado;
				
				if($equipos[$contador]['propiedad'] == 0)
				{
					$propiedad	=	'X';
					$XP 			=	197.4;
				}
				else
				{
					$propiedad	=	'X';
					$XP 			=	180.3;
				}

				if($equipos[$contador]['estado'] == 2)
				{
					$estado 	= 	'Disponible';
				}
				else
				{
					$estado 	= 	'En uso';	
				}

				$pdf->SetXY(20,$Yeq);
				$pdf->Cell(0,6,$equipos[$contador]['marca'] .' '. $equipos[$contador]['referencia'],0,0,'L',0);// MARCA
				$pdf->SetXY(63,$Yeq);
				$pdf->Cell(0,6,$equipos[$contador]['sn'],0,0,'L',0);// SERIAL
				$pdf->SetXY(95,$Yeq);
				$pdf->Cell(0,6,$equipos[$contador]['mac'],0,0,'L',0);// MAC
				$pdf->SetXY(126,$Yeq);
				$pdf->Cell(0,6,$estado,0,0,'L',0);// ESTADO
				$pdf->SetXY(153,$Yeq);
				$pdf->Cell(0,6,$equipos[$contador]['tipo'],0,0,'L',0);// TIPO DISPOSITIVO
				$pdf->SetXY($XP,$Yeq_p);
				$pdf->Cell(0,6,$propiedad,0,0,'L',0);// PROPIEDAD
				$Yeq 	= 	$Yeq+5;
				$Yeq_p 	= 	$Yeq_p+5.3;
			}

			$contador++;
		}
	}

		while($reg = $productos->fetch_object())
		{
			$data[$contador]	=	$reg->prod_nombre;
			$pdf->SetXY($prdX,51);
			$pdf->Cell(0,6,utf8_decode($data[$contador]),0,0,'L',0);
			$contador++;
			$prdX =	$prdX + 60;
		}
		
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetXY(43,27);
		$pdf->Cell(0,6,utf8_decode($usuario),0,0,'L',0);
		$pdf->SetXY(159,27);
		$pdf->Cell(0,6,$telefono,0,0,'L',0);
		$pdf->SetXY(46,31);
		$pdf->Cell(0,6,$tipo_docu,0,0,'L',0);
		$pdf->SetXY(127,31);
		$pdf->Cell(0,6,$doc_no,0,0,'L',0);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->SetXY(35,35);
		$pdf->Cell(0,6,utf8_decode($direccion),0,0,'L',0);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetXY(175,35);
		$pdf->Cell(0,6,utf8_decode($municipio),0,0,'L',0);
		$pdf->SetXY(75,58);
		$pdf->Cell(0,6,$servicio,0,0,'L',0);
		$pdf->SetXY($ob_x,$ob_y);
		$pdf->MultiCell(165,3.5,utf8_decode($observac).' '.utf8_decode($obser_OT).', '. utf8_decode($ultima_observacion),0,1);
		$pdf->SetXY(132,$YTEC);
		$pdf->Cell(0,6,$tec_nom,0,0,'L',0);
		$pdf->SetXY(124,$CTEC);
		$pdf->Cell(0,6,$tec_ced,0,0,'L',0);
		$pdf->Output();

	}
?>