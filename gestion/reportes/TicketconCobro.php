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


$usu_nombre =   $_SESSION['usu_nombre'];
$usu_apellido = $_SESSION['usu_apellido'];
$usu_sede =     $_SESSION['usu_sede_id'];
// Se incluye la clase recaudos
require "../fpdf181/fpdf.php";
require_once "../modelos/Recaudo.php";

// Insatnciamieto de la clase con el objeto recaudos
$recaudo = new Recaudo();

// Obtener los valores de la consulta en Recaudo
$respuesta = $recaudo->cabeceraticket();

// Recorrer todos los valores obtenidos 
$reg = $respuesta->fetch_object();

// Obteber los valores de la ultima fila segun el No de transaccion
$ultimatrans = $recaudo->ultimatransaccion($reg->est_cta_no_transaccion);
// Recorrer los valores de la ultima transaccion
$ut = $ultimatrans->fetch_object();

// Obtener el ultimo cargo 
$ultimocargo = $recaudo->ultimohaber($reg->cont_id);
// Recorrer el valor de ultimo cargo
$uc = $ultimocargo->fetch_object();
// Variables con datos de la empresa
$empresa    ="GlobalNet S.A.";
$nit        ="830 108 200 - 3";
$direccion  =utf8_decode("Calle 31a No 16a - 24 Bogotá");
$telefono   ="+ 57(1) 432 5620";
$correo     ="servicioalcliente@globalplay.tv";



$empresa_x          =     0; 
$empresa_y          =     0;
$nit_x              =     0;
$nit_y              =     3.5;
$direccion_x        =     0;
$direccion_y        =     7;
$telefono_x         =     0;
$telefono_y         =     10.5;
$correo_x           =     0;
$correo_y           =     14;
$linea1_x           =     0;
$linea1_y           =     19;
$norecibo_x         =     0;
$norecibo_y         =     21;
$fecha_x            =     0;
$fecha_y            =     24.5;
$contrato_x         =     0;
$contrato_y         =     28;
$suscriptor_x       =     0;
$suscriptor_y       =     31.5;
$sus_nombre_x       =     0;
$sus_nombre_y       =     35;
$documento_x        =     0;
$documento_y        =     38.5;
$concepto_x         =     0;
$concepto_y         =     42;
$ult_cargo_x        =     0;
$ult_cargo_y        =     53;
$valor_ult_carg_x   =     49.5;
$valor_ult_carg_y   =     53;
$linea2_x           =     0;
$linea2_y           =     47;
$total_pag_concp_x  =     0;
$total_pag_concp_y  =     $ult_cargo_y + 3.5;
$total_pag_val_x    =     49.5;
$total_pag_val_y    =     $ult_cargo_y + 3.5;

$pdf = new FPDF('P','mm', array(73, 200));

$pdf->AddPage();
$pdf->SetFont('Helvetica','','9');

$pdf->SetXY($empresa_x, $empresa_y);
$pdf->Cell(0,3,$empresa,0,1,'C');

$pdf->SetXY($nit_x, $nit_y);
$pdf->Cell(0,3,$nit,0,1,'C');

$pdf->SetXY($direccion_x, $direccion_y);
$pdf->Cell(0,3,$direccion,0,1,'C');

$pdf->SetXY($telefono_x, $telefono_y);
$pdf->Cell(0,3,$telefono,0,1,'C');

$pdf->SetXY($correo_x, $correo_y);
$pdf->Cell(0,3,$correo,0,1,'C');

$pdf->SetXY($linea1_x, $linea1_y);
$pdf->Cell(0,0,'',1,1,'C');

$pdf->SetXY($norecibo_x, $norecibo_y);
$pdf->Cell(0,3,'Recibo de CAJA No - '.$reg->est_cta_no_transaccion,0,1,'R');

$pdf->SetXY($fecha_x, $fecha_y);
$pdf->Cell(0,3,'Fecha y Hora: '.$reg->est_cta_fecha_transacc,0,1,'L');

