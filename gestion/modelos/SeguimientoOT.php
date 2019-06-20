<?php /*session_start();*/
// # encodé par @Anderson Ferrucho 
/*
ord_trab_id 
ord_trab_fecha_elaboracion
ord_trab_fecha_programacion	
ord_trab_fecha_vencimiento
ord_trab_operacion_id
ord_trab_contrato_id
ord_trab_responsable_id
ord_trab_observacion
ord_estado
*/

// Se incluye la conexion a la BD

require '../config/conexion.php';

Class SeguimientoOT
{
	public function __construct(){
	}

/// Query utilizado al insertar desde generar producto a una orden de trabajo emitida desde caja actualiza al técnico de la tabla principal 
		public function insertar(
			$ots_id,
			$ord_trab_id,
			$ord_trab_nuevo_vencimiento,
			$ot_vencia,
			$ots_operacion_id,
			$ots_contrato_id,
			$ots_responsable_id,
			$ots_observacion,
			$usu_id,
			$resp_activ)
		{
			// crea la variable con el query de inserción
			$sql = "INSERT INTO orden_trabajo_seguimiento(
						ots_id,
						ots_ord_trab_id,
						ots_operacion_id,
						ots_contrato_id,
						ots_responsable_id,
						ots_observacion,
						ots_obsv_usu_id,
						ot_fecha_vencia)
					VALUES(
						null,
						'$ord_trab_id',
						'$ots_operacion_id',
						'$ots_contrato_id',
						'$ots_responsable_id',
						'$ots_observacion',
						'$usu_id',
						'$ot_vencia')";

			ejecutarConsulta($sql);
			// query para actualizar la tabla de orden de trabajo

			$sql_update = "UPDATE orden_trabajo 
							SET
								ord_trab_fecha_vencimiento 	= '$ord_trab_nuevo_vencimiento',
								ord_trab_tecnico_id 		= '$ots_responsable_id',
								ord_trab_resp_activ_id 		= '$resp_activ'
							WHERE
								ord_trab_id		=	'$ord_trab_id'";

			ejecutarConsulta($sql_update);


			$sql_contrato = "UPDATE contrato
					SET cont_estado_servicio_id = '$ots_operacion_id'
					WHERE cont_id = '$ots_contrato_id'";

			ejecutarConsulta($sql_contrato);

			return true;

		}

// query utilizado para insertar datos desde el seguimiento a una orden de trabajo activa no actualiza al tecnico en la tabla principal 

		public function insertar2(
			$ots_id,
			$ord_trab_id,
			$ord_trab_nuevo_vencimiento,
			$ot_vencia,
			$ots_operacion_id,
			$ots_contrato_id,
			$ots_responsable_id,
			$ots_observacion,
			$usu_id)
		{
			$sql = "INSERT INTO orden_trabajo_seguimiento(
						ots_id,
						ots_ord_trab_id,
						ots_operacion_id,
						ots_contrato_id,
						ots_responsable_id,
						ots_observacion,
						ots_obsv_usu_id,
						ot_fecha_vencia)
					VALUES(
						null,
						'$ord_trab_id',
						'$ots_operacion_id',
						'$ots_contrato_id',
						'$ots_responsable_id',
						'$ots_observacion',
						'$usu_id',
						'$ot_vencia')";

			ejecutarConsulta($sql);

			$sql_update = "UPDATE orden_trabajo 
							SET
								ord_trab_fecha_vencimiento 	= '$ord_trab_nuevo_vencimiento',
								ord_trab_resp_activ_id 		= '$usu_id'
							WHERE
								ord_trab_id		=	'$ord_trab_id'";

			ejecutarConsulta($sql_update);


			$sql_contrato = "UPDATE contrato
					SET cont_estado_servicio_id = '$ots_operacion_id'
					WHERE cont_id = '$ots_contrato_id'";

			ejecutarConsulta($sql_contrato);

			return true;

		}

