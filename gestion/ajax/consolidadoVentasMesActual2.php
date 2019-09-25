<?php  
// maintenance effectuee par Anderson Ferrucho
require "../modelos/ConsolidadoVentas.php";
$consolidadoVentas = new ConsolidadoVentas();

switch ($_GET['op']) {
	case 'listar':

		$tipo 		= 	$_GET['tipo'];
	// // TRAE LA CANTIDAD DE SEDES QUE ESTEN REGISTRADAS
		$respuesta 	= 	$consolidadoVentas->traerSedes();		
	// // 	// ARRAY QUE ALMACENA LOS DATOS DE RESULTADO PARA ENVIARLOS POR JSON
		$data 		= 	Array();
	// // 	// NUMERO DEL MES ACTUAL
		$mes 		= 	date('n');
		// $mes 		= 	8;
		// $mes2 		= 	7;
		$mes2 		= 	date('n')-1;
 	// // 	// NUMERO DEL AÑO ACTUAL
		$anio 		= 	date('Y');
	// // 	// ARRAY PARA SEDES
		$sedes 		= 	array();
	// // 	// ARRAY PARA PRODUCTOS
		$product	= 	array(	'CANT_TVA' => 0,
								'TVA' => 0,
								'CANT_INT' => 0,
								'INT' => 0,
								'CANT_TVD' => 0,
								'TVD' => 0,
								'CANT_OTR' => 0,
								'OTR' => 0,
								'TOTL' => 0);
	// // 	// ALMACENA EL DETALLE DEL REGISTRO
		$detalle 	= 	array( 	'id_ec' 		=>	0,
								'id_mes'		=> 	0,
								'fecha_reg' 	=> 	0,
								'anio'			=> 	0,
								'id_sede'		=> 	0,
								'id_cont'		=> 	0,
								'total_regis'	=> 	0,
								'valor_tva'		=> 	0,
								'valor_int'		=> 	0,
								'valor_tvd'		=> 	0,
								'otros_prod'	=> 	0,
								'tipo_registro'	=> 	0,
								'tipo_persona'	=> 	0,
								'tipo_cliente'	=> 	0);

	// 	// CICLO QUE RECORRE LA CANTIDAD DE REGISTROS DE SEDES
		if($tipo == 1)
		{
			$est_cta 		= 	$consolidadoVentas->estadoCuentaContrato($mes, $anio);
			$valor 			= 	'est_cta_debe';
		}
		else
		{
			$est_cta 		= 	$consolidadoVentas->estadoCuentaFactura($mes, $mes2, $anio);	
			$valor 			= 	'est_cta_haber';
		}
	// 	// CICLO PARA ASIGNAR LAS SEDES COMO LLAVE EN ARRAY DE SEDES
		while ($sede = $respuesta->fetch_object())
		{
			// AL VALOR DE CADA SEDE LE ASIGNA UN ARRAY PARA LOS PRODUCTOS
			$sedes[$sede->sed_id] = $product;
		}
	// 	// CICLO PARA RECORRER LA TABLA DE ESTADO DE CUENTA 
		while ($fact = $est_cta->fetch_object()) 
		{
			
			$detalle['id_ec'] 		= 	$fact->est_cta_id;
			$detalle['id_mes'] 		= 	$mes;
			$detalle['anio'] 		= 	$anio;
			$detalle['fecha_reg'] 	= 	$fact->est_cta_fecha_transacc;

			if($fact->per_tipo_persona_id == 2)
			{
				$detalle['id_sede'] 	= 	11;
			}
			else
			{
				$detalle['id_sede'] 	= 	$fact->est_cta_sede_id;
			}

			$detalle['id_cont'] 	= 	$fact->est_cta_contrato_id;
			$detalle['total_regis']	= 	$fact->$valor;
		// 	// LLAMA LOS DATOS DEL CONTRATO
			$contrato  	=	$consolidadoVentas->listarcontrato($fact->est_cta_contrato_id);
		// 	// // SUMA LOS VALORES DE LOS PRODUCTOS QUE ENCUENTRA EN EL CONTRATO
			$suma_prod 	= 	$contrato['cont_internet'] + $contrato['cont_tv_digital'] + $contrato['cont_tv_analogica'];
		// 	// // SI EL RESULTADO ES MAYOR A 1 REALIZA LO SIGUIENTE
			if($suma_prod > 1)
			{	// CONSULTA LOS PRODUCTOS ASIGNADOS EN LA BD
				$prodctos 	= 	$consolidadoVentas->validarProductos($fact->est_cta_contrato_id);
				// CICLO PARA RECORRER LOS PRODUCTOS
				$detalle['valor_int']	= 	0;
				$detalle['valor_tva']	= 	0;
				$detalle['valor_tvd']	= 	0;
				$detalle['otros_prod']	= 	0;

				while ($prod = $prodctos->fetch_object()) 
				{
					$porcentaje = 	0;
					$pago 		= 	0;

					if($contrato['cont_total_productos'] != 0)
					{
						if($prod->prod_prefijo == 'TVA')
						{
							$porcentaje 	= 	($prod->cont_prod_precio * $prod->cont_prod_cantidad) / $contrato['cont_total_productos']*100;
							$pago 			= 	$fact->$valor * $porcentaje /100;
							$detalle['valor_tva']	= 	round($pago);
							$sedes[$detalle['id_sede']]['TVA']	= $sedes[$detalle['id_sede']]['TVA'] + round($pago);
							$sedes[$detalle['id_sede']]['CANT_TVA']	= $sedes[$detalle['id_sede']]['CANT_TVA'] + 1;

							// LINEA PARA VALIDAR REGISTROS
							// echo 'Contrato ' .  $contrato['cont_id'] . ' Pago TVA ' . $pago . ' Porcentaje '.$porcentaje. ' TVA Acumulado '.$sedes[$detalle['id_sede']]['TVA']. ' Total Productos '. $contrato['cont_total_productos'] . '<br> ';
							// echo($porcentaje);
						}
						if($prod->prod_prefijo == 'INT')
						{
							$porcentaje 	= 	($prod->cont_prod_precio * $prod->cont_prod_cantidad) / $contrato['cont_total_productos']*100;
							$pago 			= 	$fact->$valor * $porcentaje /100;
							$detalle['valor_int']	= 	round($pago);
							$sedes[$detalle['id_sede']]['INT']	= $sedes[$detalle['id_sede']]['INT'] + round($pago);
							$sedes[$detalle['id_sede']]['CANT_INT']	= $sedes[$detalle['id_sede']]['CANT_INT'] + 1;	
							// LINEA PARA VALIDAR REGISTROS
							// echo 'Contrato ' .  $contrato['cont_id'] . ' Pago INT ' . $pago . ' Porcentaje '.$porcentaje. '<br>';
							// echo($porcentaje);
						}
						if($prod->prod_prefijo == 'TVD')
						{
							$porcentaje 	= 	($prod->cont_prod_precio * $prod->cont_prod_cantidad) / $contrato['cont_total_productos']*100;
							$pago 			= 	$fact->$valor * $porcentaje /100;
							$detalle['valor_tvd']	= 	round($pago);
							$sedes[$detalle['id_sede']]['TVD']	= $sedes[$detalle['id_sede']]['TVD'] + round($pago);
							$sedes[$detalle['id_sede']]['CANT_TVD']	= $sedes[$detalle['id_sede']]['CANT_TVD'] + 1;
							// LINEA PARA VALIDAR REGISTROS
							// echo 'Contrato ' .  $contrato['cont_id'] . ' Pago TVD ' . $pago . ' Porcentaje '.$porcentaje. '<br>';
							// echo($porcentaje);
						}
						if($prod->prod_prefijo != 'TVD' && $prod->prod_prefijo != 'TVA' && $prod->prod_prefijo != 'INT')
						{
							$porcentaje 	= 	($prod->cont_prod_precio * $prod->cont_prod_cantidad) / $contrato['cont_total_productos']*100;
							$pago 			= 	$fact->$valor * $porcentaje /100;
							$detalle['otros_prod']	= 	round($pago);
							$sedes[$detalle['id_sede']]['OTR']	= $sedes[$detalle['id_sede']]['OTR'] + round($pago);
							$sedes[$detalle['id_sede']]['CANT_OTR']	= $sedes[$detalle['id_sede']]['CANT_OTR'] + 1;
							// LINEA PARA VALIDAR REGISTROS
							// echo 'Contrato ' .  $contrato['cont_id'] . ' Pago OTROS ' . $pago .' Porcentaje '.$porcentaje. '<br>';
						}
					}
				}	
			}
			// SI EL RESULTADO ES IGUAL A 1 REALIZA LO SIGUIENTE
			else if($suma_prod = 1)
			{
				// CONDICIONAL QUE IDENTIFICA QUE PRODUCTO TIENE ACTIVO
				if($contrato['cont_internet'] == 1)
				{
					// CONDICIONAL QUE IDENTIFICA SI EL TIPO DE CLIENTE ES CORPORATIVO
					if($fact->per_tipo_persona_id == 2)
					{
						// ASIGNA EL VALOR QUE RECIBE DEL ESTADO DE CUENTA AL ARRAY SEDES EN LA POSICION CORPORATIVO
						$sedes[11]['INT'] 		= 	$sedes[11]['INT'] + $fact->$valor;
						$sedes[11]['CANT_INT']	= 	$sedes[11]['CANT_INT'] + 1;	
						$detalle['valor_int']	= 	$fact->$valor;
						$detalle['valor_tva']	= 	0;
						$detalle['valor_tvd']	= 	0;
						$detalle['otros_prod']	= 	0;
					}
					else
					{
				// SI EL CLIENTE NO ES CORPORATIVO ASIGNA EL VALOR RECIBIDO AL ARRAY SEDES EN LA POSICION DE LA SEDE EQUIVALENTE
						$sedes[$fact->est_cta_sede_id]['INT']		= 	$sedes[$fact->est_cta_sede_id]['INT'] + $fact->$valor;
						$sedes[$fact->est_cta_sede_id]['CANT_INT']	= 	$sedes[$fact->est_cta_sede_id]['CANT_INT'] + 1;	
						$detalle['valor_int']	= 	$fact->$valor;
						$detalle['valor_tva']	= 	0;
						$detalle['valor_tvd']	= 	0;
						$detalle['otros_prod']	= 	0;
					}
				}
				// CONDICIONAL QUE IDENTIFICA QUE PRODUCTO TIENE ACTIVO
				else if($contrato['cont_tv_analogica'] == 1)
				{
					// CONDICIONAL QUE IDENTIFICA SI EL TIPO DE CLIENTE ES CORPORATIVO
					if($fact->per_tipo_persona_id == 2)
					{
						// ASIGNA EL VALOR QUE RECIBE DEL ESTADO DE CUENTA AL ARRAY SEDES EN LA POSICION CORPORATIVO
						$sedes[11]['TVA'] 		=	$sedes[11]['TVA'] + $fact->$valor;
						$sedes[11]['CANT_TVA']	= 	$sedes[11]['CANT_TVA'] + 1;	
						$detalle['valor_tva']	= 	$fact->$valor;
						$detalle['valor_int']	= 	0;
						$detalle['valor_tvd']	= 	0;
						$detalle['otros_prod']	= 	0;
					}
					else
					{
				// SI EL CLIENTE NO ES CORPORATIVO ASIGNA EL VALOR RECIBIDO AL ARRAY SEDES EN LA POSICION DE LA SEDE EQUIVALENTE
						$sedes[$fact->est_cta_sede_id]['TVA']		= $sedes[$fact->est_cta_sede_id]['TVA'] + $fact->$valor;
						$sedes[$fact->est_cta_sede_id]['CANT_TVA']	= $sedes[$fact->est_cta_sede_id]['CANT_TVA'] + 1;
						$detalle['valor_tva']	= 	$fact->$valor;
						$detalle['valor_int']	= 	0;
						$detalle['valor_tvd']	= 	0;
						$detalle['otros_prod']	= 	0;
					}
				}
				// CONDICIONAL QUE IDENTIFICA QUE PRODUCTO TIENE ACTIVO
				else
				{
					// CONDICIONAL QUE IDENTIFICA SI EL TIPO DE CLIENTE ES CORPORATIVO
					if($fact->per_tipo_persona_id == 2)
					{
						// ASIGNA EL VALOR QUE RECIBE DEL ESTADO DE CUENTA AL ARRAY SEDES EN LA POSICION CORPORATIVO
						$sedes[11]['TVD'] 		= 	$sedes[11]['TVD'] + $fact->$valor;
						$sedes[11]['CANT_TVD'] 	= 	$sedes[11]['CANT_TVD'] + 1;
						$detalle['valor_tvd']	= 	$fact->$valor;
						$detalle['valor_tva']	= 	0;
						$detalle['valor_int']	= 	0;
						$detalle['otros_prod']	= 	0;
					}
					else
					{
				// SI EL CLIENTE NO ES CORPORATIVO ASIGNA EL VALOR RECIBIDO AL ARRAY SEDES EN LA POSICION DE LA SEDE EQUIVALENTE
						$sedes[$fact->est_cta_sede_id]['TVD']		= $sedes[$fact->est_cta_sede_id]['TVD'] + $fact->$valor;
						$sedes[$fact->est_cta_sede_id]['CANT_TVD']	= $sedes[$fact->est_cta_sede_id]['CANT_TVD'] + 1;
						$detalle['valor_tvd']	= 	$fact->$valor;
						$detalle['valor_tva']	= 	0;
						$detalle['valor_int']	= 	0;
						$detalle['otros_prod']	= 	0;
					}
				}
			}
			// FIN DE VALIDACIÓN DEL RESULTADO DE PRODUCTOS IGUAL A 1
			// SI EL PRODUCTO ES IGUAL A 0
			else
			{
				if($fact->per_tipo_persona_id == 2)
				{
					$sedes[11]['OTR'] = $sedes[11]['OTR'] + $fact->$valor;
					$sedes[11]['CANT_OTR']	= $sedes[11]['CANT_OTR'] + 1;
					$detalle['otros_prod']	= 	$fact->$valor;
					$detalle['valor_tvd']	= 	0;
					$detalle['valor_tva']	= 	0;
					$detalle['valor_int']	= 	0;
				}
				else
				{
					$sedes[$fact->est_cta_sede_id]['OTR']	= $sedes[$fact->est_cta_sede_id]['OTR'] + $fact->$valor;
					$sedes[$fact->est_cta_sede_id]['CANT_OTR']	= $sedes[$fact->est_cta_sede_id]['CANT_OTR'] + 1;
					$detalle['otros_prod']	= 	$fact->$valor;
					$detalle['valor_tvd']	= 	0;
					$detalle['valor_tva']	= 	0;
					$detalle['valor_int']	= 	0;
				}
			}
			$detalle['tipo_registro']	= 	2;
			$detalle['tipo_persona']	= 	$fact->per_tipo_persona_id;
			$detalle['tipo_cliente']	= 	$fact->per_tipo_cliente_id;
			$sedes[$detalle['id_sede']]['TOTL'] = $sedes[$detalle['id_sede']]['TOTL'] + 1;

			// INICIO LINEA PARA VALIDAR DATOS REGISTRADOS
			
			// echo 'No.BD '. $detalle['id_ec'] . ' Mes ' . $detalle['id_mes'] . ' fechaTransaccion ' . $detalle['fecha_reg'] . ' Sede ' . $detalle['id_sede'] . ' Cont ' . $detalle['id_cont'] . ' Pago ' .  $detalle['total_regis'] . ' TVA ' . $detalle['valor_tva'] . ' INT ' . $detalle['valor_int'] . ' TVD ' . $detalle['valor_tvd'] . ' TipoPersona ' . $detalle['tipo_persona'] . ' TipoCliente ' .$detalle['tipo_cliente'] . ' CONTSED ' . $contrato['cont_sede_id'] .'<br>' ;

			// FIN LINEA PARA VALIDAR DATOS REGISTRADOS
		}
		$count_result 	= 	0;

		while ($sede_actual = current($sedes)) 
		{
			if(key($sedes) != 12)
			{
				if(key($sedes) == 3)
				{
					$nom_sede 	= 	'Bogotá';
				}
				else if(key($sedes) == 4)
				{
					$nom_sede 	= 	'Fomeque';
				}
				else if(key($sedes) == 5)
				{
					$nom_sede 	= 	'San Antonio';
				}
				else if(key($sedes) == 6)
				{
					$nom_sede 	= 	'Tibasosa';
				}
				else if(key($sedes) == 7)
				{
					$nom_sede 	= 	'Madrid';
				}
				else if(key($sedes) == 8)
				{
					$nom_sede 	= 	'Firavitoba';
				}
				else if(key($sedes) == 9)
				{
					$nom_sede 	= 	'Paipa';
				}
				else if(key($sedes) == 10)
				{
					$nom_sede 	= 	'Iza';
				}
				else if(key($sedes) == 11)
				{
					$nom_sede 	= 	'Corporativos';
				}
				else if(key($sedes) == 13)
				{
					$nom_sede 	= 	'Cota';
				}
				else if(key($sedes) == 14)
				{
					$nom_sede 	= 	'Aliados';
				}
				else if(key($sedes) == 15)
				{
					$nom_sede 	= 	'Patio Bonito';
				}

				$data[] = array
				(
					"0"=>$nom_sede,
					// "1"=>$sedes[key($sedes)]['CANT_TVA'],
					"1"=>'$' .number_format($sedes[key($sedes)]['TVA']),
					// "3"=>$sedes[key($sedes)]['CANT_INT'],
					"2"=>'$' .number_format($sedes[key($sedes)]['INT']),
					// "5"=>$sedes[key($sedes)]['CANT_TVD'],
					"3"=>'$' .number_format($sedes[key($sedes)]['TVD']),
					"4"=>$sedes[key($sedes)]['TOTL'],
					"5"=>'$' .number_format($sedes[key($sedes)]['TVA'] + $sedes[key($sedes)]['INT'] + $sedes[key($sedes)]['TVD']),
					"6"=>'<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ver Detalle" onclick="detalle('.key($sedes).','.$mes
						  .','.$anio.')"><i class="fa fa-eye" aria-hidden="true"></i></button>'
				);
			}
			next($sedes);
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
}

?>