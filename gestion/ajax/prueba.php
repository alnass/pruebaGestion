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
							12 	=> 0);
		// CREA UN ARRAY GENERAL PARA ALMACENAR LOS REGISTROS SUMADOS

		$total 	= 	array(	$valor 	=> 	0,
		 					'int'	=> 	0);

		// echo 'Se recibio ' . $valor . ' se debe reportar ' .$reporte;
		
		$contador 		= 	0;
		$contador_corp 	= 	0;
		$contadors 		= 	0;
		$contadors_corp	= 	0;
		// LLAMA EL LISTADO DE CONTRATOS DE LA BASE DE DATOS
		$est_cta 		= 	$consolidadoVentas->estadoCuentaContrato($reg->fecha);
		$est_cta_corp 	= 	$consolidadoVentas->estadoCuentaContratoCorp($reg->fecha);

		while ($est_cta_cli = $est_cta->fetch_object()) 
		{
			// BUSCA LOS PRODUCTOS DE TIPO TV QUE TENGA DEL CONTRATO
			$listado 		= 	$consolidadoVentas->listarcontrato($est_cta_cli->est_cta_contrato_id);

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
			$listado_und 	= 	$listado->fetch_object();
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
				$porcentaje[$valor] 	= 	0;
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
			// 	echo $contador. ' Mes '  . $reg->fecha. ' Sede '. $est_cta_cli->est_cta_sede_id. ' Contrato '. $listado_und->cont_id . ' Porcentaje Tv ' .$porcentaje['tv']. '% Porcentaje Internet '.$porcentaje['int'] .'% <br> Pagó '. $est_cta_cli->est_cta_debe .' Mensualidad ' .$listado_und->cont_valor_total_mes  .' Pago tv $'.round($pago['tv']).' Pago int $'. round($pago['int']).'<br>
			// 				En el mes '. $reg->fecha.' El ingreso por tv fue: '. round($total['tv']). '<br> En el mes '. $reg->fecha.'<h1> El ingreso por internet fue: '. round($total['int']). '</h1><br>';// FIN DE LA LINEA DE CONTROL DE REGISTROS	
			// }
			// echo $contador. ' Mes ' . $reg->fecha. ' Contrato ' .$est_cta_cli->est_cta_contrato_id . ' Pagó '.$est_cta_cli->est_cta_debe.'<br>';
		}
		/// **** REPORTE DE CORPORATIVOS ***** //// 

		while ($est_cta_cli_corp = $est_cta_corp->fetch_object()) 
		{
			// BUSCA LOS PRODUCTOS DE TIPO TV QUE TENGA DEL CONTRATO
			$listado_corp 		= 	$consolidadoVentas->listarcontrato($est_cta_cli_corp->est_cta_contrato_id);

			if($valor == 'tv')
			{
				$reg_prod_corp		= 	$consolidadoVentas->validarProductoTv($est_cta_cli_corp->est_cta_contrato_id);
			}
			else if($valor == 'tvd')
			{
				$reg_prod_corp		= 	$consolidadoVentas->validarProductoTvDG($est_cta_cli_corp->est_cta_contrato_id);
			}
			else if($valor == 'otros')
			{
				$reg_prod_corp		= 	$consolidadoVentas->validarProductoOtro($est_cta_cli_corp->est_cta_contrato_id);
			}
			else
			{
				$reg_prod_corp		= 	$consolidadoVentas->validarProductoTv($est_cta_cli_corp->est_cta_contrato_id);	
			}

			$dato_prod_corp 			= 	$reg_prod_corp->fetch_object();
			$listado_und_corp 	= 	$listado_corp->fetch_object();
			// RECORRE LOS REGISTROS DEL PRODUCTO
			if(!empty($dato_prod_corp))
			{// SI NO ESTA VACIO EL REGISTRO CREA UN ARRAY PARA CALCULAR EL PORCENTAJE EQUIVALENTE DE TV CON RESPECTO AL VALOR GENERAL DEL PRODUCTO
				$porcentaje_corp 	= 	array(	$valor	=>	($dato_prod_corp->cont_prod_precio*$dato_prod_corp->cont_prod_cantidad) / $listado_und_corp->cont_valor_total_mes * 100,
											'int'	=>	0);
				$porcentaje_corp['int'] 	= 100 - $porcentaje_corp[$valor];
				/// OPERA EL VALOR RECAUDADO CON RESPECTO AL PORCENTAJE OBTENIDO EN LAS OPERACIONES ANTERIORES
				$pago_corp 	=	array(	$valor 	=> 	$est_cta_cli_corp->est_cta_debe * $porcentaje_corp[$valor] / 100,
									'int' 	=> 	$est_cta_cli_corp->est_cta_debe * $porcentaje_corp['int'] / 100);
				// SUMA EL RESULTADO A LA POSICION DEL ARRAY GENERAL CORRESPONDIENTE AL PRODUCTO
				$total[$valor] 	= 	$total[$valor] + $pago_corp[$valor];
				// SUMA EL RESULTADO A LA POSICION DEL ARRAY GENERAL CORRESPONDIENTE AL PRODUCTO
				$total['int']	= 	$total['int'] + $pago_corp['int'];
				$contador_corp++;
			}
			// SI NO ENCUENTRA DATOS DE PRODUCTOS DE TV ASIGNA TODO EL PORCENTAJE DEL PAGO AL INTERNET
			else
			{
				$porcentaje_corp[$valor] 	= 	0;
				$porcentaje_corp['int'] 	=	100;
				$pago_corp[$valor] 			= 	0;
				$pago_corp['int'] 			= 	$est_cta_cli_corp->est_cta_debe;
				$total[$valor] 				= 	$total[$valor] + $pago_corp[$valor];
				$total['int'] 				= 	$total['int'] + $pago_corp['int'];
				$contador_corp++;
			}

			$sedes[11] =  $sedes[11]+$pago_corp[$reporte];
		
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
