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
$fecha_inicio = date('Y-m-d');
$fecha_fin =date('Y-m-d');


switch ($_GET['op']) {
	case 'listar':
		$respuesta = $cuadreCaja->listar($fecha_inicio, $fecha_fin, $sal_sede_id);
		$data = Array();
		while ($reg = $respuesta->fetch_object()) 
		{
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
				"7"=>$reg->sed_nombre);

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

		if($_GET['idsalida'] == 1)
		{
			$nomID 		= 	'arrdmto_id';
			$nomtabla 	= 	'consecutivoarrendamiento';
			$dato1  	= 	'arrdmto_salida_id';
		}
		else if($_GET['idsalida']== 2)
		{
			$nomID 		= 	'adcinst_id';
			$nomtabla 	= 	'consecutivoadecuacionesinstalaciones';
			$dato1  	= 	'adcinst_salida_id';
		}
		else if($_GET['idsalida']== 6)
		{
			$nomID 		= 	'honora_id';
			$nomtabla 	= 	'consecutivohonorarios';
			$dato1  	= 	'honora_salida_id';
		}
		else if($_GET['idsalida']== 7)
		{
			$nomID 		= 	'mantmto_id';
			$nomtabla 	= 	'consecutivomantenimiento';
			$dato1  	= 	'mantmto_salida_id';
		}
		else if($_GET['idsalida']== 8)
		{
			$nomID 		= 	'recog_id';
			$nomtabla 	= 	'consecutivorecogida';
			$dato1  	= 	'recog_salida_id';
		}
		else if($_GET['idsalida']== 10)
		{
			$nomID 		= 	'viatic_id';
			$nomtabla 	= 	'consecutivoviaticos';
			$dato1  	= 	'viatic_salida_id';
		}
		else if($_GET['idsalida']== 13)
		{
			$nomID 		= 	'devol_id';
			$nomtabla 	= 	'consecutivodevolucion';
			$dato1  	= 	'devol_salida_id';
		}
		else if($_GET['idsalida']== 12)
		{
			$nomID 		= 	'insum_id';
			$nomtabla 	= 	'consecutivoinsumos';
			$dato1  	= 	'insum_salida_id';
		}
		else if($_GET['idsalida']== 14)
		{
			$nomID 		= 	'otro_id';
			$nomtabla 	= 	'consecutivootro';
			$dato1  	= 	'otro_salida_id';
		}

		// Verifica la exetncion de la imagen cargada
			$ext = explode(".", $_FILES["imagen"]["name"]);
			// Valida el tipo de extencion que se cargo 
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png" || $_FILES['imagen']['type'] == "image/PNG") 
			{
				// Cambia el nombre de la imagen con un formato de tiempo para no repetirla y adhiere la extencion
				$doc_imagen = 	round(microtime(true)) . '.' . end($ext);
				// Subir el archivo a la carpeta dentro del servidor
				move_uploaded_file($_FILES["imagen"]["tmp_name"] , "../files/soportes/salidas/".$doc_imagen);
			}

		$respuesta = $cuadreCaja->insertarSalida(
			$sal_tipo_sal_id,
			$sal_num_doc,
			$sal_descripcion,
			$sal_valor,
			$sal_usuario_id,
			$sal_sede_id,
			$doc_imagen
		);

		$consecutivo = $cuadreCaja->insertarConsecutivo($nomtabla, $respuesta, $nomID, $dato1);

		if($consecutivo = true)
		{
			echo $respuesta?"Registro Exitoso":"No ha sido posible realizar el registro";
		}
		else
		{
			echo $respuesta = "No ha sido posible realizar el registro";	
		}


	break;
	case 'selectTipoSalida':
		$respuesta = $cuadreCaja->selectTipoSalida();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->tip_sal_id.'>'.$reg->tip_sal_nombre.'</option>';
		}
		
		break;
	case 'efectivoDia':
		$respuesta = $cuadreCaja->efectivoDia($fecha_inicio, $fecha_fin, $sal_sede_id);
		echo json_encode($respuesta);
		break;
	case 'totalSalidasDia':
		$respuesta = $cuadreCaja->totalSalidasDia($fecha_inicio, $fecha_fin, $sal_sede_id);
		echo json_encode($respuesta);
		break;
	case 'saldoDia':
		$efectivoDia = $cuadreCaja->efectivoDia($fecha_inicio, $fecha_fin, $sal_sede_id);
		$salidaDia   = $cuadreCaja->totalSalidasDia($fecha_inicio, $fecha_fin, $sal_sede_id);
		$saldo = $efectivoDia['efectivo']-$salidaDia['totalDia'];
		if ($saldo <= 0) {
			$saldo = 0;
		}
		echo json_encode($saldo);
		break;
	case 'efecGeneral':
		$totalGeneralIngreso = $cuadreCaja->totalGeneralIngreso($sal_sede_id);
		$totalGeneralSalida =$cuadreCaja->totalGeneralSalida($sal_sede_id);
		$saldoGeneral = $totalGeneralIngreso['efectivoGeneral'] - $totalGeneralSalida['salidaGeneral'];
		echo json_encode($saldoGeneral);
		break;

	case 'llamar_ids':

	$nomID 		= 	'';
	$nomtabla 	= 	'';

	if(isset($_GET))
	{
		if($_GET['idsalida'] == 1)
		{
			$nomID 		= 	'arrdmto_id';
			$nomtabla 	= 	'consecutivoarrendamiento';
		}
		else if($_GET['idsalida']== 2)
		{
			$nomID 		= 	'adcinst_id';
			$nomtabla 	= 	'consecutivoadecuacionesinstalaciones';
		}
		else if($_GET['idsalida']== 6)
		{
			$nomID 		= 	'honora_id';
			$nomtabla 	= 	'consecutivohonorarios';
		}
		else if($_GET['idsalida']== 7)
		{
			$nomID 		= 	'mantmto_id';
			$nomtabla 	= 	'consecutivomantenimiento';
		}
		else if($_GET['idsalida']== 8)
		{
			$nomID 		= 	'recog_id';
			$nomtabla 	= 	'consecutivorecogida';
		}
		else if($_GET['idsalida']== 10)
		{
			$nomID 		= 	'viatic_id';
			$nomtabla 	= 	'consecutivoviaticos';
		}
		else if($_GET['idsalida']== 13)
		{
			$nomID 		= 	'devol_id';
			$nomtabla 	= 	'consecutivodevolucion';
		}
		else if($_GET['idsalida']== 12)
		{
			$nomID 		= 	'insum_id';
			$nomtabla 	= 	'consecutivoinsumos';
		}
		else if($_GET['idsalida']== 14)
		{
			$nomID 		= 	'otro_id';
			$nomtabla 	= 	'consecutivootro';
		}

		$id = $cuadreCaja->seleccionarID($nomtabla, $nomID);
		echo json_encode($id[$nomID]+1);
	}

	break;

	case 'ocultar_registro_tabla':
       	$respuesta = $recaudo->ocultar_registro_tabla($est_cta_id);
    break;

	
}
?>