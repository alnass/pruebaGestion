<?php 
session_start();
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// seguimiento_pqr 

// NOMBRE DE LOS CAMPOS
// 		seg_id
// 		seg_registro_pqr_id
// 		seg_area_remite_id
// 		seg_area_recibe_id
// 		seg_responsable
// 		seg_fecha_envio
// 		seg_fecha_revision
// 		seg_observacion

// NOMBRES DE LOS INPUTS

// NOMBRE DE LA CLASE
// 		SeguimientoPrq

// NOMBREDE AJAX 
// 		seguimientoPqr

// Incluir la conexion a BDs
require '../config/conexion.php';

Class SeguimientoPqr {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar(
		$seg_id,
		$seg_registro_pqr_id,
		$seg_area_remite_id,
		$seg_area_recibe_id,
		$seg_responsable,
		$seg_fecha_envio,
		$seg_fecha_revision,
		$seg_observacion

	){
		$sql ="INSERT INTO seguimiento_pqr (
				seg_id,
				seg_registro_pqr_id,
				seg_area_remite_id,
				seg_area_recibe_id,
				seg_responsable,
				seg_fecha_envio,
				seg_fecha_revision,
				seg_observacion
		 		)
			VALUES (
				null,
				'$seg_registro_pqr_id',
				'$seg_area_remite_id',
				'$seg_area_recibe_id',
				'$seg_responsable',
				'$seg_fecha_envio',
				'$seg_fecha_revision',
				'$seg_observacion'
				)";
		
		ejecutarConsulta($sql);

		$sw = true;

		$sql_update = "UPDATE registro_pqr
				SET	reg_pqr_remitido_id = '$seg_area_recibe_id'
				WHERE 	reg_pqr_id = '$seg_registro_pqr_id'
				";
		ejecutarConsulta($sql_update);
		
		return $sw;
	}
	
	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($reg_pqr_id){

// MONBRE DE LOS CAMPOS
// 		reg_pqr_id 				|r |
// 		reg_pqr_canal_id  		|c | canal	  		| can_id	
// 		reg_pqr_tipo_canal_id 	|tc| tipo_canal 	| tip_can_id
// 		reg_pqr_producto_id 	|p | producto 		| prod_id
// 		reg_pqr_tipo_pqr_id 	|tp| tipo_pqr 		| tip_pqr_id
// 		reg_pqr_categoria_pqr_id|cp| categoria_pgr 	| cat_pqr_id
// 		reg_pqr_persona_id 		|pe| persona 		| per_id 
// 		reg_pqr_remitido_id 	|a | area 			| are_id
// 		reg_pqr_num_radicado 	|r |
// 		reg_pqr_fecha_inicio 	|r | 
// 		reg_pqr_fecha_remision 	|r |
// 		reg_pqr_fecha_fin 		|r |
// 		reg_pqr_ticket_interno 	|r |
// 		reg_pqr_operador_id 	|u |usuario_log		| usu_id
// 		reg_pqr_observacion 	|r |
// 		reg_pqr_estado_id 		|  |
				
		$sql = "SELECT 
				r.reg_pqr_id,
				c.can_nombre,
				tc.tip_can_nombre,
				p.prod_nombre,
				tp.tip_pqr_nombre,
				cp.cat_pqr_nombre,
				pe.per_nombre,
				pe.per_apellido,
				pe.per_direccion,
				pe.per_telefono_1,
				pe.per_correo_personal,
				a.are_nombre,
				r.reg_pqr_num_radicado,
				r.reg_pqr_fecha_inicio,
				r.reg_pqr_fecha_remision,
				r.reg_pqr_fecha_fin,
				r.reg_pqr_ticket_interno,
				r.reg_pqr_dias_respuesta,
				u.usu_nombre,
				u.usu_apellido,
				r.reg_pqr_observacion
				FROM registro_pqr r 
				INNER JOIN canal c 
				ON c.can_id = r.reg_pqr_canal_id
				INNER JOIN tipo_canal tc
				ON tc.tip_can_id = r.reg_pqr_tipo_canal_id
				INNER JOIN producto p
				ON p.prod_id = r.reg_pqr_producto_id
				INNER JOIN tipo_pqr tp
				ON tp.tip_pqr_id = r.reg_pqr_tipo_pqr_id
				INNER JOIN categoria_pgr cp
				ON cp.cat_pqr_id = r.reg_pqr_categoria_pqr_id
				INNER JOIN persona pe
				ON pe.per_id = r.reg_pqr_persona_id
				INNER JOIN area a 
				ON a.are_id = r.reg_pqr_remitido_id
				INNER JOIN usuario_log u
				ON u.usu_id = r.reg_pqr_operador_id
				WHERE reg_pqr_id = '$reg_pqr_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros

	public function listar(){
		
		if ($_SESSION['usu_area_id'] == 5) {
			
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
				ON r.reg_pqr_remitido_id = a.are_id";

		return ejecutarConsulta($sql);
		}else{
			$area = $_SESSION['usu_area_id'];
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
					r.reg_pqr_remitido_id,
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
				WHERE reg_pqr_remitido_id = '$area'"
				;

		return ejecutarConsulta($sql);
		}
	}

// NOMBRE DE LOS CAMPOS
//seg_id 				|s|
//seg_registro_pqr_id 	|
//seg_area_remite_id 	|
//seg_area_recibe_id 	|a|area| are_id| are_nombre|
//seg_responsable 		|u|usuario_log | usu_id | usu_nombre  usu_apellido
//seg_fecha_envio 		|s|
//seg_fecha_revision 	|
//seg_observacion 		|s|

	public function listarseguimiento($reg_pqr_id){
		// $sql = "SELECT * FROM seguimiento_pqr
		// 		WHERE seg_registro_pqr_id = '$reg_pqr_id'";

		$sql = "SELECT 
					s.seg_id,
					s.seg_registro_pqr_id,
					a.are_nombre,
					u.usu_nombre,
					u.usu_apellido,
					s.seg_fecha_envio,
					s.seg_observacion
				FROM seguimiento_pqr s
				INNER JOIN area a 
				ON s.seg_area_recibe_id = a.are_id
				INNER JOIN usuario_log u
				ON s.seg_responsable = u.usu_id
				WHERE seg_registro_pqr_id = '$reg_pqr_id'";

		return ejecutarConsulta($sql);
	}

	public function cerrarpqr($reg_pqr_id){

		$sql = "UPDATE registro_pqr
				SET 	reg_pqr_estado_id = 2
				WHERE 	reg_pqr_id = '$reg_pqr_id'
				";
				
		return ejecutarConsulta($sql);
	}

}
?>