// funcion para insertar almacenar una orden de trabajo con un equipo asignado
		public function insertarOTconEquipo(
			$ots_id,
			$ord_trab_id,
			$ord_trab_nuevo_vencimiento,
			$ot_vencia,
			$ots_operacion_id,
			$ots_contrato_id,
			$ots_responsable_id,
			$ots_observacion,
			$usu_id,
			$id_detalle_equipo, 
			$cliente)
		{
			// query para la inserción de datos a la tabla 

			$sql = "INSERT INTO orden_trabajo_seguimiento(
						ots_id,
						ots_ord_trab_id,
						ots_operacion_id,
						ots_contrato_id,
						ots_responsable_id,
						ots_observacion,
						ots_obsv_usu_id,
						ot_fecha_vencia)
					VALUES(
						null,
						'$ord_trab_id',
						'$ots_operacion_id',
						'$ots_contrato_id',
						'$ots_responsable_id',
						'$ots_observacion',
						'$usu_id',
						'$ot_vencia')";

			ejecutarConsulta($sql);

			$id_ot = $ord_trab_id;

			$num_elementos 	= 	0;

			while($num_elementos < count($id_detalle_equipo))
			{
				$sql_ot_equipo 	= 	"INSERT INTO orden_trabajo_equipo(
							ot_equi_id,
							ot_equi_ord_trab_id,
							ot_equi_equi_det_id,
							ot_equi_propiedad,
							ot_equi_cont_id
						)
						VALUES(
							null,
							'$id_ot',
							'$id_detalle_equipo[$num_elementos]',
							'$cliente[$num_elementos]',
							'$ots_contrato_id'
						)";

				ejecutarConsulta($sql_ot_equipo);

				$update_equipo 	= 	"UPDATE equipo_detalle 
							SET
								equi_det_estado_id 	= 	1
							WHERE
								equi_det_id			=	'$id_detalle_equipo[$num_elementos]'";		

				$num_elementos++;
				
				
				ejecutarConsulta($update_equipo);
			}
		
			$sql_update = "UPDATE orden_trabajo 
							SET
								ord_trab_fecha_vencimiento 	= '$ord_trab_nuevo_vencimiento',
								ord_trab_tecnico_id 		= '$ots_responsable_id',
								ord_trab_resp_activ_id 		= '$usu_id'
							WHERE
								ord_trab_id		=	'$ord_trab_id'";

			ejecutarConsulta($sql_update);

			$sql_contrato = "UPDATE contrato
					SET cont_estado_servicio_id = '$ots_operacion_id'
					WHERE cont_id = '$ots_contrato_id'";

			ejecutarConsulta($sql_contrato);

			return true;	
		}

		public function editar(
			$ord_trab_id,
			$ord_trab_fecha_programacion,
			$ord_trab_fecha_vencimiento,
			$ord_trab_operacion_id,
			$ord_trab_contrato_id,
			$ord_trab_responsable_id,
			$ord_trab_observacion
		)
		{
			$sql = "UPDATE orden_trabajo
					SET 
						ord_trab_fecha_programacion		=	'$ord_trab_fecha_programacion',
						ord_trab_fecha_vencimiento 		= 	'$ord_trab_fecha_vencimiento',
						ord_trab_operacion_id 			=	'$ord_trab_operacion_id',
						ord_trab_contrato_id			=	'$ord_trab_contrato_id',
						ord_trab_responsable_id 		= 	'$ord_trab_responsable_id',
						ord_trab_observacion 			= 	'$ord_trab_observacion'
					WHERE
						ord_trab_id 					= 	'$ord_trab_id'";

			return ejecutarConsulta($sql);
		}

		public function mostrar($ord_trab_id)	
		{
			$sql	=	"SELECT con.cont_id,
								con.cont_no_contrato,
								con.cont_valor_basico_mes,
								con.cont_adicional,
								per.per_id,
								td.tip_doc_nombre,
								per.per_marca,
								ali.ali_nombre,
								per.per_num_documento,
								per.per_nombre,
								per.per_apellido,
								con.cont_vigencia_a_partir,
								per.per_telefono_1,
								per.per_telefono_2,
								per.per_barrio,
								ot.ord_trab_id,
								ot.ord_trab_fecha_programacion,
								ot.ord_trab_fecha_elaboracion,
								ot.ord_trab_fecha_vencimiento,
								op.est_serv_nombre as operacion,
								ot.ord_trab_observacion,
								tv.tip_viv_nombre,
								per.per_direccion,
								ciu.ciu_nombre,
								con.cont_direccion_serv,
								con.cont_barrio,
								per.per_correo_personal, 
								es.est_serv_nombre,
								es.est_serv_id,
                                conprod.cont_prod_id,
                                prod.prod_nombre,
                                sed.sed_nombre,
                                ur.usu_id as usu_resp_id,
								ur.usu_nombre as usu_resp_nombre,
								ur.usu_apellido as usu_resp_apellido,
								ut.usu_id,
								ut.usu_nombre,
								ut.usu_apellido
						FROM 	orden_trabajo ot
						INNER JOIN contrato con 
						ON 		con.cont_id 	= 	ot.ord_trab_contrato_id
						INNER JOIN persona per 
						ON 		per.per_id 	= 	con.cont_persona_id
						INNER JOIN estado_servicio op 
						ON 		op.est_serv_id 	= 	ot.ord_trab_operacion_id
						INNER JOIN ciudad ciu 
						ON 		ciu.ciu_id 	= 	per.per_ciudad_id
						INNER JOIN alianza ali 
						ON 		ali.ali_id 	= 	per.per_alianza_id
						INNER JOIN estado_servicio es 
						ON 		es.est_serv_id 	= 	con.cont_estado_servicio_id
						INNER JOIN contrato_producto conprod 
						ON 		conprod.cont_prod_contrato_id = con.cont_id
                        INNER JOIN producto prod 
						ON 		prod.prod_id = 	conprod.cont_prod_producto_id
						INNER JOIN tipo_vivienda tv
						ON 		tv.tip_viv_id = per.per_tipo_vivienda_id
						INNER JOIN usuario_log ut
						ON 		ut.usu_id = ot.ord_trab_tecnico_id
						INNER JOIN usuario_log ur
						ON 		ur.usu_id = ot.ord_trab_responsable_id
						INNER JOIN tipo_documento td
						ON 		td.tip_doc_id = per.per_tipo_documento_id
						INNER JOIN sede sed
						ON 		sed.sed_id = con.cont_sede_id
						WHERE 	ord_trab_id 	= 	'$ord_trab_id'";

			return ejecutarConsultaSimpleFila($sql);
		}

		public function mostrarOT($ord_trab_id)	
		{
			$sql	=	"SELECT con.cont_id,
								con.cont_no_contrato,
								con.cont_adicional,
								con.cont_valor_basico_mes,
								per.per_id,
								td.tip_doc_nombre,
								per.per_marca,
								ali.ali_nombre,
								per.per_num_documento,
								per.per_nombre,
								per.per_apellido,
								con.cont_vigencia_a_partir,
								per.per_telefono_1,
								op.est_serv_nombre as operacion,
								per.per_telefono_2,
								per.per_barrio,
								ot.ord_trab_id,
								ot.ord_trab_fecha_programacion,
								ot.ord_trab_fecha_vencimiento,
								ot.ord_trab_observacion,
								tv.tip_viv_nombre,
								per.per_direccion,
								ciu.ciu_nombre,
								con.cont_direccion_serv,
								con.cont_barrio,
								per.per_correo_personal, 
								es.est_serv_nombre,
								es.est_serv_id,
                                conprod.cont_prod_id,
                                prod.prod_nombre,
                                sed.sed_nombre,
								ut.usu_id,
								ut.usu_nombre,
								ut.usu_apellido,
								ut.usu_num_documento
						FROM 	orden_trabajo ot
						INNER JOIN contrato con 
						ON 		con.cont_id 	= 	ot.ord_trab_contrato_id
						INNER JOIN persona per 
						ON 		per.per_id 	= 	con.cont_persona_id
						INNER JOIN ciudad ciu 
						ON 		ciu.ciu_id 	= 	per.per_ciudad_id
						INNER JOIN alianza ali 
						ON 		ali.ali_id 	= 	per.per_alianza_id
						INNER JOIN estado_servicio es 
						ON 		es.est_serv_id 	= 	con.cont_estado_servicio_id
						INNER JOIN estado_servicio op 
						ON 		op.est_serv_id 	= 	ot.ord_trab_operacion_id
						INNER JOIN contrato_producto conprod 
						ON 		conprod.cont_prod_contrato_id = con.cont_id
                        INNER JOIN producto prod 
						ON 		prod.prod_id = 	conprod.cont_prod_producto_id
						INNER JOIN tipo_vivienda tv
						ON 		tv.tip_viv_id = per.per_tipo_vivienda_id
						INNER JOIN usuario_log ut
						ON 		ut.usu_id = ot.ord_trab_tecnico_id
						INNER JOIN tipo_documento td
						ON 		td.tip_doc_id = per.per_tipo_documento_id
						INNER JOIN sede sed
						ON 		sed.sed_id = con.cont_sede_id
						WHERE 	ord_trab_id 	= 	'$ord_trab_id'";

			return ejecutarConsultaSimpleFila($sql);
		}
	


		public function mostrarOTCerrada($ord_trab_id)	
		{
			$sql	=	"SELECT con.cont_id,
								con.cont_no_contrato,
								con.cont_adicional,
								con.cont_valor_basico_mes,
								per.per_id,
								td.tip_doc_nombre,
								per.per_marca,
								ali.ali_nombre,
								per.per_num_documento,
								per.per_nombre,
								per.per_apellido,
								con.cont_vigencia_a_partir,
								per.per_telefono_1,
								per.per_telefono_2,
								otc.ord_trab_cie_fecha,
								per.per_barrio,
								ot.ord_trab_id,
								esi.est_serv_nombre as est_serv_inic,
								ot.ord_trab_fecha_programacion,
								ot.ord_trab_fecha_vencimiento,
								ot.ord_trab_fecha_elaboracion,
								ot.ord_trab_observacion,
								tv.tip_viv_nombre,
								per.per_direccion,
								ciu.ciu_nombre,
								con.cont_direccion_serv,
								con.cont_barrio,
								per.per_correo_personal, 
								es.est_serv_nombre,
								es.est_serv_id,
                                conprod.cont_prod_id,
                                prod.prod_nombre,
                                sed.sed_nombre,
								ut.usu_id,
								ut.usu_nombre,
								ut.usu_apellido,
								ut.usu_num_documento
						FROM 	orden_trabajo ot
						INNER JOIN contrato con 
						ON 		con.cont_id 	= 	ot.ord_trab_contrato_id
						INNER JOIN persona per 
						ON 		per.per_id 	= 	con.cont_persona_id
						INNER JOIN ciudad ciu 
						ON 		ciu.ciu_id 	= 	per.per_ciudad_id
						INNER JOIN alianza ali 
						ON 		ali.ali_id 	= 	per.per_alianza_id
						INNER JOIN estado_servicio es 
						ON 		es.est_serv_id 	= 	con.cont_estado_servicio_id
						INNER JOIN estado_servicio esi 
						ON 		esi.est_serv_id 	= 	ot.ord_trab_operacion_id
						INNER JOIN contrato_producto conprod 
						ON 		conprod.cont_prod_contrato_id = con.cont_id
						INNER JOIN orden_trabajo_cierres otc
						ON 		otc.ord_trab_ot_id = ot.ord_trab_id
                        INNER JOIN producto prod 
						ON 		prod.prod_id = 	conprod.cont_prod_producto_id
						INNER JOIN tipo_vivienda tv
						ON 		tv.tip_viv_id = per.per_tipo_vivienda_id
						INNER JOIN usuario_log ut
						ON 		ut.usu_id = ot.ord_trab_tecnico_id
						INNER JOIN tipo_documento td
						ON 		td.tip_doc_id = per.per_tipo_documento_id
						INNER JOIN sede sed
						ON 		sed.sed_id = con.cont_sede_id
						WHERE 	ord_trab_id 	= 	'$ord_trab_id'";

			return ejecutarConsultaSimpleFila($sql);
		}




	// RELACION DE LA TABLA contrato_producto
	// ---------------------------------------------------------------------
	// |ALIAS 	|	TABLA 	 		|	CAMPO 		|	RELACION			|
	// ---------------------------------------------------------------------
	// |conprod	|contrato_producto	|cont_prod_id 	|cont_prod_contrato_id	|
	// ---------------------------------------------------------------------
	// |prod 	|producto 			|prod_id 		|cont_prod_producto_id	|
	// ---------------------------------------------------------------------
	

		public function listarProducto($cont_id)	
		{
			$sql	=	"SELECT conprod.cont_prod_id,
                                prod.prod_nombre
						FROM 	contrato_producto conprod 
						INNER JOIN producto prod 
						ON 		prod.prod_id = 	conprod.cont_prod_producto_id
						WHERE 	cont_prod_contrato_id 	= 	'$cont_id'";

			return ejecutarConsulta($sql);
		}

		public function listarActivos()
		{
			$sql 	=	"SELECT * FROM orden_trabajo
						WHERE ord_estado = 1";

			return ejecutarConsulta($sql);
		}

		public function select()
		{
			$sql 	= 	"SELECT * FROM orden_trabajo
						WHERE ord_estado = 1";

			return ejecutarConsulta($sql);
		}

		public function listarOTS($ord_trab_id)
		{
			$sql 	= 	"SELECT 
							ots.ots_id,
							ots.ots_fecha_elaboracion,
							es.est_serv_nombre,
							ut.usu_nombre as usu_tec,
                            ut.usu_apellido as usu_tec_apel,
							ur.usu_nombre as usu_resp,
							ur.usu_apellido as usu_resp_apel,
							ots.ots_observacion,
							ur.usu_apellido as usu_resp_apel
						FROM orden_trabajo_seguimiento ots
						INNER JOIN estado_servicio es
						ON es.est_serv_id 	=	ots.ots_operacion_id
						INNER JOIN usuario_log ut
						ON ut.usu_id 	=	ots.ots_responsable_id
						INNER JOIN usuario_log ur
						ON ur.usu_id 	=	ots.ots_obsv_usu_id
						WHERE 	ots_ord_trab_id 	= 	'$ord_trab_id'
						AND 	ots_estado 			= 	1";

			return ejecutarConsulta($sql);
		}

