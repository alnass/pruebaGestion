<?php 

$contrato_id_get = $_GET['cont_id'];

// Requerimiento de la lireria fpdf
require "../fpdf181/fpdf.php";
require "../modelos/Contrato.php";

$contrato = new Contrato();

$respuesta = $contrato->mostrar($contrato_id_get);
$res = $respuesta->fetch_object();

$v_nombre 			= $res->per_nombre;
$v_apellido 		= $res->per_apellido;
$v_documento 		= $res->per_num_documento;
$v_telefono 		= $res->per_telefono_1;
$v_correo 			= $res->per_correo_personal;
$v_dir_persona 		= $res->per_direccion;
$v_ciudad 			= $res->ciu_nombre;
$v_departamento 	= $res->ciu_departamento;
$v_id_contrato		= $res->cont_id;
$v_no_contrato		= $res->cont_no_contrato;
$v_estrato  		= $res->cont_estrato;
$v_dir_servicio 	= $res->cont_direccion_serv;
$v_barrio_serv		= $res->cont_barrio;
$v_min_mensual 		= $res->cont_minimo_mensual;
$v_fecha_vigen 		= $res->cont_vigencia_a_partir;
if($res->cont_renovacion_auto) {$v_renovacion = "X";}else{$v_renovacion = "---";}
if($res->cont_internet){$v_intenet = "X";}else{$v_intenet = "---";}
if($res->cont_tv_analogica){$v_tv_analoga = "X";}else{$v_tv_analoga = "---";}
if($res->cont_tv_digital){$v_tv_digital = "X";}else{$v_tv_digital = "---";}
if($res->cont_adicional){$v_adicional = $res->cont_adicional;}else{$v_adicional = "Ninguno";}
$v_fecha_activ 		= $res->cont_fecha_activacion;
$v_basico_mes 		= $res->cont_valor_basico_mes;
$v_total_mes 		= $res->cont_valor_total_mes;
$v_conexion 		= $res->cont_cargo_conexion;
$v_diferido 		= $res->cont_valor_diferido;
$v_fecha_ini_perm 	= $res->cont_fecha_ini_perm;
$v_fecha_fin_perm 	= $res->cont_fecha_fin_perm;
$v_reconexion 		= $res->cont_costo_reconexion;
$valor_mes_conexion = ($v_conexion-$v_diferido)/12;
if($res->cont_permanencia){
	$v_permanencia = "X";
	$v_diferido = number_format($v_diferido);
}else{
	//$v_permanencia = "X";
	$v_permanencia = "--";
	$v_diferido = "---------";
	$v_fecha_ini_perm = "-- / -- / ----";
	$v_fecha_fin_perm = "-- / -- / ----";
	$valor_mes_conexion = 0;

}

$pdf  = new FPDF();

$no_contrat_x = 158;
$no_contrat_y = 23.5;

// DATOS DEL CABEZOTE 
$nombre_x = 52; // >
$nombre_y = 31; // v
$ident_x  =	174;
$ident_y  = 31;
$telef_x = 29;
$telef_y = 38;
$ciudad_x = 75;
$ciudad_y = 38;
$depto_x  = 153;
$depto_y  = 38;
$correo_x = 47;
$correo_y =	44;
$estrato_x=	198;
$estrato_y= 44;
$dirsus_x = 50;
$dirsus_y = 50;
$dirser_x = 57;
$dirser_y = 57;

// PRIMERA HOJA
$minmensual_x 	= 60; // >
$minmensual_y 	= 75; // v
$fechavigen_x	= 15;
$fechavigen_y	= 84;
$renova_x		= 95;
$renova_y		= 93;
$internet_x		= 21;
$internet_y		= 116;
$analoga_x		= 59;
$analoga_y		= 116;
$digital_x		= 92;
$digital_y		= 116;
$adicional_x	= 45;
$adicional_y	= 120;
$fechaactiv_x	= 70;
$fechaactiv_y	= 129;
$basicomes_x	= 75;
$basicomes_y	= 248;
$totalpag_x		= 75;
$totalpag_y		= 257;

