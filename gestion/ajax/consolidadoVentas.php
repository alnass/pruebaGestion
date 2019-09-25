<?php  
// maintenance effectuee par Anderson Ferrucho
require "../modelos/ConsolidadoVentas.php";
$consolidadoVentas = new ConsolidadoVentas();

switch ($_GET['op']) {
	
	case 'anios':
		
		$registro 	= 	$consolidadoVentas->traerAnios();

		while ($reg = $registro->fetch_object()) 
		{
			if($reg->fecha != 0)
			{
				echo '<option value="'.$reg->fecha.'">'.$reg->fecha.'</option>';	
			}
		}

	break;
	case 'listar':

		// RECIBE EL VALOR DEL SEMESTRE SI ES 1 ENVIA LOS PRIMEROS 6 MESES Y EL 2 LOS ÚLTIMOS 6 MESES
		$semestre 	= 	$_GET['semestre'];
		$tipo 		= 	$_GET['tipo'];
		// SOLO RECIBE EL ÚLTIMO NÚMERO DEL AÑO
		if(empty($_REQUEST['3']))
		{
			$anio 	=	date('Y');
		}
		else
		{
			$anio 		= 	'201'.$_REQUEST['3'];
		}
		// LLAMA FUNCION QUE PROCESA EL REPORTE
		procesarReporte('gral', $semestre,$anio, $tipo);

	break;
//***** Début maintenance **** /// 
	case 'listar-int':
		// RECIBE EL VALOR DEL SEMESTRE SI ES 1 ENVIA LOS PRIMEROS 6 MESES Y EL 2 LOS ÚLTIMOS 6 MESES
		$semestre 	= 	$_GET['semestre'];
		$tipo 		= 	$_GET['tipo'];
		// SOLO RECIBE EL ÚLTIMO NÚMERO DEL AÑO
		if(empty($_REQUEST['3']))
		{
			$anio 	=	date('Y');
		}
		else
		{
			$anio 		= 	'201'.$_REQUEST['3'];
		}
		// LLAMA FUNCION QUE PROCESA EL REPORTE
		procesarReporte('int',$semestre, $anio, $tipo);

	break;
	case 'listar-tva':
		// RECIBE EL VALOR DEL SEMESTRE SI ES 1 ENVIA LOS PRIMEROS 6 MESES Y EL 2 LOS ÚLTIMOS 6 MESES
		$semestre 	= 	$_GET['semestre'];
		$tipo 		= 	$_GET['tipo'];
		// SOLO RECIBE EL ÚLTIMO NÚMERO DEL AÑO
		if(empty($_REQUEST['3']))
		{
			$anio 	=	date('Y');
		}
		else
		{
			$anio 		= 	'201'.$_REQUEST['3'];
		}
		// LLAMA FUNCION QUE PROCESA EL REPORTE
		procesarReporte('tv',$semestre, $anio, $tipo);
	break;
	case 'listar-tvd':
		// RECIBE EL VALOR DEL SEMESTRE SI ES 1 ENVIA LOS PRIMEROS 6 MESES Y EL 2 LOS ÚLTIMOS 6 MESES
		$semestre 	= 	$_GET['semestre'];
		$tipo 		= 	$_GET['tipo'];
		// SOLO RECIBE EL ÚLTIMO NÚMERO DEL AÑO
		if(empty($_REQUEST['3']))
		{
			$anio 	=	date('Y');
		}
		else
		{
			$anio 		= 	'201'.$_REQUEST['3'];
		}
		// LLAMA FUNCION QUE PROCESA EL REPORTE
		procesarReporte('tvd',$semestre, $anio, $tipo);
	
	break;
	case 'listar-otros':
		// RECIBE EL VALOR DEL SEMESTRE SI ES 1 ENVIA LOS PRIMEROS 6 MESES Y EL 2 LOS ÚLTIMOS 6 MESES
		$semestre 	= 	$_GET['semestre'];
		$tipo 		= 	$_GET['tipo'];
		// SOLO RECIBE EL ÚLTIMO NÚMERO DEL AÑO
		if(empty($_REQUEST['3']))
		{
			$anio 	=	date('Y');
		}
		else
		{
			$anio 		= 	'201'.$_REQUEST['3'];
		}
		// LLAMA FUNCION QUE PROCESA EL REPORTE
		procesarReporte('otros',$semestre, $anio, $tipo);
	
	break;
}

