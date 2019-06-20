<?php 
session_start();
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA
// 	producto

// NOMBRE DE LA CLASE 
// 	Sedeproducto

// NOMBRE DE LA TABLA 
// 	sede_producto

// NOMBRES DE LOS CAMPOS DE LA TABLA SEDE-PRODUCTO
// 	sed_prod_id
// 	sed_prod_sede_id	
// 	sed_prod_producto_id
//  sed_prod_usuario_id

// NOMBRE DE LA CLASE
//  Sedeproducto


require_once "../modelos/Sedeproducto.php";

$sedeproducto = new Sedeproducto();

$sed_prod_sede_id		= isset($_POST['sede_id'])? limpiarCadena($_POST['sede_id']):"";
$sed_prod_producto_id	= isset($_POST['producto_id'])? limpiarCadena($_POST['producto_id']):"";
$sed_prod_usuario_id	= $_SESSION['usu_id'];


switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($sede_id)) {
			$respuesta = $sedeproducto->insertar(
				$sed_prod_sede_id,		
				$sed_prod_producto_id,
				$sed_prod_usuario_id
			);
			echo $respuesta ? "Se han asignado los productos correctamente" : "No ha sido posible asignar los productos"; 
		}else{
			$respuesta = $sedeproducto->editar(
				$sed_prod_sede_id,		
				$sed_prod_producto_id,
				$sed_prod_usuario_id
			);
			echo $respuesta ? "Se han asignado los productos correctamente" : "No ha sido posible asignar los productos";
		}
		break;

	case 'desactivar':
		$respuesta = $sedeproducto->desactivar($prod_id);
		echo $respuesta ? "sedeproducto desactivada" : "Producto no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $sedeproducto->activar($prod_id);
		echo $respuesta ? "Producto activada" : "Producto no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $sedeproducto->mostrar($prod_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $sedeproducto->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>$reg->sed_prod_id,
				"1"=>$reg->prod_nombre,
				"2"=>$reg->prod_descripcion,
				"3"=>$reg->prod_valor,
				"4"=>$reg->sed_nombre,
				"5"=>$reg->sed_direccion,
				"6"=>'Pendiente vinculo'
				
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
		
	case 'listarActivos':

		// Se instancia la clase Producto de modelos 
		require_once "../modelos/Sedeproducto.php";
		// Se crea el objeto producto 
		$producto = new Producto();

		$respuesta = $producto->listarActivos();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->prod_id.',\''.$reg->prod_nombre.'\',\''.$reg->prod_descripcion.'\','.$reg->prod_valor.')"><i class="fa fa-plus"></i></button>',
				"1"=>$reg->prod_codigo,
				"2"=>$reg->prod_prefijo,
				"3"=>$reg->prod_nombre,
				"4"=>$reg->prod_descripcion,
				"5"=>$reg->prod_valor
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