$pdf->SetXY($contrato_x, $contrato_y);
$pdf->Cell(0,3,'Contrato No: '.$reg->cont_no_contrato."-".$reg->cont_id,0,1,'L');

$pdf->SetXY($suscriptor_x, $suscriptor_y);
$pdf->Cell(0,3,'Suscriptor: ',0,1,'L');

$pdf->SetXY($sus_nombre_x, $sus_nombre_y);
$pdf->Cell(0,3,$reg->per_nombre.' '.$reg->per_apellido,0,1,'L');

$pdf->SetXY($documento_x, $documento_y);
$pdf->Cell(0,3,'No Documento: '.$reg->per_num_documento,0,1,'L');

$pdf->SetXY($concepto_x, $concepto_y);
$pdf->Cell(0,3,'Concepto: '.$uc->con_tran_nombre,0,1,'L');

$pdf->SetXY($linea2_x, $linea2_y);
$pdf->Cell(0,0,'',1,1,'C');



$rpta_cuerpo = $recaudo->cuerpoticket($reg->est_cta_no_transaccion);
  $total = 0;

while ($regd =  $rpta_cuerpo->fetch_object()) 
{

    $concepto = "";
    if ($regd->est_cta_observacion) {
      $concepto = $regd->est_cta_observacion;
    }else{
      $concepto = $regd->con_tran_nombre;
    }
      

  $sald_ant_nom_x   =   0;
  $sald_ant_nom_y   =   49;
  $sald_ant_val_x   =   0;
  $sald_ant_val_y   =   49;
  $trans_nom_x      =   0;
  $trans_nom_y      =   $total_pag_concp_y + 3.5;
  $trans_val_x      =   80;
  $trans_val_y      =   $total_pag_concp_y + 3.5;
  $linea3_x         =   0;
  $linea3_y         =   $trans_nom_y + 1.5;
  $total_nom_x      =   0; 
  $total_nom_y      =   $linea3_y + 0.5;
  $total_val_x      =   0;
  $total_val_y      =   $linea3_y + 0.5;
  // $sald_ant_nom_x = 0;
  // $sald_ant_nom_y = $total_nom_y + 3.5;
  // $sald_ant_val_x = 0;
  // $sald_ant_val_y = $total_nom_y + 3.5;
  $sald_fin_nom_x   =   0;
  $sald_fin_nom_y   =   $linea3_y + 3.5;
  $sald_fin_val_x   =   0;
  $sald_fin_val_y   =   $linea3_y + 3.5;
  $atendido_x       =   0;
  $atendido_y       =   $sald_fin_val_y + 6.5;
  $atendido_por_x   =   0;
  $atendido_por_y   =   $sald_fin_val_y + 9.5;
  $info1_x          =   0;
  $info1_y          =   $sald_fin_val_y + 15.5;
  $gracias_x        =   0;
  $gracias_y        =   $info1_y + 10;

    
  $pdf->SetXY($trans_nom_x, $trans_nom_y);
  $pdf->Cell(0,3,utf8_decode($concepto),0,1,'L');
  // $pgr = $regd->est_cta_haber - $regd->est_cta_debe ;
  $pgr = $regd->est_cta_debe;
  $pdf->SetXY($trans_val_x, $trans_val_y);
  $pdf->Cell(0,3,'$'.number_format($pgr),0,1,'R');
  $trans_nom_y += 3.5;
  $trans_val_y += 3.5;
  $total += $regd->est_cta_debe;
}

  $trans_val_y    += 3.5;
  $linea3_y       += 3.5;
  $trans_nom_y    += 3.5;
  $total_val_y    += 3.5;
  $total_nom_y    += 3.5;
  // $sald_ant_nom_y 3.5= 5;
  // $sald_ant_val_y 3.5= 5;
  $sald_fin_nom_y += 3.5;
  $sald_fin_val_y += 3.5;
  $atendido_y     += 3.5;
  $atendido_por_y += 3.5;
  $info1_y        += 3.5;
  $gracias_y      += 3.5;