public function listarOT($ord_trab_id)	
		{
			$sql	=	"SELECT	ot.ord_trab_id,
								ot.ord_trab_fecha_programacion,
								ot.ord_trab_fecha_vencimiento,
								ot.ord_trab_fecha_elaboracion,
								ot.ord_trab_observacion,
								es.est_serv_nombre,
                                ut.usu_nombre as usu_tec,
                                ut.usu_apellido as usu_tec_apel,
								ur.usu_nombre as usu_resp,
								ur.usu_apellido as usu_resp_apel
						FROM 	orden_trabajo ot
						INNER JOIN usuario_log ut
						ON ut.usu_id 	=	ot.ord_trab_tecnico_id
						INNER JOIN estado_servicio es
						ON es.est_serv_id 	=	ot.ord_trab_operacion_id
						INNER JOIN usuario_log ur
						ON ur.usu_id 	=	ot.ord_trab_responsable_id
						WHERE 	ord_trab_id 	=	'$ord_trab_id'";

			return ejecutarConsulta($sql);
		}



		// Impementacion de metodo para listar registros
	// RELACION DE LA TABLA orden_trabajo
	// ---------------------------------------------------------------------
	// |ALIAS 	|	TABLA 	 	|	CAMPO 			|	RELACION			|
	// ---------------------------------------------------------------------
	// |a 		|estado_servicio|est_serv_nombre	|ord_trab_operacion_id	|
	// ---------------------------------------------------------------------
	// |b 		|contrato 		|cont_id 			|ord_trab_contrato_id	|
	// ---------------------------------------------------------------------
	// |c 		|usuario_log	|usu_nombre 		|ord_trab_responsable_id|
	// ---------------------------------------------------------------------
	
		public function listar()
		{
			$ord_trab_grupo 	=	$_SESSION['usu_grupo_tecnica'];

			// ESTA VALIDACION VERIFICA SI EL USUARIO ES ADMINISTRADOR DEL SISTEMA
			if ($_SESSION['usu_id'] == 27 || $_SESSION['usu_id'] == 30)
			{
				$sql 	= 	"SELECT s.ord_trab_id,
							s.ord_trab_fecha_elaboracion,
							s.ord_trab_fecha_programacion,
							s.ord_trab_fecha_vencimiento,
							b.cont_estado_servicio_id,
							b.cont_id,
							b.cont_no_contrato,
							p.per_num_documento,
							b.cont_persona_id,
							p.per_id,
							p.per_nombre,
							p.per_apellido,
							c.usu_nombre,
							c.usu_apellido,
							r.usu_nombre as resp_nombre, 
							r.usu_apellido as resp_apellido,
							s.ord_trab_tecnico_id,
							s.ord_trab_observacion,
							s.ord_estado,
							sed.sed_nombre
							FROM orden_trabajo s
							INNER JOIN contrato b 
							ON b.cont_id 	= 	s.ord_trab_contrato_id
							INNER JOIN sede sed 
							ON b.cont_sede_id 	= 	sed.sed_id
							INNER JOIN estado_servicio a 
							ON a.est_serv_id =	b.cont_estado_servicio_id
							INNER JOIN persona p 
							ON p.per_id 	=	b.cont_persona_id 
							INNER JOIN usuario_log c 
							ON c.usu_id = s.ord_trab_tecnico_id
							INNER JOIN usuario_log r 
							ON r.usu_id = s.ord_trab_responsable_id
							WHERE ord_estado 	= 	'1'";	
			}
			else
			{
				// ESTA VALIDACION VERIFICA SI EL USUARIO ES DE LA SEDE FIRAVITOBA
				if($_SESSION['usu_id'] == 40)
				{
					$sql 	= 	"SELECT s.ord_trab_id,
							s.ord_trab_fecha_elaboracion,
							s.ord_trab_fecha_programacion,
							s.ord_trab_fecha_vencimiento,
							b.cont_estado_servicio_id,
							b.cont_id,
							b.cont_no_contrato,
							p.per_num_documento,
							b.cont_persona_id,
							p.per_id,
							p.per_nombre,
							p.per_apellido,
							r.usu_nombre as resp_nombre, 
							r.usu_apellido as resp_apellido,
							c.usu_nombre,
							c.usu_apellido,
							s.ord_trab_observacion,
							s.ord_estado
							FROM orden_trabajo s
							INNER JOIN contrato b 
							ON b.cont_id 	= 	s.ord_trab_contrato_id
							INNER JOIN estado_servicio a 
							ON a.est_serv_id =	b.cont_estado_servicio_id
							INNER JOIN persona p 
							ON p.per_id 	=	b.cont_persona_id 
							INNER JOIN usuario_log c 
							ON c.usu_id = s.ord_trab_tecnico_id
							INNER JOIN usuario_log r 
							ON r.usu_id = s.ord_trab_responsable_id
							WHERE ord_estado 	= '1'
							AND ord_trab_grupo = 6
							OR ord_trab_grupo =	3
							AND ord_estado 	= '1'";	
				}	
				else
				{
					if($ord_trab_grupo == 1)
					{
						if($_SESSION['usu_id'] == 54)
						{
							$sql 	= 	"SELECT s.ord_trab_id,
								s.ord_trab_fecha_elaboracion,
								s.ord_trab_fecha_programacion,
								s.ord_trab_fecha_vencimiento,
								b.cont_estado_servicio_id,
								b.cont_id,
								b.cont_no_contrato,
								p.per_num_documento,
								b.cont_persona_id,
								p.per_id,
								p.per_nombre,
	                            b.cont_internet,
								p.per_apellido,
								c.usu_nombre,
								c.usu_apellido,
								r.usu_nombre as resp_nombre, 
								r.usu_apellido as resp_apellido,
								s.ord_trab_observacion,
								s.ord_estado,
	                            s.ord_trab_grupo
								FROM orden_trabajo s
								INNER JOIN contrato b 
								ON b.cont_id 	= 	s.ord_trab_contrato_id
								INNER JOIN estado_servicio a 
								ON a.est_serv_id =	b.cont_estado_servicio_id
								INNER JOIN persona p 
								ON p.per_id 	=	b.cont_persona_id 
								INNER JOIN usuario_log c 
								ON c.usu_id = s.ord_trab_tecnico_id
								INNER JOIN usuario_log r 
								ON r.usu_id = s.ord_trab_responsable_id
								WHERE ord_estado 	= 	'1'
	                            AND ord_trab_tecnico_id = 54";		
						}
						else
						{
							$sql 	= 	"SELECT s.ord_trab_id,
								s.ord_trab_fecha_elaboracion,
								s.ord_trab_fecha_programacion,
								s.ord_trab_fecha_vencimiento,
								b.cont_estado_servicio_id,
								b.cont_id,
								b.cont_no_contrato,
								p.per_num_documento,
								b.cont_persona_id,
								p.per_id,
								p.per_nombre,
	                            b.cont_internet,
	                            r.usu_nombre as resp_nombre, 
								r.usu_apellido as resp_apellido,
								p.per_apellido,
								c.usu_nombre,
								c.usu_apellido,
								s.ord_trab_observacion,
								s.ord_estado,
	                            s.ord_trab_grupo
								FROM orden_trabajo s
								INNER JOIN contrato b 
								ON b.cont_id 	= 	s.ord_trab_contrato_id
								INNER JOIN estado_servicio a 
								ON a.est_serv_id =	b.cont_estado_servicio_id
								INNER JOIN persona p 
								ON p.per_id 	=	b.cont_persona_id 
								INNER JOIN usuario_log c 
								ON c.usu_id = s.ord_trab_tecnico_id
								INNER JOIN usuario_log r 
								ON r.usu_id = s.ord_trab_responsable_id
								WHERE ord_estado 	= 	'1'
								AND ord_trab_grupo 	=	'$ord_trab_grupo'
	                            OR b.cont_internet  = 	1
	                            AND ord_estado 	= 	'1'";		
                        }
					}
					else
					{
						$sql 	= 	"SELECT s.ord_trab_id,
							s.ord_trab_fecha_elaboracion,
							s.ord_trab_fecha_programacion,
							s.ord_trab_fecha_vencimiento,
							b.cont_estado_servicio_id,
							b.cont_id,
							b.cont_no_contrato,
							p.per_num_documento,
							b.cont_persona_id,
							p.per_id,
							r.usu_nombre as resp_nombre, 
							r.usu_apellido as resp_apellido,
							p.per_nombre,
							p.per_apellido,
							c.usu_nombre,
							c.usu_apellido,
							s.ord_trab_observacion,
							s.ord_estado
							FROM orden_trabajo s
							INNER JOIN contrato b 
							ON b.cont_id 	= 	s.ord_trab_contrato_id
							INNER JOIN estado_servicio a 
							ON a.est_serv_id =	b.cont_estado_servicio_id
							INNER JOIN persona p 
							ON p.per_id 	=	b.cont_persona_id 
							INNER JOIN usuario_log c 
							ON c.usu_id = s.ord_trab_tecnico_id
							INNER JOIN usuario_log r 
							ON r.usu_id = s.ord_trab_responsable_id
							WHERE ord_estado 	= 	'1'
							AND ord_trab_grupo =	'$ord_trab_grupo'";		
					}
				}
				
			}

			return ejecutarConsulta($sql);
		}

		public function listarBoyaca()
		{
			$sql 	= 	"SELECT s.ord_trab_id,
							s.ord_trab_fecha_elaboracion,
							s.ord_trab_fecha_programacion,
							s.ord_trab_fecha_vencimiento,
							b.cont_estado_servicio_id,
							b.cont_id,
							b.cont_no_contrato,
							p.per_num_documento,
							b.cont_persona_id,
							p.per_id,
							p.per_nombre,
							p.per_apellido,
							c.usu_nombre,
							c.usu_apellido,
							r.usu_nombre as resp_nombre, 
							r.usu_apellido as resp_apellido,
							s.ord_trab_tecnico_id,
							s.ord_trab_observacion,
							s.ord_estado,
							sed.sed_nombre
							FROM orden_trabajo s
							INNER JOIN contrato b 
							ON b.cont_id 	= 	s.ord_trab_contrato_id
							INNER JOIN sede sed 
							ON b.cont_sede_id 	= 	sed.sed_id
							INNER JOIN estado_servicio a 
							ON a.est_serv_id =	b.cont_estado_servicio_id
							INNER JOIN persona p 
							ON p.per_id 	=	b.cont_persona_id 
							INNER JOIN usuario_log c 
							ON c.usu_id = s.ord_trab_tecnico_id
							INNER JOIN usuario_log r 
							ON r.usu_id = s.ord_trab_responsable_id
							WHERE ord_trab_grupo = 4
							AND ord_estado 	= 	1
							OR ord_trab_grupo = 3
							AND ord_estado 	= 	1
							OR ord_trab_grupo = 5
							AND ord_estado 	= 	1
							OR ord_trab_grupo = 6
							AND ord_estado 	= 	1";

				return ejecutarConsulta($sql);	
		}


	/// MUESTRA EL LISTADO DE OT'S CERRADAS 

		public function listarOTCerradas()
		{
			$ord_trab_grupo 	=	$_SESSION['usu_grupo_tecnica'];

			// ESTA VALIDACION VERIFICA SI EL USUARIO ES ADMINISTRADOR DEL SISTEMA
			if ($_SESSION['usu_id'] == 67 || $_SESSION['usu_id'] == 30 || $_SESSION['usu_id'] == 51 || $_SESSION['usu_id'] == 32 || $_SESSION['usu_id'] == 60 || $_SESSION['usu_id'] == 64)
			{
				$sql 	= 	"SELECT s.ord_trab_id,
							s.ord_trab_fecha_elaboracion,
							s.ord_trab_fecha_programacion,
							s.ord_trab_fecha_vencimiento,
							a.est_serv_nombre,
							b.cont_id,
							b.cont_no_contrato,
							p.per_num_documento,
							b.cont_persona_id,
							b.cont_estado_servicio_id,
							p.per_id,
							p.per_nombre,
							p.per_apellido,
							c.usu_nombre,
							c.usu_apellido,
							s.ord_trab_observacion,
							otc.ord_trab_cie_fecha,
							otc.ord_trab_cie_concepto,
							s.ord_estado
							FROM orden_trabajo s
							INNER JOIN contrato b 
							ON b.cont_id 	= 	s.ord_trab_contrato_id
							INNER JOIN estado_servicio a 
							ON a.est_serv_id =	b.cont_estado_servicio_id
							INNER JOIN persona p 
							ON p.per_id 	=	b.cont_persona_id 
							INNER JOIN orden_trabajo_cierres otc
							ON otc.ord_trab_ot_id = s.ord_trab_id
							INNER JOIN usuario_log c 
							ON c.usu_id = otc.ort_trab_cie_usu_id
							WHERE ord_estado 	= 	'0'";	
			}
			else
			{
				// ESTA VALIDACION VERIFICA SI EL USUARIO ES DE LA SEDE FIRAVITOBA
				if($_SESSION['usu_id'] == 40)
				{
					$sql 	= 	"SELECT s.ord_trab_id,
							s.ord_trab_fecha_elaboracion,
							s.ord_trab_fecha_programacion,
							s.ord_trab_fecha_vencimiento,
							a.est_serv_nombre,
							b.cont_id,
							b.cont_no_contrato,
							p.per_num_documento,
							b.cont_persona_id,
							b.cont_estado_servicio_id,
							p.per_id,
							p.per_nombre,
							p.per_apellido,
							c.usu_nombre,
							c.usu_apellido,
							s.ord_trab_observacion,
							otc.ord_trab_cie_fecha,
							otc.ord_trab_cie_concepto,
							s.ord_estado
							FROM orden_trabajo s
							INNER JOIN contrato b 
							ON b.cont_id 	= 	s.ord_trab_contrato_id
							INNER JOIN estado_servicio a 
							ON a.est_serv_id =	b.cont_estado_servicio_id
							INNER JOIN persona p 
							ON p.per_id 	=	b.cont_persona_id 
							INNER JOIN orden_trabajo_cierres otc
							ON otc.ord_trab_ot_id = s.ord_trab_id
							INNER JOIN usuario_log c 
							ON c.usu_id = otc.ort_trab_cie_usu_id
							WHERE ord_estado 	= 	'0'
							AND ord_trab_grupo = 6
							OR ord_trab_grupo =	3
							AND ord_estado 	= '0'";	
				}	
				else
				{
					$sql 	= 	"SELECT s.ord_trab_id,
							s.ord_trab_fecha_elaboracion,
							s.ord_trab_fecha_programacion,
							s.ord_trab_fecha_vencimiento,
							a.est_serv_nombre,
							b.cont_id,
							b.cont_no_contrato,
							p.per_num_documento,
							b.cont_persona_id,
							b.cont_estado_servicio_id,
							p.per_id,
							p.per_nombre,
							p.per_apellido,
							c.usu_nombre,
							c.usu_apellido,
							s.ord_trab_observacion,
							otc.ord_trab_cie_fecha,
							otc.ord_trab_cie_concepto,
							s.ord_estado
							FROM orden_trabajo s
							INNER JOIN contrato b 
							ON b.cont_id 	= 	s.ord_trab_contrato_id
							INNER JOIN estado_servicio a 
							ON a.est_serv_id =	b.cont_estado_servicio_id
							INNER JOIN persona p 
							ON p.per_id 	=	b.cont_persona_id 
							INNER JOIN orden_trabajo_cierres otc
							ON otc.ord_trab_ot_id = s.ord_trab_id
							INNER JOIN usuario_log c 
							ON c.usu_id = otc.ort_trab_cie_usu_id
							WHERE ord_estado 	= 	'0'
							AND ord_trab_grupo =	'$ord_trab_grupo'";	
				}
				
			}

			return ejecutarConsulta($sql);
		}

	// Impementacion de metodo para listar registros
	// RELACION DE LA TABLA equipo_detalle
	// -------------------------------------------------------------------------
	// |ALIAS 		|	TABLA 		|	CAMPO 			|	RELACION			|
	// -------------------------------------------------------------------------
	// |e 			|equipo 		|equi_referencia	|equi_det_equipo_id		|
	// -------------------------------------------------------------------------
	// |et 			|equipo_tipo	|equi_tip_nombre	|equi_tipo_id 			|
	// -------------------------------------------------------------------------

		public function listarEquipoDetalle()
		{
			$sql 	= 	"SELECT ed.equi_det_id,
							e.equi_referencia,
							et.equi_tip_nombre,
							ed.equi_det_mac,
							ed.equi_det_sn,
							ed.equi_det_estado_id
							FROM equipo_detalle ed
							INNER JOIN equipo e
							ON e.equi_id =	ed.equi_det_equipo_id
							INNER JOIN equipo_tipo et 
							ON et.equi_tip_id 	= 	e.equi_tipo_id
							WHERE equi_det_estado_id = 2";

			return ejecutarConsulta($sql);
		}


		public function selectTecnico()
		{
			$sql 	=	"SELECT * FROM usuario_log 
						WHERE 	usu_estado 		= 1
						AND 	usu_cargo_id 	= 1";

			return ejecutarConsulta($sql);	
		}

		// Impementacion de metodo para listar registros
	// RELACION DE LA TABLA contrato
	// -------------------------------------------------------------------------------------
	// |ALIAS 		|	TABLA 	 	   	|	CAMPO 			   		|	RELACION			|
	// -------------------------------------------------------------------------------------
	// |con 		|contrato 		   	|oper_nombre			   	|ord_trab_operacion_id	|
	// -------------------------------------------------------------------------------------
	// |per 		|persona 		   	|per_id 				   	|cont_persona_id		|
	// -------------------------------------------------------------------------------------
	// |ciu 		|ciudad 		   	|ciu_nombre 			   	|per_ciudad_id			|
	// -------------------------------------------------------------------------------------
	// |ali 		|alianza 		   	|ali_nombre 			   	|per_alianza_id			|
	// -------------------------------------------------------------------------------------		
	// |es 			|estado_servicio   	|cont_estado_servicio_id	|est_serv_id			|
	// -------------------------------------------------------------------------------------				
	// |conprod		|contrato_producto 	|cont_prod_contrato_id		|cont_id				|
	// -------------------------------------------------------------------------------------				
	// |prod		|producto 			|prod_id					|cont_prod_producto_id	|
	// -------------------------------------------------------------------------------------				
	// |tv 			|tipo_vivienda 		|tip_viv_id 				|per_tipo_vivienda_id	|
	// -------------------------------------------------------------------------------------				
	// |usu			|usuario_log 		|usu_id	 					|cont_usuario_id		|
	// -------------------------------------------------------------------------------------	

	/// FUNCION PARA REALIZAR CONSULTA DE EQUIPOS REGISTRADOS AL CLIENTE Y MOSTRARLOS EN EL CONTRATO

		public function listarEquipoInstalado($cont_id)
		{
			$sql 	= 	"SELECT ot.ord_trab_contrato_id,
							et.equi_tip_nombre,
							fb.fab_nombre,
							e.equi_referencia,
							ed.equi_det_mac,
							ed.equi_det_sn,
							ote.ot_equi_ord_trab_id,
							ote.ot_equi_estado,
							ote.ot_equi_propiedad
						FROM orden_trabajo ot
						INNER JOIN orden_trabajo_equipo ote
						ON ote.ot_equi_ord_trab_id 	= 	ot.ord_trab_id
						INNER JOIN equipo_detalle ed
						ON ed.equi_det_id =	ote.ot_equi_equi_det_id
						INNER JOIN equipo e
						ON e.equi_id = 	ed.equi_det_equipo_id
						INNER JOIN fabricante fb
						ON fb.fab_id 	= 	e.equi_fabricante_id
						INNER JOIN equipo_tipo et 
						ON et.equi_tip_id 	=	e.equi_tipo_id
						WHERE ord_trab_contrato_id = '$cont_id'";

			return ejecutarConsulta($sql);
		}


		public function nuevoEstado()
		{
			$sql 	=	"SELECT * FROM estado_servicio
						WHERE est_ser_area = 2";

			return ejecutarConsulta($sql);
		}

		public function guardarNuevoEstado ($estado, $cont_id, $usu_id, $ot_id, $concepto)
		{
			if($estado == 2)
			{
				$dias 	= 10;
			}
			elseif($estado == 9)
			{
				$dias 	= 10;
			}
			elseif($estado == 13)
			{
				$dias 	= 10;
			}
			else
			{
				$dias 	= 0;	
			}

			$sqlcambio = "INSERT INTO cc_estado_servicio(
					cc_est_ser_id,
					cc_est_ser_contrato_id,
					cc_est_ser_usuario_id,
					cc_est_ser_estado_id
					)VALUES(
					null,
					'$cont_id',
					'$usu_id',
					'$estado'
					)";

			ejecutarConsulta($sqlcambio);

			$sqlcierre = "INSERT INTO orden_trabajo_cierres(
					ort_trab_cie_id,
					ort_trab_cie_usu_id,
					ord_trab_ot_id,
					ord_trab_cie_concepto
					)VALUES(
					null,
					'$usu_id',
					'$ot_id', 
					'$concepto')";

			ejecutarConsulta($sqlcierre);

			$sqlOT = "UPDATE orden_trabajo
					SET ord_estado = 0
					WHERE ord_trab_contrato_id = '$cont_id'";

			ejecutarConsulta($sqlOT);


			$sql = "UPDATE contrato
					SET cont_estado_servicio_id = '$estado',
						cont_max_dias_pago 		= '$dias'
					WHERE cont_id = '$cont_id'";

			return ejecutarConsulta($sql);
		}

	public function cobroprorrateo(
				$per_id,
				$v_contratoid,
				$valoracobra,
				$sede,
				$usuario){

		$meses 			= 	array(	"ENERO",
									"FEBRERO",
									"MARZO",
									"ABRIL",
									"MAYO",
									"JUNIO",
									"JULIO",
									"AGOSTO",
									"SEPTIEMBRE",
									"OCTUBRE",
									"NOVIEMBRE",
									"DICIEMBRE");

		$mes_actual 	= 	"PRORRATEO " . $meses[date('m')-1];
		
		$sqlsaldo ="SELECT est_cta_saldo_actual 
					FROM estado_cuenta_fin
					WHERE est_cta_contrato_id = '$v_contratoid'
					ORDER BY est_cta_id desc
					LIMIT 1";

		$saldoactual = ejecutarConsultaSimpleFila($sqlsaldo);
		
		$saldoactual = $saldoactual['est_cta_saldo_actual'];	

		$sqlnvonumfac ="INSERT INTO numeracion_recibo_caja (
				num_fac_id,
				num_fac_sede_id
				)VALUES(
				null,
				'$sede'
				)";
		$numfac = ejecutarConsulta_retornaID($sqlnvonumfac);

		$sqlestadocuenta = "INSERT INTO estado_cuenta_fin(
				est_cta_id,
				est_cta_persona_id,
				est_cta_contrato_id,
				est_cta_no_transaccion,
				est_cta_transaccion_id,
				est_cta_concep_trans_id,
				est_cta_haber,
				est_cta_saldo_anterior,
				est_cta_saldo_actual,
				est_cta_observacion,
				est_cta_sede_id,
				est_cta_usuario_id
				)
				VALUES(
				null,
				'$per_id',	
				'$v_contratoid',
				'$numfac',
				'1',
				'1',
				'$valoracobra',
				'$saldoactual',
				'$saldoactual' + '$valoracobra',
				'$mes_actual',
				'$sede',
				'$usuario'
				)";

		return ejecutarConsulta($sqlestadocuenta);
	}
	public function validarSeguimientoOT($id_ot)
	{
		$sql 	= 	"SELECT otst.usu_nombre as tec_nombre,
							otst.usu_apellido as tec_apellido,
							otst.usu_num_documento as tec_documento,
							otsr.usu_nombre as resp_nombre, 
							otsr.usu_apellido as resp_apellido,
							ots.ots_observacion,
							ots.ots_fecha_elaboracion
						 FROM orden_trabajo_seguimiento ots
						 INNER JOIN usuario_log otst 
						 ON otst.usu_id = ots.ots_responsable_id
						 INNER JOIN usuario_log otsr 
						 ON otsr.usu_id = ots.ots_obsv_usu_id
						 WHERE ots.ots_ord_trab_id = '$id_ot' 
						 ORDER BY ots.ots_id DESC LIMIT 1";

		return ejecutarConsultaSimpleFila($sql);
	}

}

?>