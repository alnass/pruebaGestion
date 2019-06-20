<?php 
session_start();

switch ($_GET["op"]) 
{
	case 'listar':

		// Declaracion de array para almacenamiento de los resultados
		$data = Array();

		$respuesta 	= 	5;
		$reg 		= 	0;
		$nit		= 	800900300;
		$valor 		= 	2000000;
		$items 		= 	5;
		// Estructura de recorrido de la BD
		while ($reg < $respuesta) {
			// Identificador de permanencia
			$reg++;

			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>'<button data-toggle="tooltip" data-placement="right" title="Imprimir compra"  class="btn btn-default">
						<i class="fa fa-print"></i>
					</button>',
				"1"=>$reg,
				"2"=>date("Y-m-d"),
				"3"=>"Proveedor",
				"4"=>2334455,
				"5"=>number_format($nit).'-1',
				"6"=>"$". number_format($valor),
				"7"=>$items,
				"8"=>$items,
				"9"=>"Pendiente",
				"10"=>'<button data-toggle="tooltip" data-placement="right" title="Rechazar compra"  class="btn btn-warning" onclick="mostrar()">
						<i class="fa fa-pencil"></i>
					</button>',
				"11"=>'<button data-toggle="tooltip" data-placement="right" title="Eliminar compra"  class="btn btn-danger" onclick="cancelar()">
						<i class="fa fa-times-circle-o"></i>
					</button>');

			$valor 	= 	$valor - 185000;
			$nit 	= 	$nit + 250;
			$items--;
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

	case 'listarSolicitudes':

		// Declaracion de array para almacenamiento de los resultados
		$data = Array();

		$respuesta 	= 	7;
		$reg 		= 	0;
		$nit		= 	800900300;
		$valor 		= 	2000000;
		$items 		= 	5;
		// Estructura de recorrido de la BD
		while ($reg < $respuesta) {
			// Identificador de permanencia
			$reg++;
			$iva 	= 	$valor - ($valor / 1.19);

			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>'<button data-toggle="tooltip" data-placement="right" title="Aprobar compra"  class="btn btn-success" onclick="exitoRegistro()">
						<i class="fa fa-check-circle"></i>
					</button>'.' '.'<button data-toggle="modal" data-target="#myModal" title="Rechazar compra"  class="btn btn-danger">
						<i class="fa fa-times-circle-o"></i>
					</button>' ,
				"1"=>$reg,
				"2"=>date("Y-m-d"),
				"3"=>"Proveedor",
				"4"=>2334455,
				"5"=>number_format($nit).'-1',
				"6"=>"$". number_format($valor),
				"7"=>"$" . number_format($iva),
				"8"=>8765782441,
				"9"=>"Davivienda",
				"10"=>"Pedro Pérez (Inventarios)",
				"11"=>'<button data-toggle="tooltip" data-placement="right" title="Rechazar compra"  class="btn btn-warning" onclick="mostrar()">
						<i class="fa fa-eye"></i>
					</button>');

			$valor 	= 	$valor - 185000;
			$nit 	= 	$nit + 250;
			$items--;
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

	case 'listarSolicitudesAprobadas':

		// Declaracion de array para almacenamiento de los resultados
		$data = Array();

		$respuesta 	= 	5;
		$reg 		= 	0;
		$nit		= 	904950300;
		$valor 		= 	5000000;
		$items 		= 	6;
		// Estructura de recorrido de la BD
		while ($reg < $respuesta) {
			// Identificador de permanencia
			$reg++;
			$iva 	= 	$valor - ($valor / 1.19);

			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>'<button data-toggle="tooltip" data-placement="right" title="Ocultar compra"  class="btn btn-success" onclick="ocultarRegistro()">
						<i class="fa fa-eye-slash"></i>
					</button>',
				"1"=>$reg,
				"2"=>date("2018-01-25"),
				"3"=>"Proveedor",
				"4"=>5443344,
				"5"=>number_format($nit).'-2',
				"6"=>"$". number_format($valor),
				"7"=>"$" . number_format($iva),
				"8"=>89712676256,
				"9"=>"Granahorrar",
				"10"=>"Paco Jimenez (Dpto. Financiero)",
				"11"=>'<button data-toggle="tooltip" data-placement="right" title="Ver Detalle"  class="btn btn-warning" onclick="mostrar()">
						<i class="fa fa-eye"></i>
					</button>'
				);

			$valor 	= 	$valor - 175000;
			$nit 	= 	$nit + 150;
			$items--;
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

	case 'listarSolicitudesRechazadas':

		// Declaracion de array para almacenamiento de los resultados
		$data = Array();

		$respuesta 	= 	4;
		$reg 		= 	0;
		$nit		= 	912940300;
		$valor 		= 	15800000;
		$items 		= 	15;
		// Estructura de recorrido de la BD
		while ($reg < $respuesta) {
			// Identificador de permanencia
			$reg++;
			$iva 	= 	$valor - ($valor / 1.19);

			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>'<button data-toggle="tooltip" data-placement="right" title="Aprobar compra"  class="btn btn-success" onclick="reactivarRegistro()">
						<i class="fa fa-check-circle"></i>
					</button>',
				"1"=>$reg,
				"2"=>date("Y-m-d"),
				"3"=>"2019-01-15",
				"4"=>'Pedro Pérez (Inventarios)',
				"5"=>1234567,
				"6"=>"$ ". number_format($valor),
				"7"=>"$" . number_format($iva),
				"8"=>8765782441,
				"9"=>"Davivienda",
				"10"=>"Paco Jimenez (Dpto. Financiero)",
				"11"=>'No alcanza el presupuesto'
				);

			$valor 	= 	$valor - 185000;
			$nit 	= 	$nit + 250;
			$items--;
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

	case 'listarProveedores':

		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		$reg 	= 	0;

		while ($reg < 10) 
		{
			$reg++;
			$prov_id 		= 	$reg;
			$prov_nombre	= 	'Proveedor'. $reg;
			$prov_tel		= 	'344556'. $reg;
			$prov_direc		= 	'Calle '. $reg . ' No. '. $reg .'-' . $reg;
			$prov_cuenta	=	'12345' . $reg + 155;
			$prov_tip_cta	= 	 '2';
			$prov_banco		= 	'Banco '.$reg;


			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
			// agregarDetalle('.$reg->prod_id.',\''.$reg->prod_nombre.'\',\''.$reg->prod_descripcion.'\','.$reg->prod_valor.')
			// asignarProveedor('.$prov_id.',\''.$prov_nombre.'\',\''.$prov_cuenta.'\','.$prov_tip_cta.'\','.$prov_banco.')
				"0"=>'<button data-toggle="tooltip" data-placement="right" title="Seleccionar Proveedor"  class="btn btn-success" onclick="asignarProveedor('.$prov_id.',\''.$prov_nombre.'\',\''.$prov_cuenta.'\',\''.$prov_tip_cta.'\',\''.$prov_banco.'\',\''.$prov_tel.'\',\''.$prov_direc.'\')">
						<i class="fa fa-check-circle"></i>
					</button>',
				"1"=>$reg,
				"2"=>$reg. 'Proveedor',
				"3"=>'Vendedor' . $reg,
				"4"=>'233445'. $reg,
				"5"=>'Calle '.$reg .'No. ' . $reg. '-' . $reg);
		}
		
		$data[] = array
		(
			"0"=>'<button data-toggle="tooltip" data-placement="right" title="Seleccionar Proveedor"  class="btn btn-success" onclick="asignarProveedor('.$prov_id.',\''.$prov_nombre.'\',\''.$prov_cuenta.'\',\''.$prov_tip_cta.'\',\''.$prov_banco.'\')">
					<i class="fa fa-check-circle"></i>
				</button>',
			"1"=>0,
			"2"=>'CREAR',
			"3"=>'NUEVO',
			"4"=>'PROVEEDOR',
			"5"=>''
		);

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