<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA
// 	producto

// CAMPOS DE LA TABLA 
// 	prod_id
// 	prod_codigo
// 	prod_prefijo
// 	prod_nombre
// 	prod_descripcion	
// 	prod_valor
// 	prod_valor_pronto_pago
// 	prod_procent_pronto_pago
// 	prod_stock
// 	prod_estado

// NOMBRE DE LA CLASE 
// 	Producto

// AJAX
// 	producto

// NAMES DE LOS INPUTS
// 	prod_id
// 	codigo
// 	prefijo
// 	nombre
// 	desc
// 	valor
// valorptopago 
// porcptopago
// 	stock


require_once "../modelos/Producto.php";

$producto = new Producto();

$prod_id         		= isset($_POST['prod_id'])? limpiarCadena($_POST['prod_id']):"";
$prod_codigo 			= isset($_POST['codigo'])? limpiarCadena($_POST['codigo']):"";
$prod_prefijo 			= isset($_POST['prefijo'])? limpiarCadena($_POST['prefijo']):"";
$prod_nombre 	 		= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$prod_descripcion 		= isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";
$prod_valor 			= isset($_POST['valor'])? limpiarCadena($_POST['valor']):"";
$prod_stock 			= isset($_POST['stock'])? limpiarCadena($_POST['stock']):"";
$prod_valor_pronto_pago = isset($_POST['valorptopago'])? limpiarCadena($_POST['valorptopago']):"";
$prod_personalizado 	= isset($_POST['personalizado'])? limpiarCadena($_POST['personalizado']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($prod_id)) {
			$respuesta = $producto->insertar(
				$prod_id, 
				$prod_codigo, 
				$prod_prefijo, 
				$prod_nombre,
				$prod_descripcion,
				$prod_valor,
				$prod_valor_pronto_pago,
				$prod_stock,
				$prod_personalizado
			);
			echo $respuesta ? "Producto registrado" : "Producto no se pudo registrar"; 
		}else{
			$respuesta = $producto->editar(
				$prod_id, 
				$prod_codigo, 
				$prod_prefijo, 
				$prod_nombre,
				$prod_descripcion,
				$prod_valor,
				$prod_valor_pronto_pago,
				$prod_stock,
				$prod_personalizado
			);
			echo $respuesta ? "Producto actualizado" : "Producto no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $producto->desactivar($prod_id);
		echo $respuesta ? "Producto desactivada" : "Producto no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $producto->activar($prod_id);
		echo $respuesta ? "Producto activada" : "Producto no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $producto->mostrar($prod_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		
		if($_GET['filtro'] == 1) 
		{
			$respuesta = $producto->listar();
		}
		else if($_GET['filtro'] == 2)
		{
			$respuesta = $producto->listarPersonalizados();
		}
		else
		{
			$respuesta = $producto->listarActivos();
		}

		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->prod_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->prod_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->prod_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->prod_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->prod_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->prod_id,
				"2"=>$reg->prod_codigo,
				"3"=>$reg->prod_prefijo,
				"4"=>$reg->prod_nombre,
				"5"=>$reg->prod_descripcion,
				"6"=>'$ '.number_format($reg->prod_valor),
				"7"=>'$ '.number_format($reg->prod_valor_pronto_pago), 
				"8"=>($reg->prod_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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
	
	
}

?>