// SEGUNDA HOJA
$permanencia_x	= 97;  // >
$permanencia_y	= 153; // v
$valconex_x		= 83;
$valconex_y		= 184;
$diferido_x		= 83;
$diferido_y		= 193;
$fechainiperm_x	= 83;
$fechainiperm_y	= 199;
$fechafinperm_x = 83;
$fechafinperm_y = 205;
$mes1_x = 13;
$mes1_y = 232;
$mes2_x = 37;
$mes2_y = 232;
$mes3_x = 60;
$mes3_y = 232;
$mes4_x = 84;
$mes4_y = 232;
$mes5_x = 13;
$mes5_y = 242;
$mes6_x = 37;
$mes6_y = 242;
$mes7_x = 60;
$mes7_y = 242;
$mes8_x = 84;
$mes8_y = 242;
$mes9_x = 13;
$mes9_y = 252;
$mes10_x = 37;
$mes10_y = 252;
$mes11_x = 60;
$mes11_y = 252;
$mes12_x = 84;
$mes12_y = 252;
$reconex_x = 57;
$reconex_y = 320;



// Funcion para agergar pagina 
$pdf->AddPage('P','Legal'); // valor predeterminado tamaño carta
// Parametros AddPage('Orietacion','tamaño','Rotacion')
// Orientation
// 	Orientación de página. Los valores posibles son (indiferente a mayúsculas):
// 		P o Portrait (normal)
// 		L o Landscape (apaisado)
// El valor por defecto el mismo que que se ha pasado al constructor.

// Size
// 	Formato de página. Puede ser uno de los siguientes valores (indiferente a mayúsculas):
// 		A3
// 		A4
// 		A5
// 		Letter
// 		Legal
// o un array conteniendo el ancho y el alto (en unidades definidas por el usuario).
// El valor por defecto es el que fue pasado al constructor.

// Rotation
// 	Ángulo por el cual rotar la página. Debe ser un múltiplo de 90; valores positivos rotan la página en el sentido de las agujas del reloj. El valor por defecto es 0.

// Adicionar el tipo de letra 
$pdf->SetFont('Arial','','10'); // Parametros ('Familia','Estilo','Tamaño')

// Poner imagen e la hoja activa 
$pdf->Image('contratoImg/contrato_unico_form3.jpg',0,0,215);
// Parametros
// Image('file','x','y','w','h',)

// file
// 	Nombre del archivo que contiene la imagen.

// x
// 	Abscisa de la esquina superior izquierda. Si no se especifica o es igual a null, se utilizará la abscisa actual.

// y
// 	Ordenada de la esquina superior izquierda. Si no se especifica o es igual a null, se utilizará la ordenada actual, además, un salto de página es invocado primero si es necesario (en caso de que esté habilitado el salto de página automático) y, después de la llamada, la ordenada actual se mueve a la parte inferior de la imagen.

// w
//	 Ancho de la imagen en la página. Existen tres posibilidades:
// 		Si el valor es positivo, éste será el ancho en la unidad de medida definida por el usuario.
// 		Si el valor es negativo, el valor absoluto será la resolución horizontal en ppp.
// 		Si no se especifica o es cero, se calcula automáticamente
// h
// 	Alto de la imagen en la página. Existen tres posibilidades:
// 		Si el valor es positivo, éste será la altura en la unidad de medida definida por el usuario.
// 		Si el valor es negativo, el valor absoluto será la resolución vertical en ppp.
// 		Si no se especifica o es cero, se calcula automáticamente

// Los contenidos del pdf se cargan mediante celdas o multiceldas
// Implemetacion de los margenes izquierdo(x) y superior(y) por defecto 10pt
$pdf->SetXY($nombre_x, $nombre_y); // Solo aplica a la celda siguiente

// Adicion  de celdas
$pdf->Cell(0,4, $v_nombre." ".$v_apellido ,0,1);
// $pdf->Cell(0,4,'Perro cochino',1,2,'C');
// Parámetros Ceel('w','h','txt','border','ln','align','fill','link')
// w
// 	Ancho de Celda. Si es 0, la celda se extiende hasta la márgen derecha.

// h
// 	Alto de celda. Valor por defecto: 0.

// txt
// 	cadena a ser impresa. Valor por defecto: cadena vacia.

// border
// 	Indica si los bordes deben se dibujados alrededor de la celda. El valor puede ser un número:
// 		0: sin borde
// 		1: marco
// 	o una cadena que contenga una o una combinación de los siguientes caracteres (en cualquier orden):
// 		L: izquierda
// 		T: superior
// 		R: derecha
// 		B: inferior
// 		Valor por defecto: 0.

// ln
// 	Indica donde la posición actual debería ir antes de invocar. Los valores posibles son:
// 		0: a la derecha
// 		1: al comienzo de la siguiente línea
// 		2: debajo
// 		Poner 1 es equivalente a poner 0 y llamar justo despues Ln(). Valor por defecto: 0.

