<?php 
// # encoded by @Francisco Monsalve
// NOMBRE DE LA TABLA
// 		persona

// MONBRE DE LOS CAMPOS
	// 1	per_id
	// 2	per_prefijo
	// 3	per_marca
	// 4	per_precinto
	// 5	per_tipo_persona_id
	// 6	per_tipo_cliente_id
	// 7	per_alianza_id
	// 8	per_tipo_documento_id
	// 9	per_num_documento
	// 10	per_fecha_exped_doc
	// 11	per_nombre
	// 12	per_apellido
	// 13	per_fecha_nacimiento
	// 14	per_telefono_1
	// 15	per_telefono_2
	// 16	per_ciudad_id
	// 17	per_barrio
	// 18	per_tipo_vivienda_id
	// 19	per_direccion
	// 20	per_correo_personal
	// 21	per_correo_corp
	// 22	per_usuario
	// 23	per_contrasenia
	// 24	per_estado

// NOMBRE DE LA CLASE
// 		Persona

// AJAX
// 		persona 

// NOMBRE DE LA TABLA
// 		registro_pqr

// MONBRE DE LOS CAMPOS
	// 		reg_pqr_id
	// 		reg_pqr_canal_id
	// 		reg_pqr_tipo_canal_id
	// 		reg_pqr_producto_id
	// 		reg_pqr_tipo_pqr_id
	// 		reg_pqr_categoria_pqr_id
	// 		reg_pqr_persona_id
	// 		reg_pqr_remitido_id
	// 		reg_pqr_num_radicado
	// 		reg_pqr_fecha_inicio
	// 		reg_pqr_fecha_remision
	// 		reg_pqr_fecha_fin
	// 		reg_pqr_ticket_interno
	// 		reg_pqr_operador_id
	// 		reg_pqr_dias_respuesta
	// 		reg_pqr_observacion
	// 		reg_pqr_estado_id

// NOMBRES DE LOS INPUTS DEL HTMPL
	// 		reg_pqr_id
	// 		canal
	// 		tipo_canal
	// 		producto
	// 		tipo_pqr
	// 		categoria
	// 		persona
	// 		remitido
	// 		num_radicado
	// 		fecha_inicio
	// 		fecha_remision
	// 		fecha_fin
	// 		ticket_interno
	// 		operador
	// 		dias
	// 		observacion
	// 		estado
	// -------------------------
	// 	 	per_id 		
	// 		prefijo 	
	// 		marca 		
	// 		precinto 	
	// 		tipoPersona 
	// 		tipoCliente 
	// 		alianza 	
	// 		tipoDoc 	
	// 		numDoc 		
	// 		expedDoc 	 
	// 		nombre 		
	// 		apellido 	 
	// 		nacimiento 	
	// 		tel1 		
	// 		tel2 		
	// 		ciudad 		 
	// 		barrio 		
	// 		tipoVivien 	
	// 		direccion 	
	// 		correoPer 	
	// 	 	correoCorp 	
	// 		usuario 	
	// 		pass 		
	// -------------------------

// Incluir la conexion a BDs
require '../config/conexion.php';

