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
// 	prod_stock
// 	prod_estado

// NOMBRE DEL CAMPO ID DE CONTRATO
// 	cont_id

// NOMBRE DE LA CLASE 
// 	Sedeproducto

// NOMBRE DE LA TABLA 
// 	sede_producto

// NOMBRES DE LOS CAMPOS DE LA TABLA SEDE-PRODUCTO
// 	sed_prod_id
// 	sed_prod_sede_id	
// 	sed_prod_producto_id
//  sed_prod_usuario_id

// Incluir la conexion a BDs
require '../config/conexion.php';

Class Sedeproducto {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar(
			$sed_prod_id,
			$sed_prod_sede_id,
			$sed_prod_producto_id,
			$sed_prod_usuario_id
			){

		$num_elementos = 0;
		$sw = true;

		while ( $num_elementos < count($sed_prod_producto_id)) {
			
			$sql = "INSERT INTO sede_producto (
					 	sed_prod_sede_id,	
					 	sed_prod_producto_id,
					 	sed_prod_usuario_id
						)
					VALUES (
						'$sed_prod_sede_id[$num_elementos]', 
						'$sed_prod_producto_id[$num_elementos]', 
						'$sed_prod_usuario_id'
						)";

			ejecutarConsulta($sql) or $sw = false;
			$num_elementos++;
		}

		return $sw;
	}

	// Implementacion de metodo de edicion
	// public function editar(
	// 		$prod_id, 
	// 		$prod_codigo, 
	// 		$prod_prefijo, 
	// 		$prod_nombre,
	// 		$prod_descripcion,	
	// 		$prod_valor,
	// 		$prod_stock){

	// 	$sql = "UPDATE sede_producto 
	// 			SET prod_codigo = '$prod_codigo', 
	// 				prod_prefijo = '$prod_prefijo', 
	// 				prod_nombre = '$prod_nombre',
	// 				prod_descripcion = '$prod_descripcion',	
	// 				prod_valor = '$prod_valor',
 // 					prod_stock = '$prod_stock' 
	// 			WHERE prod_id = '$prod_id'";

	// 	return ejecutarConsulta($sql);
	// }

	// // Implementacion de metodo de desactivacion
	// public function desactivar($prod_id){
	// 	$sql = "UPDATE sede_producto 
	// 			SET prod_estado = '0'
	// 			WHERE prod_id = '$prod_id'";

	// 	return ejecutarConsulta($sql);
	// }

	// // Implementacion de metodo de activacion
	// public function activar($prod_id){
	// 	$sql = "UPDATE sede_producto 
	// 			SET prod_estado = '1'
	// 			WHERE prod_id = '$prod_id'";

	// 	return ejecutarConsulta($sql);
	// }

	// // Implementacion de metodo para mostrar los datos de un registro a modificar
	// public function mostrar($prod_id){
	// 	$sql = "SELECT * FROM sede_producto
	// 			WHERE prod_id = '$prod_id'";

	// 	return ejecutarConsultaSimpleFila($sql);
	// }

	// Impementacion de metodo para listar registros
// NOMBRES DE LOS CAMPOS DE LA TABLA SEDE-PRODUCTO
// 	sed_prod_id
// 	sed_prod_sede_id	
// 	
//  sed_prod_usuario_id

// FK de las tablas relacionadas 
	// sed_id 
	// prod_id 

	public function listar(){
		$sql = "SELECT 
					sp.sed_prod_id,
					p.prod_nombre,
					p.prod_descripcion,
					p.prod_valor,
					s.sed_nombre,
					s.sed_direccion
					FROM sede_producto sp 
					INNER JOIN producto p
					ON sp.sed_prod_producto_id = p.prod_id
					INNER JOIN sede s
					ON sp.sed_prod_sede_id = s.sed_id
				";

		return ejecutarConsulta($sql);
	}

	// // Impementacion de metodo para listar registros activos
	// public function listarActivos(){
	// 	$sql = "SELECT * FROM sede_producto
	// 			WHERE prod_estado = 1";

	// 	return ejecutarConsulta($sql);
	// }

	// // Impementacion de metodo para listar registros y mostrar en el select
	// public function select(){
	// 	$sql = "SELECT * FROM sede_producto
	// 			where prod_estado = 1";

	// 	return ejecutarConsulta($sql);
	// }

}


?>