$saldo_anterior = $ut->est_cta_saldo_anterior - $uc->est_cta_haber;

$pdf->SetXY($sald_ant_nom_x, $sald_ant_nom_y);
$pdf->Cell(0,3,'SALDO ANTERIOR: ',0,1,'L');

$pdf->SetXY($sald_ant_val_x, $sald_ant_val_y);
$pdf->Cell(0,3,'$'.number_format($saldo_anterior),0,1,'R');

$pdf->SetXY($ult_cargo_x, $ult_cargo_y);
$pdf->Cell(0,3,utf8_decode('COBRO '. $uc->est_cta_observacion),0,1,'L');

$pdf->SetXY($valor_ult_carg_x, $valor_ult_carg_y);
$pdf->Cell(0,3,'$'. number_format($uc->est_cta_haber),0,1,'L');

$pdf->SetXY($total_pag_concp_x, $total_pag_concp_y);
$pdf->Cell(0,3,utf8_decode('TOTAL A PAGAR '),0,1,'L');

$pdf->SetXY($total_pag_val_x , $total_pag_val_y);
$pdf->Cell(0,3,'$'. number_format($ut->est_cta_saldo_anterior),0,1,'L');

$pdf->SetXY($linea3_x, $linea3_y);
$pdf->Cell(0,0,'',1,1,'C');

$pdf->SetXY($total_nom_x, $total_nom_y);
$pdf->Cell(0,3,'TOTAL PAGADO: ',0,1,'L');

$pdf->SetXY($total_val_x, $total_val_y);
$pdf->Cell(0,3,'$'.number_format($total),0,1,'R');

$pdf->SetXY($sald_fin_nom_x, $sald_fin_nom_y);
$pdf->Cell(0,3,'SALDO FINAL: ',0,1,'L');

$pdf->SetXY($sald_fin_val_x, $sald_fin_val_y);
$pdf->Cell(0,3,'$'.number_format($ut->est_cta_saldo_actual),0,1,'R');

$pdf->SetXY($atendido_x, $atendido_y);
$pdf->MultiCell(0,3,'Atendido por:',0,'L');

$pdf->SetXY($atendido_por_x, $atendido_por_y);
$pdf->MultiCell(0,3,$usu_nombre.' '.$usu_apellido,0,'L');

$pdf->SetXY($info1_x, $info1_y);
$pdf->MultiCell(0,3,'Pague su servicio antes de los primeros 10 dias de cada mes para obtener el beneficion de pronto pago.',0,'C');

$pdf->SetXY($gracias_x, $gracias_y);
$pdf->Cell(0,3,'GRACIAS POR SU PAGO',0,1,'C');

// $vigilado_x = 0;
// $vigilado_y = $gracias_y + 3.5;

// $pdf->SetXY($vigilado_x, $vigilado_y);
// $pdf->Cell(0,3,'Vigilado y regulado por la ANTV',0,1,'C');

// require_once "../modelos/Sede.php";


// $sede =  new Sede();

// $resp_sede = $sede->mostrar($usu_sede);
// // $rsed = $resp_sede->fetch_object();

// $sede_nombre = $resp_sede['sed_nombre'];
// $sede_direc =  $resp_sede['sed_direccion'];

// $sedecor_x = 0;
// $sedecor_y = $vigilado_y + 5.5;

// $pdf->SetXY($sedecor_x, $sedecor_y);
// $pdf->Cell(0,3,'Sede '.$sede_nombre." ".$sede_direc,0,1,'C');


$pdf->Output();


  }else{
  
    echo "No cuenta con los permisos para generar este reporte";

  }
}
// luberar el espacio del bufer
ob_end_flush();
?>