Class RegistroPqr {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar(
		$reg_pqr_id, 
		$reg_pqr_canal_id, 
		$reg_pqr_tipo_canal_id, 
		$reg_pqr_producto_id, 
		$reg_pqr_tipo_pqr_id,
		$reg_pqr_categoria_pqr_id,
		$reg_pqr_persona_id,
		$reg_pqr_remitido_id,
		$reg_pqr_num_radicado,
		$reg_pqr_fecha_inicio,
		$reg_pqr_fecha_remision,
		$reg_pqr_fecha_fin,
		$reg_pqr_ticket_interno,
		$reg_pqr_operador_id,
		$reg_pqr_dias_respuesta,
		$reg_pqr_observacion
	){
		$sql ="INSERT INTO registro_pqr (
				reg_pqr_id, 
				reg_pqr_canal_id, 
				reg_pqr_tipo_canal_id, 
				reg_pqr_producto_id, 
				reg_pqr_tipo_pqr_id,
				reg_pqr_categoria_pqr_id,
		 		reg_pqr_persona_id,
		 		reg_pqr_remitido_id,
		 		reg_pqr_num_radicado,
		 		reg_pqr_fecha_inicio,
		 		reg_pqr_fecha_remision,
		 		reg_pqr_fecha_fin,
		 		reg_pqr_ticket_interno,
		 		reg_pqr_operador_id,
		 		reg_pqr_dias_respuesta,
		 		reg_pqr_observacion
		 		)
			VALUES (
				null,
				'$reg_pqr_canal_id', 
				'$reg_pqr_tipo_canal_id', 
				'$reg_pqr_producto_id',
				'$reg_pqr_tipo_pqr_id',
				'$reg_pqr_categoria_pqr_id',
				'$reg_pqr_persona_id',
				'$reg_pqr_remitido_id',
				'$reg_pqr_num_radicado',
				'$reg_pqr_fecha_inicio',
				'$reg_pqr_fecha_remision',
				'$reg_pqr_fecha_fin',
				'$reg_pqr_ticket_interno',
				'$reg_pqr_operador_id',
				'$reg_pqr_dias_respuesta',
				'$reg_pqr_observacion')";
		
		return ejecutarConsulta($sql);
		
	}
	
	// Implementacion de metodo de edicion
	public function editar(
		$reg_pqr_id, 
		$reg_pqr_canal_id, 
		$reg_pqr_tipo_canal_id, 
		$reg_pqr_producto_id,
		$reg_pqr_tipo_pqr_id,
		$reg_pqr_categoria_pqr_id,
		$reg_pqr_persona_id,
		$reg_pqr_remitido_id,
		$reg_pqr_num_radicado,
		$reg_pqr_fecha_inicio,
		$reg_pqr_fecha_remision,
		$reg_pqr_fecha_fin,
		$reg_pqr_ticket_interno,
		$reg_pqr_operador_id,
		$reg_pqr_dias_respuesta,
		$reg_pqr_observacion
		
	){

		$sql = "UPDATE registro_pqr 
				SET reg_pqr_canal_id 		= '$reg_pqr_canal_id', 
					reg_pqr_tipo_canal_id 	= '$reg_pqr_tipo_canal_id', 
					reg_pqr_producto_id 	= '$reg_pqr_producto_id', 
					reg_pqr_tipo_pqr_id 	= '$reg_pqr_tipo_pqr_id',
					reg_pqr_categoria_pqr_id= '$reg_pqr_categoria_pqr_id',
			 		reg_pqr_persona_id 		= '$reg_pqr_persona_id',
			 		reg_pqr_remitido_id 	= '$reg_pqr_remitido_id',
			 		reg_pqr_num_radicado 	= '$reg_pqr_num_radicado',
			 		reg_pqr_fecha_inicio 	= '$reg_pqr_fecha_inicio',
			 		reg_pqr_fecha_remision 	= '$reg_pqr_fecha_remision',
			 		reg_pqr_fecha_fin 		= '$reg_pqr_fecha_fin',
			 		reg_pqr_ticket_interno 	= '$reg_pqr_ticket_interno',
			 		reg_pqr_operador_id 	= '$reg_pqr_operador_id',
			 		reg_pqr_dias_respuesta 	= '$reg_pqr_dias_respuesta',
			 		reg_pqr_observacion 	= '$reg_pqr_observacion'
			 		
				WHERE reg_pqr_id = '$reg_pqr_id'";

		return ejecutarConsulta($sql);
		
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($reg_pqr_id){
		$sql = "UPDATE registro_pqr 
				SET reg_pqr_estado_id = '0'
				WHERE reg_pqr_id = '$reg_pqr_id'";

		return ejecutarConsulta($sql);
	}

	//Trae el ultimo registro del ID de la tabla registro_pqr
	public function ultimo(){
		$sql = "SELECT MAX(reg_pqr_id) 
				AS reg_pqr_id 
				FROM registro_pqr";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($reg_pqr_id){
		$sql = "UPDATE registro_pqr 
				SET reg_pqr_estado_id = '1'
				WHERE reg_pqr_id = '$reg_pqr_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($per_id){
		// $sql = "SELECT * FROM registro_pqr
		// 		WHERE reg_pqr_id = '$reg_pqr_id'";
		
		$sql = "SELECT * FROM persona
				WHERE per_id = '$per_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros

	//  DESCRIPCION DE RELACION DE CAMPOS
		//  -------------------------------------------------------------------------------------
		// 	| ALIAS	| TABLA 	   | CAMPO 		 | RELACION			|							|
		//  -------------------------------------------------------------------------------------
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_id 				|
		// 	| c 	|canal 		   | can_id 	 |can_nombre 		|reg_pqr_canal_id 			|
		// 	| t 	|tipo_canal    | tip_can_id  |tip_can_nombre 	|reg_pqr_tipo_canal_id 		|
		// 	| p 	|producto      | prod_id 	 |prod_nombre 		|reg_pqr_producto_id 		|
		// 	| q 	|tipo_pqr      | tip_pqr_id  |tip_pqr_nombre 	|reg_pqr_tipo_pqr_id 		|
		// 	| a 	|categoria_pgr | cat_pqr_id  |cat_pqr_nombre 	|reg_pqr_categoria_pqr_id 	|
		// 	| e 	|persona       | per_id 	 |per_num_documento	|reg_pqr_persona_id 		|
		// 	| r 	|area          | are_id		 |are_nombre 		|reg_pqr_remitido_id 		|
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_num_radicado 		|
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_fecha_inicio 		|
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_fecha_remision 	|
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_fecha_fin 			|
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_ticket_interno 	|
		// 	| u 	|usuario_log   | usu_id		 | usu_num_documento|reg_pqr_operador_id 		|
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_dias_respuesta 	|
		// 	| pq	|XXXXXXXXXXXXX | XXXXXXXXXXX | 					|reg_pqr_observacion 		|
		// 	| s 	|estado_pqr    | est_pqr_id	 | est_pqr_nombre 	|reg_pqr_estado_id 			|
		//  -------------------------------------------------------------------------------------

	public function listar(){
		
		$sql = "SELECT
				p.per_id,	
				p.per_num_documento, 
				p.per_nombre ,
				p.per_apellido, 
				p.per_telefono_1 ,
				ci.ciu_nombre,
				p.per_direccion ,
				p.per_correo_personal,
				p.per_estado

			FROM persona p 

			INNER JOIN ciudad ci 
			ON p.per_ciudad_id	= ci.ciu_id
			";

		return ejecutarConsulta($sql);
	}

	public function numeroradicado(){

		// if (!empty($per_id)) {
		// 	// $sql = "SELECT * FROM registro_pqr
		// 	// ORDER BY reg_pqr_id 
		// 	// desc limit 1";

		// }
			$sql = "SELECT MAX(reg_pqr_id)+1 AS reg_pqr_id FROM registro_pqr";
		
			return ejecutarConsultaSimpleFila($sql);
		
	}

	public function correo($reg_pqr_remitido_id){

		$sql = "SELECT are_correo 
				FROM area
				WHERE are_id = '$reg_pqr_remitido_id'";

		return ejecutarConsultaSimpleFila($sql);
	}
	
	public function listarpqrusuario($per_id){
		$sql = "SELECT
					r.reg_pqr_id, 
					r.reg_pqr_fecha_inicio,
					p.per_nombre,
					p.per_apellido,
					p.per_num_documento,
					t.tip_pqr_nombre,
					c.cat_pqr_nombre,
					a.are_nombre,
					r.reg_pqr_num_radicado,
					r.reg_pqr_dias_respuesta,
					r.reg_pqr_fecha_fin,
					r.reg_pqr_observacion,
					r.reg_pqr_estado_id
				FROM registro_pqr r
				INNER JOIN persona p  
				ON r.reg_pqr_persona_id = p.per_id
				INNER JOIN tipo_pqr t
				ON r.reg_pqr_tipo_pqr_id = t.tip_pqr_id
				INNER JOIN categoria_pgr c
				ON r.reg_pqr_categoria_pqr_id = c.cat_pqr_id
				INNER JOIN area a
				ON r.reg_pqr_remitido_id = a.are_id
				WHERE reg_pqr_persona_id = '$per_id'";

		return ejecutarConsulta($sql);
	}

	public function listarcontrato($per_id){

		$sql = "SELECT * FROM contrato
				WHERE cont_persona_id = '$per_id'
				";

		return ejecutarConsulta($sql);
	}

	public function listarproductos($cont_id){

		$sql = "SELECT p.prod_id,
					p.prod_nombre,
					p.prod_descripcion,
					p.prod_valor,
					p.prod_valor_pronto_pago
				FROM contrato_producto cp
				INNER JOIN producto p 
				ON cp.cont_prod_producto_id = p.prod_id
				WHERE cont_prod_contrato_id = '$cont_id'
				";
		return ejecutarConsulta($sql);
	}

	public function listarestadoservicio($cont_id){

		$sql = "SELECT es.cc_est_ser_id,
					es.cc_est_ser_estado_id,
					es.cc_est_ser_fecha,
					s.est_serv_nombre
				FROM cc_estado_servicio es
				INNER JOIN estado_servicio s
				ON s.est_serv_id = es.cc_est_ser_estado_id
				WHERE cc_est_ser_contrato_id = '$cont_id'
				";

		return ejecutarConsulta($sql);
	}

	public function insertarnotificacion($not_area_envio_id, 
		$not_area_recibe_id, 
		$not_observación_id){
		
		$sql = "INSERT INTO notificacones(
			not_id,
			not_area_envio_id,
			not_area_recibe_id,
			not_observación_id
			)VALUES(
			null,
			'$not_area_envio_id',
			'$not_area_recibe_id',
			'$not_observación_id'
			)";

		return ejecutarConsulta($sql);
	}
}
?>