// align
// 	Permite centrar o alinear el texto. Los posibles valores son:
// 		L o una cadena vacia: alineación izquierda (valor por defecto)
// 		C: centro
// 		R: alineación derecha

// fill
// 	Indica si elfondo de la celda debe ser dibujada (true) o transparente (false). Valor por defecto: false.

// link
// 	URL o identificador retornado por AddLink().
// NUMERO DE CONTRATO
$pdf->SetXY($no_contrat_x, $no_contrat_y); 
$pdf->Cell(0,4,$v_no_contrato.'-'.$v_id_contrato,0,1);
// CABEZOTE
// IDENTIFICACION 
$pdf->SetXY($ident_x, $ident_y); 
$pdf->Cell(0,4,$v_documento,0,1);
// TELEFONO
$pdf->SetXY($telef_x, $telef_y); 
$pdf->Cell(0,4,$v_telefono,0,1);
// CIUDAD
$pdf->SetXY($ciudad_x, $ciudad_y); 
$pdf->Cell(0,4,$v_ciudad,0,1);
// DEPARTAMENTO
$pdf->SetXY($depto_x, $depto_y); 
$pdf->Cell(0,4,$v_departamento,0,1);
// CORREO
$pdf->SetXY($correo_x, $correo_y); 
$pdf->Cell(0,4,$v_correo,0,1);
// ESTRATO
$pdf->SetXY($estrato_x, $estrato_y); 
$pdf->Cell(0,4,$v_estrato,0,1);
// DIRECCION SUSCRIPTOR
$pdf->SetXY($dirsus_x, $dirsus_y); 
$pdf->Cell(0,4,$v_dir_servicio." - ".$v_barrio_serv,0,1);
// DIRECCION SERV
$pdf->SetXY($dirser_x, $dirser_y); 
$pdf->Cell(0,4,$v_dir_persona,0,1);

// PRIMERA PAGINA
// MINIMO MENSUAL 
$pdf->SetXY($minmensual_x, $minmensual_y); 
$pdf->Cell(0,4,number_format($v_min_mensual),0,1);
// FECHA DE INICIO DE VIGENCIA 
$pdf->SetXY($fechavigen_x, $fechavigen_y); 
$pdf->Cell(0,4,$v_fecha_vigen,0,1);
// RENOVACION AUTOMATICA 
$pdf->SetXY($renova_x, $renova_y); 
$pdf->Cell(0,4,$v_renovacion,0,1);
// INTERNET 
$pdf->SetXY($internet_x, $internet_y); 
$pdf->Cell(0,4,$v_intenet,0,1);
// TELEVISION ANALOGA 
$pdf->SetXY($analoga_x, $analoga_y); 
$pdf->Cell(0,4,$v_tv_analoga,0,1);
// TELEVISIO DIGITAL 
$pdf->SetXY($digital_x, $digital_y); 
$pdf->Cell(0,4,$v_tv_digital,0,1);
// ADICIONAL  
$pdf->SetXY($adicional_x, $adicional_y); 
$pdf->Cell(0,4,$v_adicional,0,1);
// FECHA DE ACTIVACION  
$pdf->SetXY($fechaactiv_x, $fechaactiv_y); 
$pdf->Cell(0,4,$v_fecha_activ,0,1);

// PRODUCTOS 
$productos 	 = 	$contrato->productos($contrato_id_get);

$prod_can_x  = 	10;
$prod_can_y  = 	149;
$prod_nom_x  = 	21;
$prod_nom_y  = 	149;
$prod_val_x  = 	85;
$prod_val_y  = 	149;
$cant_prod 	 =	0;
$descuento 	 =	0;

while ($pro = $productos->fetch_object()) 
{
	$cant_prod++;
	// PRODUCTO CANTIDAD 
	$pdf->SetXY($prod_can_x, $prod_can_y); 
	$pdf->Cell(10,6,$pro->cont_prod_id,1,1);
	// PRODUCTO NOMBRE 
	$pdf->SetXY($prod_nom_x, $prod_nom_y); 
	$pdf->Cell(64,6,utf8_decode($pro->prod_nombre),1,1);
	// PRODUCTO VALOR
	$pdf->SetXY($prod_val_x, $prod_val_y); 
	$pdf->Cell(20,6,'$'.number_format($pro->prod_valor),1,1);
	
	$prod_can_y += 10;
	$prod_nom_y += 10;
	$prod_val_y += 10;

	$descuento 	= 	$descuento+$pro->prod_descuento_x_combo;
}

