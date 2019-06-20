<?php  
// maintenance effectuee par Anderson Ferrucho
require "../modelos/ConsolidadoVentas.php";
require "../modelos/Sede.php";

$consolidadoVentas = new ConsolidadoVentas();

switch ($_GET['op']) {
	
	case 'listar':

		$respuesta 	= 	$consolidadoVentas->traerSedes();		
		$data = Array();

		while ($regis = $respuesta->fetch_object()) 
		{
			if($regis->sed_id != 12)
			{
				$sede = Array();
				$t_reg = Array();
				$mes 		= 	0;
				$mesCorpAli	= 	0;

				while($mes < 6)
				{
					$mes++;
					$consolidadoVentas = new ConsolidadoVentas();

					if($regis->sed_id == 14)
					{
						$mesCorpAli = 	$mes+1;
						$facturado 	= 	$consolidadoVentas->facturadoAliados($mesCorpAli, 2019);	
						$factDetlle = 	$consolidadoVentas->facturadoAliadosCorpDetalle($mesCorpAli, 2019, $regis->sed_id);	
					}
					else if($regis->sed_id == 11)
					{
						$mesCorpAli = 	$mes+1;
						$facturado 	= 	$consolidadoVentas->facturadoCorporativo($mesCorpAli, 2019);	
						$factDetlle = 	$consolidadoVentas->facturadoAliadosCorpDetalle($mesCorpAli, 2019, $regis->sed_id);	
					}
					else
					{
						$facturado 	= 	$consolidadoVentas->facturacionGeneral($mes, 2019, $regis->sed_id);
						$factDetlle	= 	$consolidadoVentas->facturacionGeneralDetalle($mes, 2019, $regis->sed_id);
					}

					array_push($sede, "$". number_format($facturado['sumatoria']));
					array_push($t_reg, $facturado['total_reg']);
					
					// echo 'Sede '. $regis->sed_nombre. ' Mes '. $mes;
					// print_r($facturado);

					while ($reg = $factDetlle->fetch_object()) 
					{
						// echo 'Sede '. $regis->sed_nombre. ' Mes '. $mes . ' Contrato '. $reg->est_cta_contrato_id . ' Mensualidad ' . $reg->est_cta_haber.'<br>';

						// // print_r($reg);
					}

				}

				if($regis->sed_id != 11 || $regis->sed_id != 14)
				{
					$data[] = 	array(
							"0"=>$regis->sed_nombre,
							"1"=>"0",
							"2"=>"$",
							"3"=>$t_reg[0],
							"4"=>$sede[0],
							"5"=>$t_reg[1],
							"6"=>$sede[1],
							"7"=>$t_reg[2],
							"8"=>$sede[2],
							"9"=>$t_reg[3],
							"10"=>$sede[3],
							"11"=>$t_reg[4],
							"12"=>$sede[4]);
				}
				else
				{
					$data[] = 	array(
							"0"=>$regis->sed_nombre,
							"1"=>$t_reg[0],
							"2"=>$sede[0],
							"3"=>$t_reg[1],
							"4"=>$sede[1],
							"5"=>$t_reg[2],
							"6"=>$sede[2],
							"7"=>$t_reg[3],
							"8"=>$sede[3],
							"9"=>$t_reg[4],
							"10"=>$sede[4],
							"11"=>$t_reg[5],
							"12"=>$sede[5]);
				}

			}

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

//***** Début maintenance **** /// 
		case 'listar-int':

			reporte('int');

		break;

		case 'listar-tva':

			reporte('tv');

		break;

		case 'listar-tvd':

			reporte('tvd');
		
		break;

		case 'listar-otros':

			reporte('otros');
		
		break;

		case 'reporte':

			reporte('otros');
		
		break;
}

// function reporte($valor)
// {
// 	$consolidadoVentas = new ConsolidadoVentas();
// 	$sedes = new Sede();
	
// 	$data 		= 	Array();
// 	$reg_sede 	= 	$sedes->listar();
// 	$respuesta	=	$consolidadoVentas->traerMes();
	
// 	$sede 		= 	Array();

// 	while ($reg_mes = $respuesta->fetch_object()) 
// 	{
// 		while($reg = $reg_sede->fetch_object())
// 		{
// 			$sedes 	= 	array($reg->sed_nombre);
// 			print_r($sedes);
// 		}
		
// 		$data[] = array("0"=>'',
// 						"1"=>$reg_mes->fecha,
// 						"2"=>'',
// 						"3"=>'',
// 						"4"=>'',
// 						"5"=>'',
// 						"6"=>'');

// 	}
	
// 	$results = array(
// 	// Informacion para el datatable
// 	"sEcho"=>1,
// 	// Envio el total de los regstros al datatable
// 	"iTotalRecords"=>count($data),
// 	// Envio del total de registros a visualizar
// 	"iTotalDisplayRecords"=>count($data),
// 	//Envio de los valores resultantes
// 	"aaData"=>$data);
// 	echo json_encode($results);			
// }
////// **** fin maintenance **** /// 
/* 	 --------------------------------------------
	|	   OJO FUNCION A UTILIZAR NO BORRAR 	 |
	 --------------------------------------------*/
function reporte($valor)
{
	// Se valida transforma a internet los valores por que el modelo 
	if($valor == 'int')
	{
		$valor 		= 	'tv';
		$reporte 	= 	'int';
	}
	else
	{
		$reporte 	= 	$valor;
	}

	$consolidadoVentas = new ConsolidadoVentas();
	// PRIMERO TRAE LOS MESES QUE ESTEN REGISTRADOS EN LA BD
	$respuesta	=	$consolidadoVentas->traerMes();

	$data 		= 	Array();
	// RECORRE LOS REGISTROS OBTENIDOS DE LOS MESES
	while($reg = $respuesta->fetch_object())
	{
		$sedes 	= 	array(	3 	=> 0,
							4 	=> 0,
							5 	=> 0,
							6 	=> 0,
							7	=> 0,
							8 	=> 0,
							9 	=> 0,
							10  => 0,
							11 	=> 0,
							12 	=> 0,
							13 	=> 0,
							14 	=> 0);

		// CREA UN ARRAY GENERAL PARA ALMACENAR LOS REGISTROS SUMADOS

		$total 	= 	array(	$valor 	=> 	0,
		 					'int'	=> 	0);

		// echo 'Se recibio ' . $valor . ' se debe reportar ' .$reporte;
		
		$contador 		= 	0;
		$contador_corp 	= 	0;
		$contadors 		= 	0;
		$contadors_corp	= 	0;
		$contarInt 		= 	0;
		$contarTV 		= 	0;
		// LLAMA EL LISTADO DE RECAUDO DE LA BASE DE DATOS
		// $est_cta 		= 	$consolidadoVentas->estadoCuentaContrato($reg->fecha);
		// $est_cta_corp 	= 	$consolidadoVentas->estadoCuentaContratoCorp($reg->fecha);
		// LLAMA EL LISTADO DE FACTURACION DE LA BASE DE DATOS
		$est_cta 		= 	$consolidadoVentas->estadoCuentaContrato($reg->fecha);
		$est_cta_corp 	= 	$consolidadoVentas->estadoCuentaContratoCorp($reg->fecha);
		$est_cta_aliad 	= 	$consolidadoVentas->estadoCuentaAliado($reg->fecha);

		// while ($est_cta_cli_aliado = $est_cta_aliad->fetch_object()) 
		// {
		// 	// BUSCA LOS PRODUCTOS DE TIPO TV QUE TENGA DEL CONTRATO
		// 	$listado 		= 	$consolidadoVentas->listarcontrato($est_cta_cli_aliado->est_cta_contrato_id);
		// 	$listado_und 	= 	$listado->fetch_object();

		// 	if($listado_und->cont_internet == 1 && $listado_und->cont_tv_analogica == 1 || $listado_und->cont_internet == 1 && $listado_und->cont_tv_digital == 1 || $listado_und->cont_tv_digital == 1 && $listado_und->cont_tv_analogica == 1)
		// 	{

		// 	}
		// 	if($valor == 'tv')
		// 	{
		// 		$reg_prod		= 	$consolidadoVentas->validarProductoTv($est_cta_cli_aliado->est_cta_contrato_id);
		// 	}
		// 	else if($valor == 'tvd')
		// 	{
		// 		$reg_prod		= 	$consolidadoVentas->validarProductoTvDG($est_cta_cli_aliado->est_cta_contrato_id);
		// 	}
		// 	else if($valor == 'otros')
		// 	{
		// 		$reg_prod		= 	$consolidadoVentas->validarProductoOtro($est_cta_cli_aliado->est_cta_contrato_id);
		// 	}
		// 	else
		// 	{
		// 		$reg_prod		= 	$consolidadoVentas->validarProductoTv($est_cta_cli_aliado->est_cta_contrato_id);	
		// 	}

		// 	$dato_prod 		= 	$reg_prod->fetch_object();

		// 	// RECORRE LOS REGISTROS DEL PRODUCTO
		// 	if(!empty($dato_prod))
		// 	{// SI NO ESTA VACIO EL REGISTRO CREA UN ARRAY PARA CALCULAR EL PORCENTAJE EQUIVALENTE DE TV CON RESPECTO AL VALOR GENERAL DEL PRODUCTO

		// 		$porcentaje 	= 	array(	$valor	=>	($dato_prod->cont_prod_precio*$dato_prod->cont_prod_cantidad) / $listado_und->cont_valor_total_mes * 100,
		// 									'int'	=>	0);
		// 		$porcentaje['int'] 	= 100 - $porcentaje[$valor];
		// 		/// OPERA EL VALOR RECAUDADO CON RESPECTO AL PORCENTAJE OBTENIDO EN LAS OPERACIONES ANTERIORES
		// 		$pago 	=	array(	$valor 	=> 	$est_cta_cli_aliado->est_cta_debe * $porcentaje[$valor] / 100,
		// 							'int' 	=> 	$est_cta_cli_aliado->est_cta_debe * $porcentaje['int'] / 100);
		// 		// SUMA EL RESULTADO A LA POSICION DEL ARRAY GENERAL CORRESPONDIENTE AL PRODUCTO
		// 		$total[$valor] 	= 	$total[$valor] + $pago[$valor];
		// 		// SUMA EL RESULTADO A LA POSICION DEL ARRAY GENERAL CORRESPONDIENTE AL PRODUCTO
		// 		$total['int']	= 	$total['int'] + $pago['int'];
		// 		$contador++;
		// 	}
		// 	// SI NO ENCUENTRA DATOS DE PRODUCTOS DE TV ASIGNA TODO EL PORCENTAJE DEL PAGO AL INTERNET
		// 	else
		// 	{
		// 		$porcentaje[$valor] = 	0;
		// 		$porcentaje['int'] 	=	100;
		// 		$pago[$valor] 		= 	0;
		// 		$pago['int'] 		= 	$est_cta_cli_aliado->est_cta_debe;
		// 		$total[$valor] 		= 	$total[$valor] + $pago[$valor];
		// 		$total['int'] 		= 	$total['int'] + $pago['int'];
		// 		$contador++;
		// 	}

		// 	$sedes[$est_cta_cli_aliado->est_cta_sede_id] =  $sedes[$est_cta_cli_aliado->est_cta_sede_id]+$pago[$reporte];

		// 	// ****** LINEAS DE CODIGO PARA REALIZAR MANTENIMIENTOS ******* //// 
		// 	// echo $sedes[6] .'<br> ';
		// 	// /// LINEA DE CONTROL DE REGISTROS	
		// 	// if($est_cta_cli_aliado->est_cta_sede_id == 6)	
		// 	// {
		// 	// 	echo $contador. ' Mes '  . $reg->fecha. '<h1> Sede '. $est_cta_cli_aliado->est_cta_sede_id. ' Contrato '. $listado_und->cont_id . '</h1> Porcentaje Tv ' .$porcentaje['tv']. '% Porcentaje Internet '.$porcentaje['int'] .'% <br> Pagó '. $est_cta_cli_aliado->est_cta_debe .' Mensualidad ' .$listado_und->cont_valor_total_mes  .' Pago tv $'.round($pago['tv']).' Pago int $'. round($pago['int']).'<br>
		// 	// 				En el mes '. $reg->fecha.' El ingreso por tv fue: '. round($total['tv']). '<br> En el mes '. $reg->fecha.'<h1> El ingreso por internet fue: '. round($total['int']). '</h1> Ingreso por sede <br>' .$sedes[$est_cta_cli_aliado->est_cta_sede_id] ;// FIN DE LA LINEA DE CONTROL DE REGISTROS	
		// 	// }
		// 	// else
		// 	// {
		// 		// echo $contador. ' Mes '  . $reg->fecha. ' Sede '. $est_cta_cli_aliado->est_cta_sede_id. ' Contrato '. $listado_und->cont_id . ' Porcentaje Tv ' .$porcentaje['tv']. '% Porcentaje Internet '.$porcentaje['int'] .'% <br> Pagó '. $est_cta_cli_aliado->est_cta_debe .' Mensualidad ' .$listado_und->cont_valor_total_mes  .' Pago tv $'.round($pago['tv']).' Pago int $'. round($pago['int']).'<br>
		// 		// 			En el mes '. $reg->fecha.' El ingreso por tv fue: '. round($total['tv']). '<br> En el mes '. $reg->fecha.'<h1> El ingreso por internet fue: '. round($total['int']). '</h1><br>';// FIN DE LA LINEA DE CONTROL DE REGISTROS	
		// 	// }
		// 	// echo $contador. ' Mes ' . $reg->fecha. ' Contrato ' .$est_cta_cli_aliado->est_cta_contrato_id . ' Pagó '.$est_cta_cli_aliado->est_cta_debe.'<br>';
		// 	// REPORTE DE FACTURACION
		// 	// echo $contador. ' Mes '  . $reg->fecha. ' Sede '. $est_cta_cli_aliado->est_cta_sede_id. ' Contrato '. $listado_und->cont_id . ' Porcentaje Tv ' .$porcentaje['tv']. '% Porcentaje Internet '.$porcentaje['int'] .'% Pagó '. $est_cta_cli_aliado->est_cta_debe .' Mensualidad ' .$listado_und->cont_valor_total_mes  .' Pago tv $'.round($pago['tv']).' Pago int $'. round($pago['int']).' Tipo de Persona ' .  $est_cta_cli_aliado->per_tipo_persona_id. '<br>';// FIN DE LA LINEA DE CONTROL DE 
		// 	// FIN REPORTE FACTURACION
		// 	// REPORTE RECAUDO
		// 	echo 'ItemBD '. $est_cta_cli_aliado->est_cta_id .' RegistroNo. '.  $contador. ' Mes '  . $reg->fecha. ' Sede '. $est_cta_cli_aliado->est_cta_sede_id. ' Contrato '. $listado_und->cont_id . ' Porcentaje Tv ' .$porcentaje['tv']. '% Porcentaje Internet '.$porcentaje['int'] .'% Pagó '. $est_cta_cli_aliado->est_cta_debe .' Mensualidad ' .$listado_und->cont_valor_total_mes  .' Pago tv $'.round($pago['tv']).' Pago int $'. round($pago['int']).' Tipo de Persona ' .  $est_cta_cli_aliado->per_tipo_persona_id. '<br>';// FIN DE LA LINEA DE CONTROL DE 
		// 	// FIN REPORTE DE RECAUDO
		// }
		$contador 		= 	0;

		while ($est_cta_cli = $est_cta->fetch_object()) 
		{
			// BUSCA LOS PRODUCTOS DE TIPO TV QUE TENGA DEL CONTRATO
			$listado 		= 	$consolidadoVentas->listarcontrato($est_cta_cli->est_cta_contrato_id);
			$listado_und 	= 	$listado->fetch_object();

			if($valor == 'tv')
			{
				$reg_prod		= 	$consolidadoVentas->validarProductoTv($est_cta_cli->est_cta_contrato_id);
			}
			else if($valor == 'tvd')
			{
				$reg_prod		= 	$consolidadoVentas->validarProductoTvDG($est_cta_cli->est_cta_contrato_id);
			}
			else if($valor == 'otros')
			{
				$reg_prod		= 	$consolidadoVentas->validarProductoOtro($est_cta_cli->est_cta_contrato_id);
			}
			else
			{
				$reg_prod		= 	$consolidadoVentas->validarProductoTv($est_cta_cli->est_cta_contrato_id);	
			}

			$dato_prod 		= 	$reg_prod->fetch_object();

			// print_r($dato_prod);
			// die();

			// RECORRE LOS REGISTROS DEL PRODUCTO
			if(!empty($dato_prod))
			{// SI NO ESTA VACIO EL REGISTRO CREA UN ARRAY PARA CALCULAR EL PORCENTAJE EQUIVALENTE DE TV CON RESPECTO AL VALOR GENERAL DEL PRODUCTO

				$porcentaje 	= 	array(	$valor	=>	($dato_prod->cont_prod_precio*$dato_prod->cont_prod_cantidad) / $listado_und->cont_valor_total_mes * 100,
											'int'	=>	0);
				$porcentaje['int'] 	= 100 - $porcentaje[$valor];
				/// OPERA EL VALOR RECAUDADO CON RESPECTO AL PORCENTAJE OBTENIDO EN LAS OPERACIONES ANTERIORES
				$pago 	=	array(	$valor 	=> 	$est_cta_cli->est_cta_debe * $porcentaje[$valor] / 100,
									'int' 	=> 	$est_cta_cli->est_cta_debe * $porcentaje['int'] / 100);
				// SUMA EL RESULTADO A LA POSICION DEL ARRAY GENERAL CORRESPONDIENTE AL PRODUCTO
				$total[$valor] 	= 	$total[$valor] + $pago[$valor];
				// SUMA EL RESULTADO A LA POSICION DEL ARRAY GENERAL CORRESPONDIENTE AL PRODUCTO
				$total['int']	= 	$total['int'] + $pago['int'];
				$contador++;
			}
			// SI NO ENCUENTRA DATOS DE PRODUCTOS DE TV ASIGNA TODO EL PORCENTAJE DEL PAGO AL INTERNET
			else
			{
				$porcentaje[$valor] = 	0;
				$porcentaje['int'] 	=	100;
				$pago[$valor] 		= 	0;
				$pago['int'] 		= 	$est_cta_cli->est_cta_debe;
				$total[$valor] 		= 	$total[$valor] + $pago[$valor];
				$total['int'] 		= 	$total['int'] + $pago['int'];
				$contador++;
			}

			$sedes[$est_cta_cli->est_cta_sede_id] =  $sedes[$est_cta_cli->est_cta_sede_id]+$pago[$reporte];

			// ****** LINEAS DE CODIGO PARA REALIZAR MANTENIMIENTOS ******* //// 
			// echo $sedes[6] .'<br> ';
			// /// LINEA DE CONTROL DE REGISTROS	
			// if($est_cta_cli->est_cta_sede_id == 6)	
			// {
			// 	echo $contador. ' Mes '  . $reg->fecha. '<h1> Sede '. $est_cta_cli->est_cta_sede_id. ' Contrato '. $listado_und->cont_id . '</h1> Porcentaje Tv ' .$porcentaje['tv']. '% Porcentaje Internet '.$porcentaje['int'] .'% <br> Pagó '. $est_cta_cli->est_cta_debe .' Mensualidad ' .$listado_und->cont_valor_total_mes  .' Pago tv $'.round($pago['tv']).' Pago int $'. round($pago['int']).'<br>
			// 				En el mes '. $reg->fecha.' El ingreso por tv fue: '. round($total['tv']). '<br> En el mes '. $reg->fecha.'<h1> El ingreso por internet fue: '. round($total['int']). '</h1> Ingreso por sede <br>' .$sedes[$est_cta_cli->est_cta_sede_id] ;// FIN DE LA LINEA DE CONTROL DE REGISTROS	
			// }
			// else
			// {
				// echo $contador. ' Mes '  . $reg->fecha. ' Sede '. $est_cta_cli->est_cta_sede_id. ' Contrato '. $listado_und->cont_id . ' Porcentaje Tv ' .$porcentaje['tv']. '% Porcentaje Internet '.$porcentaje['int'] .'% <br> Pagó '. $est_cta_cli->est_cta_debe .' Mensualidad ' .$listado_und->cont_valor_total_mes  .' Pago tv $'.round($pago['tv']).' Pago int $'. round($pago['int']).'<br>
				// 			En el mes '. $reg->fecha.' El ingreso por tv fue: '. round($total['tv']). '<br> En el mes '. $reg->fecha.'<h1> El ingreso por internet fue: '. round($total['int']). '</h1><br>';// FIN DE LA LINEA DE CONTROL DE REGISTROS	
			// }
			// echo $contador. ' Mes ' . $reg->fecha. ' Contrato ' .$est_cta_cli->est_cta_contrato_id . ' Pagó '.$est_cta_cli->est_cta_debe.'<br>';

			// REPORTE FACTURACION
			// echo $contador. ' Mes '  . $reg->fecha. ' Sede '. $est_cta_cli->est_cta_sede_id. ' Contrato '. $listado_und->cont_id . ' Porcentaje Tv ' .$porcentaje['tv']. '% Porcentaje Internet '.$porcentaje['int'] .'% Pagó '. $est_cta_cli->est_cta_debe .' Mensualidad ' .$listado_und->cont_valor_total_mes  .' Pago tv $'.round($pago['tv']).' Pago int $'. round($pago['int']).' Tipo de Persona ' .  $est_cta_cli->per_tipo_persona_id. '<br>';// FIN DE LA LINEA DE CONTROL DE 
			// FIN REPORTE FACTURACION

			// REPORTE RECAUDO
			echo 'ItemBD '. $est_cta_cli->est_cta_id .' RegistroNo. '.  $contador. ' Mes '  . $reg->fecha. ' Sede '. $est_cta_cli->est_cta_sede_id. ' Contrato '. $listado_und->cont_id . ' Porcentaje Tv ' .$porcentaje['tv']. '% Porcentaje Internet '.$porcentaje['int'] .'% Pagó '. $est_cta_cli->est_cta_debe .' Mensualidad ' .$listado_und->cont_valor_total_mes  .' Pago tv $'.round($pago['tv']).' Pago int $'. round($pago['int']).' Tipo de Persona ' .  $est_cta_cli->per_tipo_persona_id. '<br>';
			// FIN REPORTE DE RECAUDO
			// FIN DE LA LINEA DE CONTROL DE 
		}
		/// **** REPORTE DE CORPORATIVOS ***** //// 
		$contador 		= 	0;

		while ($est_cta_cli_corp = $est_cta_corp->fetch_object()) 
		{
			// BUSCA LOS PRODUCTOS DE TIPO TV QUE TENGA DEL CONTRATO
			$listado 		= 	$consolidadoVentas->listarcontrato($est_cta_cli_corp->est_cta_contrato_id);
			$listado_und 	= 	$listado->fetch_object();

			if($listado_und->cont_internet == 1 && $listado_und->cont_tv_analogica == 1 || $listado_und->cont_internet == 1 && $listado_und->cont_tv_digital == 1 || $listado_und->cont_tv_digital == 1 && $listado_und->cont_tv_analogica == 1)
			{

			}
			if($valor == 'tv')
			{
				$reg_prod		= 	$consolidadoVentas->validarProductoTv($est_cta_cli_corp->est_cta_contrato_id);
			}
			else if($valor == 'tvd')
			{
				$reg_prod		= 	$consolidadoVentas->validarProductoTvDG($est_cta_cli_corp->est_cta_contrato_id);
			}
			else if($valor == 'otros')
			{
				$reg_prod		= 	$consolidadoVentas->validarProductoOtro($est_cta_cli_corp->est_cta_contrato_id);
			}
			else
			{
				$reg_prod		= 	$consolidadoVentas->validarProductoTv($est_cta_cli_corp->est_cta_contrato_id);	
			}

			$dato_prod 		= 	$reg_prod->fetch_object();

			// RECORRE LOS REGISTROS DEL PRODUCTO
			if(!empty($dato_prod))
			{// SI NO ESTA VACIO EL REGISTRO CREA UN ARRAY PARA CALCULAR EL PORCENTAJE EQUIVALENTE DE TV CON RESPECTO AL VALOR GENERAL DEL PRODUCTO

				$porcentaje 	= 	array(	$valor	=>	($dato_prod->cont_prod_precio*$dato_prod->cont_prod_cantidad) / $listado_und->cont_valor_total_mes * 100,
											'int'	=>	0);
				$porcentaje['int'] 	= 100 - $porcentaje[$valor];
				/// OPERA EL VALOR RECAUDADO CON RESPECTO AL PORCENTAJE OBTENIDO EN LAS OPERACIONES ANTERIORES
				$pago 	=	array(	$valor 	=> 	$est_cta_cli_corp->est_cta_debe * $porcentaje[$valor] / 100,
									'int' 	=> 	$est_cta_cli_corp->est_cta_debe * $porcentaje['int'] / 100);
				// SUMA EL RESULTADO A LA POSICION DEL ARRAY GENERAL CORRESPONDIENTE AL PRODUCTO
				$total[$valor] 	= 	$total[$valor] + $pago[$valor];
				// SUMA EL RESULTADO A LA POSICION DEL ARRAY GENERAL CORRESPONDIENTE AL PRODUCTO
				$total['int']	= 	$total['int'] + $pago['int'];
				$contador++;
			}
			// SI NO ENCUENTRA DATOS DE PRODUCTOS DE TV ASIGNA TODO EL PORCENTAJE DEL PAGO AL INTERNET
			else
			{
				$porcentaje[$valor] = 	0;
				$porcentaje['int'] 	=	100;
				$pago[$valor] 		= 	0;
				$pago['int'] 		= 	$est_cta_cli_corp->est_cta_debe;
				$total[$valor] 		= 	$total[$valor] + $pago[$valor];
				$total['int'] 		= 	$total['int'] + $pago['int'];
				$contador++;
			}

			$sedes[$est_cta_cli_corp->est_cta_sede_id] =  $sedes[$est_cta_cli_corp->est_cta_sede_id]+$pago[$reporte];

			// ****** LINEAS DE CODIGO PARA REALIZAR MANTENIMIENTOS ******* //// 
			// echo $sedes[6] .'<br> ';
			// /// LINEA DE CONTROL DE REGISTROS	
			// if($est_cta_cli_corp->est_cta_sede_id == 6)	
			// {
			// 	echo $contador. ' Mes '  . $reg->fecha. '<h1> Sede '. $est_cta_cli_corp->est_cta_sede_id. ' Contrato '. $listado_und->cont_id . '</h1> Porcentaje Tv ' .$porcentaje['tv']. '% Porcentaje Internet '.$porcentaje['int'] .'% <br> Pagó '. $est_cta_cli_corp->est_cta_debe .' Mensualidad ' .$listado_und->cont_valor_total_mes  .' Pago tv $'.round($pago['tv']).' Pago int $'. round($pago['int']).'<br>
			// 				En el mes '. $reg->fecha.' El ingreso por tv fue: '. round($total['tv']). '<br> En el mes '. $reg->fecha.'<h1> El ingreso por internet fue: '. round($total['int']). '</h1> Ingreso por sede <br>' .$sedes[$est_cta_cli_corp->est_cta_sede_id] ;// FIN DE LA LINEA DE CONTROL DE REGISTROS	
			// }
			// else
			// {
				// echo $contador. ' Mes '  . $reg->fecha. ' Sede '. $est_cta_cli_corp->est_cta_sede_id. ' Contrato '. $listado_und->cont_id . ' Porcentaje Tv ' .$porcentaje['tv']. '% Porcentaje Internet '.$porcentaje['int'] .'% <br> Pagó '. $est_cta_cli_corp->est_cta_debe .' Mensualidad ' .$listado_und->cont_valor_total_mes  .' Pago tv $'.round($pago['tv']).' Pago int $'. round($pago['int']).'<br>
				// 			En el mes '. $reg->fecha.' El ingreso por tv fue: '. round($total['tv']). '<br> En el mes '. $reg->fecha.'<h1> El ingreso por internet fue: '. round($total['int']). '</h1><br>';// FIN DE LA LINEA DE CONTROL DE REGISTROS	
			// }
			// INICIO REPORTE FACTURACION
			// echo $contador. ' Mes ' . $reg->fecha. ' Contrato ' .$est_cta_cli_corp->est_cta_contrato_id . ' Pagó '.$est_cta_cli_corp->est_cta_debe.'<br>';
			// echo $contador. ' Mes '  . $reg->fecha. ' Sede '. $est_cta_cli_corp->est_cta_sede_id. ' Contrato '. $listado_und->cont_id . ' Porcentaje Tv ' .$porcentaje['tv']. '% Porcentaje Internet '.$porcentaje['int'] .'% Pagó '. $est_cta_cli_corp->est_cta_debe .' Mensualidad ' .$listado_und->cont_valor_total_mes  .' Pago tv $'.round($pago['tv']).' Pago int $'. round($pago['int']).' Tipo de Persona ' .  $est_cta_cli_corp->per_tipo_persona_id. '<br>';
			// FIN REPORTE FACTURACION

			// REPORTE RECAUDO
			echo 'ItemBD '. $est_cta_cli_corp->est_cta_id .' RegistroNo. '.  $contador. ' Mes '  . $reg->fecha. ' Sede '. $est_cta_cli_corp->est_cta_sede_id. ' Contrato '. $listado_und->cont_id . ' Porcentaje Tv ' .$porcentaje['tv']. '% Porcentaje Internet '.$porcentaje['int'] .'% Pagó '. $est_cta_cli_corp->est_cta_debe .' Mensualidad ' .$listado_und->cont_valor_total_mes  .' Pago tv $'.round($pago['tv']).' Pago int $'. round($pago['int']).' Tipo de Persona ' .  $est_cta_cli_corp->per_tipo_persona_id. '<br>';
			// FIN REPORTE DE RECAUDO
			// // FIN DE LA LINEA DE CONTROL DE 

		}

		//// ***** FIN REPORTE CORPORATIVOS ***** //////

		// ****** CONTROL PARA PRUEBA DE REGISTROS ****** 
		// echo "Total Internet " .number_format(round($total['int'])) . " Mes " . $reg->fecha. '<br>';
		// echo "Total Tv " .number_format(round($total['tv'])) . " Mes " . $reg->fecha. '<br>';
		// echo "
		// <table style='border: solid'>
		// 	<thead>";
		// $contar_sede = 0;
		// $valor_sede = 0;
		// $sede 	= 3;
		// $sede2 	= 3;
		// while ($contar_sede < count($sedes)) 
		// {
		// 	echo "
		// 		<th>".$sede."</th>
		// 	";
		// 	$contar_sede++;
		// 	$sede++;
		// }
		// echo "	
		// 	</thead>";
		// echo "<tbody>
		// 		<tr>";
		// while ($valor_sede < count($sedes)) 
		// {
		// 	echo "
		// 		<td style='border: solid'>".number_format(round($sedes[$sede2])) ."</td>
		// 	";
		// 	$valor_sede++;
		// 	$sede2++;
		// }										
		// echo"		
		// 		</tr>
		// 	</tbody>
		// </table>";

		// ****** FIN CONTROL PARA MANTENIMIENTO Y PRUEBA DE REGISTROS ****** 

	$mes  = "";
			if ($reg->fecha == 1) {
				$mes = "01 - ENERO";
			}
			elseif ($reg->fecha ==2) {
				$mes = "02 - FEBRERO";
			}
			elseif ($reg->fecha ==3) {
				$mes = "03 - MARZO";
			}
			elseif ($reg->fecha ==4) {
				$mes = "04 - ABRIL";
			}
			elseif ($reg->fecha ==5) {
				$mes = "05 - MAYO";
			}
			elseif ($reg->fecha ==6) {
				$mes = "06 - JUNIO";
			}
			elseif ($reg->fecha ==7) {
				$mes = "07 - JULIO";
			}
			elseif ($reg->fecha ==8) {
				$mes = "08 - AGOSTO";
			}
			elseif ($reg->fecha ==9) {
				$mes = "09 - SEPTIEMBRE";
			}
			elseif ($reg->fecha ==10) {
				$mes = "10 - OCTUBRE";
			}
			elseif ($reg->fecha ==11) {
				$mes = "11 - NOVIEMBRE";
			}
			elseif ($reg->fecha ==12) {
				$mes = "12 - DICIEMBRE";
			}
			$data[] = array(
				"0"=>$mes,
				"1"=>"$".number_format($sedes[3]),
				"2"=>"$".number_format($sedes[9]),
				"3"=>"$".number_format($sedes[8]),
				"4"=>"$".number_format($sedes[6]),
				"5"=>"$".number_format($sedes[10]),
				"6"=>"$".number_format($sedes[4]),
				"7"=>"$".number_format($sedes[5]),
				"8"=>"$".number_format($sedes[11]),
				"9"=>"$".number_format($sedes[7]),
				"10"=>"$".number_format($total[$reporte])
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
}
	 /* -------------------------
	|	  FIN DE LA FUNCION 	 |
	 ----------------------------*/
?>