function procesarReporte($valor, $semestre, $anio, $tipo)
{
	$consolidadoVentas = new ConsolidadoVentas();

	if($valor == 'gral')
	{
		$column_total 	= 	'total_cobro';
	}
	else if($valor == 'tv')
	{
		$column_total 	= 	'total_tva';	
	}
	else if($valor == 'int')
	{
		$column_total 	= 	'total_int';	
	}
	else if($valor == 'tvd')
	{
		$column_total 	= 	'total_tvd';	
	}
	else if($valor == 'otros')
	{
		$column_total 	= 	'total_otros';	
	}
	// TRAEL LA CANTIDAD DE SEDES QUE ESTEN REGISTRADAS
		$respuesta 	= 	$consolidadoVentas->traerSedes();		
		// ARRAY QUE ALMACENA LOS DATOS DE RESULTADO PARA ENVIARLOS POR JSON
		$data 		= 	Array();
		// ARRAY QUE TRANSFORMA LOS DATOS PARA TOTALIZARLOS
		$cant_cont 	= 	Array();
		// ARRAY QUE ALMACENA LOS DATOS DE RESULTADO PARA TOTALIZARLOS
		$valores 	= 	Array();
		// CICLO QUE RECORRE LA CANTIDAD DE REGISTROS DE SEDES
		while ($regis = $respuesta->fetch_object()) 
		{
			// ARRAY QUE ALMACENA EL TOTAL DE CONTRATOS POR SEDE
			$sede = Array();
			// ARRAY QUE ALMACENA EL TOTAL DE 
			$t_reg = Array();
			// CONDICIONAL PARA INICIAR EN UN MES SEGUN ELECCIÓN DE SEMESTRE
			if($semestre == 1)
			{
				$mes = 1;
			}
			else
			{
				$mes = 7;
			}
			// CONTADOR PARA LOS MESES
			$contador 	= 	0;
			// CONDICIONAL PARA OMITIR LA SEDE 12(ADMINISTRACION) DE LOS REGISTROS ALMACENADOS
			if($regis->sed_id != 12)
			{
				// CICLO PARA RECORRER LOS MESES 
				while($contador <= 6)
				{
					// METODO QUE OBTIENE EL LISTADO DE REGISTROS DEL REPORTE SEGÚN LOS VALORE ENVIADOS
					$facturado 	= 	$consolidadoVentas->listarReporte($tipo, $anio, $mes, $regis->sed_id);
					// METODO QUE RECORRE LOS RESULTADOS OBTENIDOS ANTERIORMENTE
					$mes_facturado 	= 	$facturado->fetch_object();
					// REGISTRA EN EL ARRAY sede EL DATO OBTENIDO DE LA CANTIDAD DE CONTRATOS
					array_push($sede, $mes_facturado->total_cont);
					// REGISTRA EN EL ARRAY t_reg EL DATO OBTENIDO DE LOS VALORES REGISTRADOS POR CONTRATO
					array_push($t_reg, $mes_facturado->$column_total);
					$mes++;// SUMA UN VALOR AL MES
					$contador++; // SUMA UN VALOR AL CONTADOR 
				}
				// ASIGNACIÓN DE DATOS PARA EL ARRAY QUE TOTALIZARÁ LOS VALORES RECIBIDOS
				$valores[] = 	array(
							"0"=>$regis->sed_nombre,
							"1"=>$sede[0],
							"2"=>$t_reg[0],
							"3"=>$sede[1],
							"4"=>$t_reg[1],
							"5"=>$sede[2],
							"6"=>$t_reg[2],
							"7"=>$sede[3],
							"8"=>$t_reg[3],
							"9"=>$sede[4],
							"10"=>$t_reg[4],
							"11"=>$sede[5],
							"12"=>$t_reg[5]);
				// ASIGNACIÓN DE DATOS PARA EL ARRAY QUE ENVIARÁ LOS DATOS AL JSON
				$data[] = 	array(
							"0"=>$regis->sed_nombre,
							"1"=>'<strong>'.$sede[0].'</strong>',
							"2"=>"$". number_format($t_reg[0]),
							"3"=>'<strong>'.$sede[1].'</strong>',
							"4"=>"$". number_format($t_reg[1]),
							"5"=>'<strong>'.$sede[2].'</strong>',
							"6"=>"$". number_format($t_reg[2]),
							"7"=>'<strong>'.$sede[3].'</strong>',
							"8"=>"$". number_format($t_reg[3]),
							"9"=>'<strong>'.$sede[4].'</strong>',
							"10"=>"$". number_format($t_reg[4]),
							"11"=>'<strong>'.$sede[5].'</strong>',
							"12"=>"$". number_format($t_reg[5]));
			}
		}
		// FIN DEL CICLO QUE RECORRE LOS REGISTROS DE SEDES
		// VARIABLE PARA CONTAR LOS TOTALES DEL ARRAY VALORES EN SU PARTE EXTERNA
		$count_g 		= 	0;
		// CICLO PARA RECORRER Y ASIGNAR LOS DATOS QUE SERÁN TOTALIZADOS
		while ($count_g < count($valores)) 
		{	
			// VARIABLE PARA CONTAR LOS TOTALES DEL ARRAY VALORES EN SU PARTE INTERNA
			$count 	= 	1;
			// CICLO PARA RECORRER LOS DATOS INTERNOS Y ASIGNARLOS AL ARRAY FINAL DE TOTALIZACIÓN
			while ($count < count($valores[0])) 
			{
				$cant_cont[$count][$count_g] 	= 	$valores[$count_g][$count];
				$count++;
			}
			$count_g++;
		}
		// ASIGNACIÓN DE DATOS TOTALIZADOS PARA EL ARRAY QUE ENVIARÁ LOS DATOS AL JSON
		$data[] = 	array(
							"0"=>'<strong>TOTAL MES</strong>',
							"1"=>'<strong>'.array_sum($cant_cont[1]).'</strong>',
							"2"=>'<strong>$'.number_format(array_sum($cant_cont[2])).'</strong>',
							"3"=>'<strong>'.array_sum($cant_cont[3]).'</strong>',
							"4"=>'<strong>$'.number_format(array_sum($cant_cont[4])).'</strong>',
							"5"=>'<strong>'.array_sum($cant_cont[5]).'</strong>',
							"6"=>'<strong>$'.number_format(array_sum($cant_cont[6])).'</strong>',
							"7"=>'<strong>'.array_sum($cant_cont[7]).'</strong>',
							"8"=>'<strong>$'.number_format(array_sum($cant_cont[8])).'</strong>',
							"9"=>'<strong>'.array_sum($cant_cont[9]).'</strong>',
							"10"=>'<strong>$'.number_format(array_sum($cant_cont[10])).'</strong>',
							"11"=>'<strong>'.array_sum($cant_cont[11]).'</strong>',
							"12"=>'<strong>$'.number_format(array_sum($cant_cont[12])).'</strong>');
		
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
}


////// **** fin maintenance **** /// 
?>