if($res->cont_tv_analogica && $res->cont_internet)
{
	$pdf->SetXY($prod_can_x, $prod_can_y); 
	$pdf->Cell(10,6,'',1,1);

	$pdf->SetXY($prod_nom_x, $prod_nom_y); 
	$pdf->Cell(64,6,'Descuento por combo',1,1);

	$pdf->SetXY($prod_val_x, $prod_val_y); 
	$pdf->Cell(20,6,'$'. number_format($descuento),1,1);
}




// $pdf->SetXY(10, 159); 
// $pdf->Cell(75,6,$v_fecha_activ,1,1);

// $pdf->SetXY(85, 159); 
// $pdf->Cell(20,6,'$ 120.000',1,1);





// BASICO MENSUAL 
$pdf->SetXY($basicomes_x, $basicomes_y); 
$pdf->Cell(0,4,number_format($v_basico_mes),0,1);
// TOTAL A PAGAR  
$pdf->SetXY($totalpag_x, $totalpag_y); 
$pdf->Cell(0,4,number_format($v_total_mes),0,1);


$pdf->AddPage('P','Legal'); // valor predeterminado tamaño carta
$pdf->Image('contratoImg/contrato_unico_form4.jpg',0,0,215);

// SEGUNDA PAGINA
// PERMANENCIA
$pdf->SetXY($permanencia_x, $permanencia_y); 
$pdf->Cell(0,4,$v_permanencia,0,1);
// VALOR DE CONEXION
$pdf->SetXY($valconex_x, $valconex_y); 
$pdf->Cell(0,4,number_format($v_conexion),0,1);
// DESCINTANDO DIFERIDO
$pdf->SetXY($diferido_x, $diferido_y); 
$pdf->Cell(0,4,$v_diferido,0,1);
// FECHA DE INICIO DE PERMANENCIA 
$pdf->SetXY($fechainiperm_x, $fechainiperm_y); 
$pdf->Cell(0,4,$v_fecha_ini_perm,0,1);
// FECHA FIN DE PERMANENCIA
$pdf->SetXY($fechafinperm_x, $fechafinperm_y); 
$pdf->Cell(0,4,$v_fecha_fin_perm,0,1);



// MES 1
$pdf->SetXY($mes12_x, $mes12_y); 
$pdf->Cell(0,4,number_format($valor_mes_conexion) ,0,1);
// MES 2  
$pdf->SetXY($mes11_x, $mes11_y); 
$pdf->Cell(0,4,number_format($valor_mes_conexion *2),0,1);
// MES 3  
$pdf->SetXY($mes10_x, $mes10_y); 
$pdf->Cell(0,4,number_format($valor_mes_conexion *3),0,1);
// MES 4  
$pdf->SetXY($mes9_x, $mes9_y); 
$pdf->Cell(0,4,number_format($valor_mes_conexion *4),0,1);
// MES 5  
$pdf->SetXY($mes8_x, $mes8_y); 
$pdf->Cell(0,4,number_format($valor_mes_conexion *5),0,1);
// MES 6  
$pdf->SetXY($mes7_x, $mes7_y); 
$pdf->Cell(0,4,number_format($valor_mes_conexion *6),0,1);
// MES 7  
$pdf->SetXY($mes6_x, $mes6_y); 
$pdf->Cell(0,4,number_format($valor_mes_conexion *7),0,1);
// MES 8  
$pdf->SetXY($mes5_x, $mes5_y); 
$pdf->Cell(0,4,number_format($valor_mes_conexion *8),0,1);
// MES 9  
$pdf->SetXY($mes4_x, $mes4_y); 
$pdf->Cell(0,4,number_format($valor_mes_conexion *9),0,1);
// MES 10  
$pdf->SetXY($mes3_x, $mes3_y); 
$pdf->Cell(0,4,number_format($valor_mes_conexion *10),0,1);
// MES 11  
$pdf->SetXY($mes2_x, $mes2_y); 
$pdf->Cell(0,4,number_format($valor_mes_conexion *11),0,1);
// MES 12  
$pdf->SetXY($mes1_x, $mes1_y); 
$pdf->Cell(0,4,number_format($valor_mes_conexion *12),0,1);
// VALOR DE RECONEXION
$pdf->SetXY($reconex_x, $reconex_y); 
$pdf->Cell(0,4,number_format($v_reconexion),0,1);


// Funcio para mostrar el pdf
$pdf->Output();


?>