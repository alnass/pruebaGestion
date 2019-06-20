<?php 
// session_start();
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

// Incluir la conexion a BDs
require '../config/conexion.php';

Class Producto {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar(
			$prod_id, 
			$prod_codigo, 
			$prod_prefijo, 
			$prod_nombre,
			$prod_descripcion,	
			$prod_valor,
			$prod_valor_pronto_pago,
			$prod_stock,
			$prod_personalizado
		){

		$sql = "INSERT INTO producto (
					prod_id, 
					prod_codigo, 
					prod_prefijo, 
					prod_nombre,
					prod_descripcion,	
					prod_valor,
					prod_valor_pronto_pago,
 					prod_stock,
 					prod_personalizado
 					)
				VALUES (
					null, 
					'$prod_codigo', 
					'$prod_prefijo', 
					'$prod_nombre',
					'$prod_descripcion',	
					'$prod_valor',
					'$prod_valor_pronto_pago',
 					'$prod_stock',
 					'$prod_personalizado'
 				)";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de edicion
	public function editar(
			$prod_id, 
			$prod_codigo, 
			$prod_prefijo, 
			$prod_nombre,
			$prod_descripcion,	
			$prod_valor,
			$prod_valor_pronto_pago,
			$prod_stock
		){

		$sql = "UPDATE producto 
				SET prod_codigo = '$prod_codigo', 
					prod_prefijo = '$prod_prefijo', 
					prod_nombre = '$prod_nombre',
					prod_descripcion = '$prod_descripcion',	
					prod_valor = '$prod_valor',
					prod_valor_pronto_pago = '$prod_valor_pronto_pago',
 					prod_stock = '$prod_stock' 
				WHERE prod_id = '$prod_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($prod_id){
		$sql = "UPDATE producto 
				SET prod_estado = '0'
				WHERE prod_id = '$prod_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($prod_id){
		$sql = "UPDATE producto 
				SET prod_estado = '1'
				WHERE prod_id = '$prod_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($prod_id){
		$sql = "SELECT * FROM producto
				WHERE prod_id = '$prod_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros}
	public function listar(){
		$sql = "SELECT * FROM producto";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros activos
	public function listarActivos(){
		$sql = "SELECT * FROM producto
				WHERE prod_estado = 1";

		return ejecutarConsulta($sql);
	}

	public function listarPersonalizados(){
		$sql = "SELECT * FROM producto
				WHERE prod_personalizado = 1";

		return ejecutarConsulta($sql);

		print_r($sql);
		die();
	}

	public function listarPorSede(){
		$sede = $_SESSION['usu_sede_id'];
		$sql = "SELECT 
				sp.sed_prod_id,
				sp.sed_prod_sede_id,
				sp.sed_prod_producto_id,
				p.prod_id,
				p.prod_codigo,
				p.prod_prefijo,
				p.prod_nombre,
				p.prod_descripcion,
				p.prod_valor,
				p.prod_valor_pronto_pago,
				p.prod_descuento_x_combo
				FROM sede_producto sp
				INNER JOIN producto p
				ON sp.sed_prod_producto_id = p.prod_id
				WHERE sed_prod_sede_id = '$sede'
				AND prod_estado = 1
			";

		return ejecutarConsulta($sql);
	}

	// Impementacion de metodo para listar registros y mostrar en el select
	public function select(){
		$sql = "SELECT * FROM producto
				where prod_estado = 1";

		return ejecutarConsulta($sql);
	}

}


?>