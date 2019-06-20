<?php  
// # encoded by @Francisco Monsalve
// Activacion de almacenamiento en buffer
session_start();
// Inicio de sesion
require "../modelos/CuadreCaja.php";
$cuadreCaja = new CuadreCaja();

// $sal_cuenta     = isset($_POST['sal_cuenta'])? limpiarCadena($_POST['sal_cuenta']):"";
$sal_tipo_sal_id= isset($_POST['tipo_salida'])? limpiarCadena($_POST['tipo_salida']):"";
$sal_num_doc	= isset($_POST['no_doc'])? limpiarCadena($_POST['no_doc']):"";
$sal_descripcion= isset($_POST['descripcion'])? limpiarCadena($_POST['descripcion']):"";
$sal_valor      = isset($_POST['valor'])? limpiarCadena($_POST['valor']):"";
$sal_usuario_id = $_SESSION['usu_id'];
$sal_sede_id   	= $_SESSION['usu_sede_id'];
// $fecha_inicio = date('Y-m-d');
// $fecha_fin = date('Y-m-d');
$fecha_inicio 	= $_REQUEST['fecha_inicio'];
$fecha_fin 		= $fecha_inicio;

switch ($_GET['op']) {
	case 'listar':

		$respuesta = $cuadreCaja->listar($fecha_inicio, $fecha_fin, $sal_sede_id);
		$data = Array();
		while ($reg = $respuesta->fetch_object()) {

			if($reg->sal_id > 1244)
			{
				if($reg->tip_sal_id  == 1)
				{
					$nomID 		= 	'arrdmto_id';
					$nomtabla 	= 	'consecutivoarrendamiento';
					$dato1  	= 	'arrdmto_salida_id';
					$cnslt_id 	= 	$cuadreCaja->mostrarID($nomtabla,$dato1, $reg->sal_id);
					$id_doc 	= 	$cnslt_id[$nomID];
				}
				else if($reg->tip_sal_id == 2)
				{
					$nomID 		= 	'adcinst_id';
					$nomtabla 	= 	'consecutivoadecuacionesinstalaciones';
					$dato1  	= 	'adcinst_salida_id';
					$cnslt_id 	= 	$cuadreCaja->mostrarID($nomtabla,$dato1, $reg->sal_id);
					$id_doc 	= 	$cnslt_id[$nomID];
				}
				else if($reg->tip_sal_id == 6)
				{
					$nomID 		= 	'honora_id';
					$nomtabla 	= 	'consecutivohonorarios';
					$dato1  	= 	'honora_salida_id';
					$cnslt_id 	= 	$cuadreCaja->mostrarID($nomtabla,$dato1, $reg->sal_id );
					$id_doc 	= 	$cnslt_id[$nomID];
				}
				else if($reg->tip_sal_id == 7)
				{
					$nomID 		= 	'mantmto_id';
					$nomtabla 	= 	'consecutivomantenimiento';
					$dato1  	= 	'mantmto_salida_id';
					$cnslt_id 	= 	$cuadreCaja->mostrarID($nomtabla,$dato1, $reg->sal_id);
					$id_doc 	= 	$cnslt_id[$nomID];
				}
				else if($reg->tip_sal_id == 8)
				{
					$nomID 		= 	'recog_id';
					$nomtabla 	= 	'consecutivorecogida';
					$dato1  	= 	'recog_salida_id';
					$cnslt_id 	= 	$cuadreCaja->mostrarID($nomtabla,$dato1, $reg->sal_id);
					$id_doc 	= 	$cnslt_id[$nomID];
				}
				else if($reg->tip_sal_id == 10)
				{
					$nomID 		= 	'viatic_id';
					$nomtabla 	= 	'consecutivoviaticos';
					$dato1  	= 	'viatic_salida_id';
					$cnslt_id 	= 	$cuadreCaja->mostrarID($nomtabla,$dato1, $reg->sal_id);
					$id_doc 	= 	$cnslt_id[$nomID];
				}
				else if($reg->tip_sal_id == 13)
				{
					$nomID 		= 	'devol_id';
					$nomtabla 	= 	'consecutivodevolucion';
					$dato1  	= 	'devol_salida_id';
					$cnslt_id 	= 	$cuadreCaja->mostrarID($nomtabla,$dato1, $reg->sal_id);
					$id_doc 	= 	$cnslt_id[$nomID];
				}
				else if($reg->tip_sal_id == 12)
				{
					$nomID 		= 	'insum_id';
					$nomtabla 	= 	'consecutivoinsumos';
					$dato1  	= 	'insum_salida_id';
					$cnslt_id 	= 	$cuadreCaja->mostrarID($nomtabla,$dato1, $reg->sal_id);
					$id_doc 	= 	$cnslt_id[$nomID];
				}
				else if($reg->tip_sal_id == 14)
				{
					$nomID 		= 	'otro_id';
					$nomtabla 	= 	'consecutivootro';
					$dato1  	= 	'otro_salida_id';
					$cnslt_id 	= 	$cuadreCaja->mostrarID($nomtabla,$dato1, $reg->sal_id);
					$id_doc 	= 	$cnslt_id[$nomID];
				}
				else
				{
					$id_doc 	=	$reg->sal_num_doc;
				}
			}
			else
			{
				$id_doc 	=	$reg->sal_num_doc;
			}

			$data[] = array(
				"0"=>$reg->sal_id,
				"1"=>$reg->sal_fecha_hora,
				"2"=>$reg->tip_sal_nombre,
				"3"=>$id_doc,
				"4"=>$reg->sal_descripcion,
				"5"=>'$'.number_format($reg->sal_valor),
				"6"=>$reg->usu_nombre." ".$reg->usu_apellido,
				"7"=>$reg->sed_nombre,
				"8"=>'<a href="../files/soportes/salidas/'.$reg->sal_evidencia.'" target="_blank"><img src="../files/soportes/salidas/'.$reg->sal_evidencia.'" alt="" style="width: 70px; height: 50px;"></a>'
			);
		}
		$results = array(
			// Informacion para el datatable
			"sEcho"=>1,
			// Envio el total de los regstros al datatable
			"iTotalRecords"=>count($data),
			// Envio del total de registros a visualizar
			"iTotalDisplayRecords"=>count($data),
			//Envio de los valores resultantes
			"aaData"=>$data);
		echo json_encode($results);
		break;
	case 'guardar':
		$respuesta = $cuadreCaja->insertarSalida(
			$sal_tipo_sal_id,
			$sal_num_doc,
			$sal_descripcion,
			$sal_valor,
			$sal_usuario_id,
			$sal_sede_id
		);
		echo $respuesta?"Registro Exitoso":"No ha sido posible realizar el registr";
		break;
	case 'selectTipoSalida':
		$respuesta = $cuadreCaja->selectTipoSalida();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->tip_sal_id.'>'.$reg->tip_sal_nombre.'</option>';
		}
		
		break;
	case 'totalSalidasDia':
		$respuesta = $cuadreCaja->totalSalidasDia($fecha_inicio, $fecha_fin, $sal_sede_id);
		echo json_encode($respuesta);
		break;
	case 'efectivoDia':

		$respuesta = $cuadreCaja->efectivoDia($fecha_inicio, $fecha_fin, $sal_sede_id);
		echo json_encode($respuesta);
		break;
	case 'saldoDia':
		$efectivoDia = $cuadreCaja->efectivoDia($fecha_inicio, $fecha_fin, $sal_sede_id);
		$salidaDia   = $cuadreCaja->totalSalidasDia($fecha_inicio, $fecha_fin, $sal_sede_id);
		$saldo = $efectivoDia['efectivo']-$salidaDia['totalDia'];
		echo json_encode($saldo);
		break;
	case 'efecGeneral':
		$totalGeneralIngreso = $cuadreCaja->totalGeneralIngreso($sal_sede_id);
		$totalGeneralSalida =$cuadreCaja->totalGeneralSalida($sal_sede_id);
		$saldoGeneral = $totalGeneralIngreso['efectivoGeneral'] - $totalGeneralSalida['salidaGeneral'];
		echo json_encode($saldoGeneral);
		break;
	case 'selectSede':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/Sede.php';
		// Se crea un nuevo objeto de la clase requerida
		$sede = new Sede();

		$respuesta = $sede->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->sed_id.'>'.$reg->sed_nombre.'</option>';
		}
		break;
}
?>