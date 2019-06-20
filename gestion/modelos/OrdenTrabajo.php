<?php /*session_start();*/
// # encodé par @Anderson Ferrucho 
// maintenance effectuee par Anderson Ferrucho
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

Class OrdenTrabajo
{
	public function __construct()
	{
	
	}

		public function insertar(
			$ord_trab_id,
			$ord_trab_fecha_programacion = null,
			$ord_trab_fecha_vencimiento = null,
			$ord_trab_operacion_id,
			$ord_trab_tecnico_id = null,
			$ord_trab_contrato_id,
			$ord_trab_responsable_id,
			$ord_estado,
			$ord_trab_observacion
		)
		{
			$ord_trab_grupo 	=	$_SESSION['usu_grupo_tecnica'];

			$sql = "INSERT INTO orden_trabajo(
						ord_trab_id,
						ord_trab_fecha_programacion,
						ord_trab_fecha_vencimiento,
						ord_trab_operacion_id,
						ord_trab_tecnico_id,
						ord_trab_contrato_id,
						ord_trab_responsable_id,
						ord_trab_observacion,
						ord_estado,
						ord_trab_grupo
					)
					VALUES(
						null,
						'$ord_trab_fecha_programacion',
						'$ord_trab_fecha_vencimiento',
						'$ord_trab_operacion_id',
						'$ord_trab_tecnico_id',
						'$ord_trab_contrato_id',
						'$ord_trab_responsable_id',
						'$ord_trab_observacion',
						'$ord_estado',
						'$ord_trab_grupo'
					)";

					$ot = ejecutarConsulta_retornaID($sql);

			return $ot;
		}


		public function guardarNuevoEstado ($ord_trab_operacion_id, $ord_trab_contrato_id, $ord_trab_responsable_id)
		{

			$sqlcambio = "INSERT INTO cc_estado_servicio(
					cc_est_ser_id,
					cc_est_ser_contrato_id,
					cc_est_ser_usuario_id,
					cc_est_ser_estado_id
					)VALUES(
					null,
					'$ord_trab_contrato_id',
					'$ord_trab_responsable_id',
					'$ord_trab_operacion_id'
					)";

			ejecutarConsulta($sqlcambio);

			$sql = "UPDATE contrato
					SET cont_estado_servicio_id = '$ord_trab_operacion_id'
					WHERE cont_id = '$ord_trab_contrato_id'";

			return ejecutarConsulta($sql);
		}


		public function insertarOTconEquipo(
			$ord_trab_id,
			$ord_trab_fecha_programacion,
			$ord_trab_fecha_vencimiento,
			$ord_trab_operacion_id,
			$ord_trab_tecnico_id,
			$ord_trab_contrato_id,
			$ord_trab_responsable_id,
			$ord_trab_observacion,
			$id_detalle_equipo,
			$cliente			
		)
		{
			$ord_trab_grupo 	=	$_SESSION['usu_grupo_tecnica'];
			
			$sql_ot = "INSERT INTO orden_trabajo(
						ord_trab_id,
						ord_trab_fecha_programacion,
						ord_trab_fecha_vencimiento,
						ord_trab_operacion_id,
						ord_trab_tecnico_id,
						ord_trab_contrato_id,
						ord_trab_responsable_id,
						ord_trab_observacion,
						ord_trab_grupo
					)
					VALUES(
						null,
						'$ord_trab_fecha_programacion',
						'$ord_trab_fecha_vencimiento',
						'$ord_trab_operacion_id',
						'$ord_trab_tecnico_id',
						'$ord_trab_contrato_id',
						'$ord_trab_responsable_id',
						'$ord_trab_observacion',
						'$ord_trab_grupo'
					)";

			$id_ot = ejecutarConsulta_retornaID($sql_ot);

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
							'$ord_trab_contrato_id'
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
		
			return true;	
		}

		public function editar(
			$ord_trab_id,
			$ord_trab_fecha_programacion,
			$ord_trab_fecha_vencimiento,
			$ord_trab_operacion_id,
			$ord_trab_contrato_id,
			$ord_trab_responsable_id,
			$ord_trab_observacion,
			$ord_estado
		)
		{
			$sql = "UPDATE orden_trabajo
					SET 
						ord_trab_resp_activ_id		= 	'$ord_trab_responsable_id',
						ord_trab_fecha_programacion =	'$ord_trab_fecha_programacion,',
						ord_trab_fecha_vencimiento 	= 	'$ord_trab_fecha_vencimiento',
						ord_trab_operacion_id 		=	'$ord_trab_operacion_id',
						ord_trab_contrato_id		= 	'$ord_trab_contrato_id',
						ord_trab_responsable_id 	= 	'$ord_trab_responsable_id',
						ord_trab_observacion 		= 	'$ord_trab_observacion',
						ord_estado 					= 	'$ord_estado'
					WHERE
						ord_trab_id 				= 	'$ord_trab_id'";

			return ejecutarConsulta($sql);
		}

		public function editarOTconEquipo(
			$ord_trab_id,
			$ord_trab_fecha_programacion,
			$ord_trab_fecha_vencimiento,
			$ord_trab_responsable_id,
			$ord_trab_observacion,
			$id_detalle_equipo,
			$cliente			
		)
		{
			$ord_trab_grupo 	=	$_SESSION['usu_grupo_tecnica'];
			
			$sql_ot = "INSERT INTO orden_trabajo(
						ord_trab_id,
						ord_trab_fecha_programacion,
						ord_trab_fecha_vencimiento,
						ord_trab_operacion_id,
						ord_trab_tecnico_id,
						ord_trab_contrato_id,
						ord_trab_responsable_id,
						ord_trab_observacion,
						ord_trab_grupo
					)
					VALUES(
						null,
						'$ord_trab_fecha_programacion',
						'$ord_trab_fecha_vencimiento',
						'$ord_trab_operacion_id',
						'$ord_trab_tecnico_id',
						'$ord_trab_contrato_id',
						'$ord_trab_responsable_id',
						'$ord_trab_observacion',
						'$ord_trab_grupo'
					)";

			$id_ot = ejecutarConsulta_retornaID($sql_ot);

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
							'$ord_trab_contrato_id'
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
		
			return true;	
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

		public function mostrar($cont_id)	
		{
			$sql	=	"SELECT con.cont_id,
								con.cont_no_contrato,
								con.cont_adicional,
								per.per_id,
								per.per_marca,
								ali.ali_nombre,
								per.per_num_documento,
								per.per_nombre,
								per.per_apellido,
								con.cont_vigencia_a_partir,
								per.per_telefono_1,
								per.per_telefono_2,
								per.per_barrio,
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
								usu.usu_nombre
						FROM 	contrato con
						INNER JOIN persona per 
						ON 		per.per_id 	= 	con.cont_persona_id
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
						INNER JOIN usuario_log usu
						ON 		usu.usu_id = con.cont_usuario_id
						INNER JOIN sede sed
						ON 		sed.sed_id = con.cont_sede_id
						WHERE 	cont_id 	= 	'$cont_id'";

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
                                prod.prod_nombre,
                                prod.prod_valor,
                                prod.prod_valor_pronto_pago,
                                prod.prod_descuento_x_combo,
                                prod.prod_prefijo
						FROM 	contrato_producto conprod 
						INNER JOIN producto prod 
						ON 		prod.prod_id = 	conprod.cont_prod_producto_id
						WHERE 	cont_prod_contrato_id 	= 	'$cont_id'
						AND cont_prod_estado = 1";

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

	public function validarOTActiva($cont_id)
		{
			$sql 	= 	"SELECT ord_trab_id, ord_trab_contrato_id, 		ord_trab_tecnico_id 
						FROM orden_trabajo 
						WHERE ord_trab_contrato_id = '$cont_id'
						AND ord_estado = 1";

			ejecutarConsultaSimpleFila($sql);

			if(!empty(ejecutarConsultaSimpleFila($sql)))
			{
				return ejecutarConsultaSimpleFila($sql);	
			}
			else
			{
				return false;
			}
		}

		public function validarOTActivaCaja($cont_id)
		{
			$sql 	= 	"SELECT * FROM orden_trabajo 
						WHERE ord_trab_contrato_id = '$cont_id'
						AND ord_estado = 1";


			return	ejecutarConsultaSimpleFila($sql);

		}

		// Impementacion de metodo para listar registros
	// RELACION DE LA TABLA orden_trabajo
	// ---------------------------------------------------------------------
	// |ALIAS 	|	TABLA 	 	|	CAMPO 			|	RELACION			|
	// ---------------------------------------------------------------------
	// |a 		|operacion 		|oper_nombre		|ord_trab_operacion_id	|
	// ---------------------------------------------------------------------
	// |b 		|contrato 		|cont_id 			|ord_trab_contrato_id	|
	// ---------------------------------------------------------------------
	// |c 		|usuario_log	|usu_nombre 		|ord_trab_responsable_id|
	// ---------------------------------------------------------------------
	public function listarFiltrado($filtro)
	{

		$grupo_sede = 	$_SESSION['usu_grupo_tecnica'];
		$id_sede 	= 	$_SESSION['usu_sede_id'];
		
		// ESTA VALIDACIÓN VERIFICA SI LOS USUARIOS SON  ADMINISTRADORES DEL SISTEMA 
		// PARA MOSTRAR TODOS LOS CONTRATOS
		if ($_SESSION['usu_area_id'] == 7)
		{
			$sql = "SELECT
					c.cont_id,
					c.cont_no_contrato,
					c.cont_minimo_mensual,
					c.cont_direccion_serv,
					c.cont_estado_servicio_id,
					p.per_nombre,
					p.per_apellido, 
					p.per_num_documento, 
					p.per_telefono_1,
					c.cont_vigencia_a_partir,
					c.cont_permanencia,
					c.cont_fecha_fin_perm,
					c.cont_estado,
					c.cont_fecha_transaccion,
					s.sed_id,
					s.sed_grupo_tecnica,
					s.sed_nombre,
					c.cont_tv_analogica,
					c.cont_tv_digital,
					c.cont_internet
				FROM contrato c
				INNER JOIN persona p
				ON c.cont_persona_id = p.per_id	
				INNER JOIN sede s 
				ON c.cont_sede_id 	= 	s.sed_id
				WHERE cont_estado 	= 	1
				AND c.cont_estado_servicio_id = '$filtro'";

		}	
		else if($_SESSION['usu_id'] == 40)
		{// ESTA VALIDACIÓN VERIFICA LA SESION DE FIRAVITOBA Y MUESTRA LOS CONTRATOS DE IZA Y FIRA
			$sql = "SELECT
				c.cont_id,
				c.cont_no_contrato,
				c.cont_minimo_mensual,
				c.cont_direccion_serv,
				c.cont_estado_servicio_id,
				p.per_nombre,
				p.per_apellido, 
				p.per_num_documento, 
				p.per_telefono_1 ,
				c.cont_vigencia_a_partir,
				c.cont_permanencia,
				c.cont_fecha_fin_perm,
				c.cont_estado,
				c.cont_fecha_transaccion,
				s.sed_id,
				s.sed_grupo_tecnica,
				s.sed_nombre,
				c.cont_tv_analogica,
				c.cont_tv_digital,
				c.cont_internet
			FROM contrato c
			INNER JOIN persona p
			ON c.cont_persona_id = p.per_id	
			INNER JOIN sede s 
			ON c.cont_sede_id 	= 	s.sed_id
		 	WHERE s.sed_grupo_tecnica = 3
		 	AND cont_estado 	= 	1
			AND c.cont_estado_servicio_id = '$filtro'
		 	OR s.sed_grupo_tecnica = 6
		 	AND cont_estado 	= 	1
		 	AND c.cont_estado_servicio_id = '$filtro'";
		}
		else if($_SESSION['usu_area_id'] == 9)
		{// ESTA VALIDACIÓN VERIFICA LA SESION DE FIRAVITOBA Y MUESTRA LOS CONTRATOS DE IZA Y FIRA
			$sql = "SELECT
				c.cont_id,
				c.cont_no_contrato,
				c.cont_minimo_mensual,
				c.cont_direccion_serv,
				c.cont_estado_servicio_id,
				p.per_nombre,
				p.per_apellido, 
				p.per_num_documento, 
				p.per_telefono_1 ,
				c.cont_vigencia_a_partir,
				c.cont_permanencia,
				c.cont_fecha_fin_perm,
				c.cont_estado,
				c.cont_fecha_transaccion,
				s.sed_id,
				s.sed_grupo_tecnica,
				s.sed_nombre,
				c.cont_tv_analogica,
				c.cont_tv_digital,
				c.cont_internet
			FROM contrato c
			INNER JOIN persona p
			ON c.cont_persona_id = p.per_id	
			INNER JOIN sede s 
			ON c.cont_sede_id 	= 	s.sed_id
		 	WHERE s.sed_grupo_tecnica = 3
		 	AND cont_estado 	= 	1
			AND c.cont_estado_servicio_id = '$filtro'
		 	OR s.sed_grupo_tecnica = 6
		 	AND cont_estado 	= 	1
		 	AND c.cont_estado_servicio_id = '$filtro'
		 	OR s.sed_grupo_tecnica = 5
		 	AND cont_estado 	= 	1
		 	AND c.cont_estado_servicio_id = '$filtro'
		 	OR s.sed_grupo_tecnica = 4
		 	AND cont_estado 	= 	1
		 	AND c.cont_estado_servicio_id = '$filtro'";
		}
		else if($_SESSION['usu_area_id'] == 4)
		{// AQUI VALIDA EL GRUPO DE TECNICA AL QUE PERTENECE EL USUARIO
			
			$sql = "SELECT
						c.cont_id,
						c.cont_no_contrato,
						c.cont_minimo_mensual,
						c.cont_direccion_serv,
						c.cont_estado_servicio_id,
						p.per_nombre,
						p.per_apellido, 
						p.per_num_documento, 
						p.per_telefono_1 ,
						c.cont_vigencia_a_partir,
						c.cont_permanencia,
						c.cont_fecha_fin_perm,
						c.cont_estado,
						c.cont_fecha_transaccion,
						s.sed_id,
						s.sed_grupo_tecnica,
						s.sed_nombre,
						c.cont_tv_analogica,
						c.cont_tv_digital,
						c.cont_internet
					FROM contrato c
					INNER JOIN persona p
					ON c.cont_persona_id = p.per_id	
					INNER JOIN sede s 
					ON c.cont_sede_id 	= 	s.sed_id
					WHERE cont_estado 	= 	1
					AND c.cont_estado_servicio_id = '$filtro'
					AND s.sed_grupo_tecnica = '$grupo_sede'
					OR c.cont_internet =  1
					AND c.cont_estado_servicio_id = '$filtro'
					AND cont_estado 	= 	1";
				
		}
		else if($_SESSION['usu_id'] == 54)
		{
			$sql = "SELECT
					c.cont_id,
					c.cont_no_contrato,
					c.cont_minimo_mensual,
					c.cont_direccion_serv,
					c.cont_estado_servicio_id,
					p.per_nombre,
					p.per_apellido, 
					p.per_num_documento, 
					p.per_telefono_1 ,
					c.cont_vigencia_a_partir,
					c.cont_permanencia,
					c.cont_fecha_fin_perm,
					c.cont_estado,
					c.cont_fecha_transaccion,
					s.sed_id,
					s.sed_grupo_tecnica,
					s.sed_nombre,
					c.cont_tv_analogica,
					c.cont_tv_digital,
					c.cont_internet
				FROM contrato c
				INNER JOIN persona p
				ON c.cont_persona_id = p.per_id	
				INNER JOIN sede s 
				ON c.cont_sede_id 	= 	s.sed_id
				WHERE c.cont_sede_id = '$id_sede'
				AND cont_estado 	= 	1
				AND c.cont_estado_servicio_id = '$filtro'";	
		}
		else
		{
			$sql = "SELECT
					c.cont_id,
					c.cont_no_contrato,
					c.cont_minimo_mensual,
					c.cont_direccion_serv,
					c.cont_estado_servicio_id,
					p.per_nombre,
					p.per_apellido, 
					p.per_num_documento, 
					p.per_telefono_1 ,
					c.cont_vigencia_a_partir,
					c.cont_permanencia,
					c.cont_fecha_fin_perm,
					c.cont_estado,
					c.cont_fecha_transaccion,
					s.sed_id,
					s.sed_grupo_tecnica,
					s.sed_nombre,
					c.cont_tv_analogica,
					c.cont_tv_digital,
					c.cont_internet
				FROM contrato c
				INNER JOIN persona p
				ON c.cont_persona_id = p.per_id	
				INNER JOIN sede s 
				ON c.cont_sede_id 	= 	s.sed_id
				WHERE s.sed_grupo_tecnica = '$grupo_sede'
				AND cont_estado 	= 	1
				AND c.cont_estado_servicio_id = '$filtro'";
		}	

		return ejecutarConsulta($sql);
	
	}	



	public function listar()
	{

		$grupo_sede = 	$_SESSION['usu_grupo_tecnica'];
		$id_sede 	= 	$_SESSION['usu_sede_id'];
		
		// ESTA VALIDACIÓN VERIFICA SI LOS USUARIOS SON  ADMINISTRADORES DEL SISTEMA 
		// PARA MOSTRAR TODOS LOS CONTRATOS
		if ($_SESSION['usu_area_id'] == 7)
		{
			$sql = "SELECT
					c.cont_id,
					c.cont_no_contrato,
					c.cont_minimo_mensual,
					c.cont_direccion_serv,
					c.cont_estado_servicio_id,
					p.per_nombre,
					p.per_apellido, 
					p.per_num_documento, 
					p.per_telefono_1,
					c.cont_vigencia_a_partir,
					c.cont_permanencia,
					c.cont_fecha_fin_perm,
					c.cont_estado,
					c.cont_fecha_transaccion,
					s.sed_id,
					s.sed_grupo_tecnica,
					s.sed_nombre,
					c.cont_tv_analogica,
					c.cont_tv_digital,
					c.cont_internet
				FROM contrato c
				INNER JOIN persona p
				ON c.cont_persona_id = p.per_id	
				INNER JOIN sede s 
				ON c.cont_sede_id 	= 	s.sed_id
				WHERE cont_estado 	= 	1";

		}	
		else if($_SESSION['usu_id'] == 40)
		{// ESTA VALIDACIÓN VERIFICA LA SESION DE FIRAVITOBA Y MUESTRA LOS CONTRATOS DE IZA Y FIRA
			
			$sql = "SELECT
					c.cont_id,
					c.cont_no_contrato,
					c.cont_minimo_mensual,
					c.cont_direccion_serv,
					c.cont_estado_servicio_id,
					p.per_nombre,
					p.per_apellido, 
					p.per_num_documento, 
					p.per_telefono_1 ,
					c.cont_vigencia_a_partir,
					c.cont_permanencia,
					c.cont_fecha_fin_perm,
					c.cont_estado,
					c.cont_fecha_transaccion,
					s.sed_id,
					s.sed_grupo_tecnica,
					s.sed_nombre,
					c.cont_tv_analogica,
					c.cont_tv_digital,
					c.cont_internet
				FROM contrato c
				INNER JOIN persona p
				ON c.cont_persona_id = p.per_id	
				INNER JOIN sede s 
				ON c.cont_sede_id 	= 	s.sed_id
		 		WHERE s.sed_grupo_tecnica = 3
		 		OR s.sed_grupo_tecnica = 6
		 		AND cont_estado 	= 	1";
		}
		else if($_SESSION['usu_area_id'] == 9)
		{// ESTA VALIDACIÓN VERIFICA LA SESION DE FIRAVITOBA Y MUESTRA LOS CONTRATOS DE IZA Y FIRA
			
			$sql = "SELECT
					c.cont_id,
					c.cont_no_contrato,
					c.cont_minimo_mensual,
					c.cont_direccion_serv,
					c.cont_estado_servicio_id,
					p.per_nombre,
					p.per_apellido, 
					p.per_num_documento, 
					p.per_telefono_1 ,
					c.cont_vigencia_a_partir,
					c.cont_permanencia,
					c.cont_fecha_fin_perm,
					c.cont_estado,
					c.cont_fecha_transaccion,
					s.sed_id,
					s.sed_grupo_tecnica,
					s.sed_nombre,
					c.cont_tv_analogica,
					c.cont_tv_digital,
					c.cont_internet
				FROM contrato c
				INNER JOIN persona p
				ON c.cont_persona_id = p.per_id	
				INNER JOIN sede s 
				ON c.cont_sede_id 	= 	s.sed_id
		 		WHERE s.sed_grupo_tecnica = 3
		 		AND cont_estado 	= 	1
		 		OR s.sed_grupo_tecnica = 6
		 		AND cont_estado 	= 	1
		 		OR s.sed_grupo_tecnica = 5
		 		AND cont_estado 	= 	1
		 		OR s.sed_grupo_tecnica = 4
		 		AND cont_estado 	= 	1";
		}
		else if($_SESSION['usu_id'] == 54)
		{
			$sql = "SELECT
						c.cont_id,
						c.cont_no_contrato,
						c.cont_minimo_mensual,
						c.cont_direccion_serv,
						c.cont_estado_servicio_id,
						p.per_nombre,
						p.per_apellido, 
						p.per_num_documento, 
						p.per_telefono_1 ,
						c.cont_vigencia_a_partir,
						c.cont_permanencia,
						c.cont_fecha_fin_perm,
						c.cont_estado,
						c.cont_fecha_transaccion,
						s.sed_id,
						s.sed_grupo_tecnica,
						s.sed_nombre,
						c.cont_tv_analogica,
						c.cont_tv_digital,
						c.cont_internet
					FROM contrato c
					INNER JOIN persona p
					ON c.cont_persona_id = p.per_id	
					INNER JOIN sede s 
					ON c.cont_sede_id 	= 	s.sed_id
					WHERE c.cont_sede_id = '$id_sede'
					AND cont_estado 	= 	1";	
		}
		else if($_SESSION['usu_area_id'] == 4)
		{
			$sql = "SELECT
					c.cont_id,
					c.cont_no_contrato,
					c.cont_minimo_mensual,
					c.cont_direccion_serv,
					c.cont_estado_servicio_id,
					p.per_nombre,
					p.per_apellido, 
					p.per_num_documento, 
					p.per_telefono_1 ,
					c.cont_vigencia_a_partir,
					c.cont_permanencia,
					c.cont_fecha_fin_perm,
					c.cont_estado,
					c.cont_fecha_transaccion,
					s.sed_id,
					s.sed_grupo_tecnica,
					s.sed_nombre,
					c.cont_tv_analogica,
					c.cont_tv_digital,
					c.cont_internet
				FROM contrato c
				INNER JOIN persona p
				ON c.cont_persona_id = p.per_id	
				INNER JOIN sede s 
				ON c.cont_sede_id 	= 	s.sed_id
				WHERE s.sed_grupo_tecnica = '$grupo_sede'
				OR c.cont_internet =  1
				AND cont_estado 	= 	1";
		}	
		else 
		{// AQUI VALIDA EL GRUPO DE TECNICA AL QUE PERTENECE EL USUARIO
				
			$sql = "SELECT
							c.cont_id,
							c.cont_no_contrato,
							c.cont_minimo_mensual,
							c.cont_direccion_serv,
							c.cont_estado_servicio_id,
							p.per_nombre,
							p.per_apellido, 
							p.per_num_documento, 
							p.per_telefono_1 ,
							c.cont_vigencia_a_partir,
							c.cont_permanencia,
							c.cont_fecha_fin_perm,
							c.cont_estado,
							c.cont_fecha_transaccion,
							s.sed_id,
							s.sed_grupo_tecnica,
							s.sed_nombre,
							c.cont_tv_analogica,
							c.cont_tv_digital,
							c.cont_internet
						FROM contrato c
						INNER JOIN persona p
						ON c.cont_persona_id = p.per_id	
						INNER JOIN sede s 
						ON c.cont_sede_id 	= 	s.sed_id
						WHERE s.sed_grupo_tecnica = '$grupo_sede'
						AND cont_estado 	= 	1";
					
		}

		return ejecutarConsulta($sql);

	}

// Impementacion de metodo para listar registros
	// RELACION DE LA TABLA equipo_detalla
	// -------------------------------------------------------------------------
	// |ALIAS 		|	TABLA 		|	CAMPO 			|	RELACION			|
	// -------------------------------------------------------------------------
	// |e 			|equipo 		|equi_referencia	|equi_det_equipo_id		|
	// -------------------------------------------------------------------------
	// |et 			|equipo_tipo	|equi_tip_nombre	|equi_tipo_id 			|
	// -------------------------------------------------------------------------

		public function listarEquipoDetalle()
		{
			$sede_usu 	=	$_SESSION['usu_sede_id'];
			
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
							WHERE equi_det_estado_id = 2
							AND equi_det_sede = '$sede_usu'";

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
						INNER JOIN equipo_tipo et 
						ON et.equi_tip_id 	=	e.equi_tipo_id
						WHERE ord_trab_contrato_id = '$cont_id'";

			return ejecutarConsulta($sql);
		}

		public function selectEstado()
		{
			$sql 	=	"SELECT * FROM estado_servicio
						WHERE est_serv_estado = 1";

			return ejecutarConsulta($sql);
		}		



		public function nuevoEstado()
		{
			$sql 	=	"SELECT * FROM estado_servicio
						WHERE est_ser_area = 1";

			return ejecutarConsulta($sql);
		}

		public function fechaEstado($cont_id)
		{
				$sql 	=	"SELECT cc_est_ser_id, cc_est_ser_fecha, cc_est_ser_observacion  FROM cc_estado_servicio 
				WHERE cc_est_ser_contrato_id = '$cont_id' 
				ORDER BY `cc_est_ser_id` DESC LIMIT 1";

				return ejecutarConsultaSimpleFila($sql);
		}


		public function saldoActual($cont_id)
		{
				$sqlsaldos = "SELECT est_cta_saldo_actual 
					FROM estado_cuenta_fin
					WHERE est_cta_id 
					in(SELECT max(est_cta_id) 
					FROM estado_cuenta_fin
					WHERE est_cta_contrato_id = '$cont_id')";

				return ejecutarConsultaSimpleFila($sqlsaldos);
		}

		public function cierresOT($cont_id)
		{
			$sql 	= 	"SELECT ot.ord_trab_contrato_id,
							et.equi_tip_nombre,
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
						INNER JOIN equipo_tipo et 
						ON et.equi_tip_id 	=	e.equi_tipo_id
						WHERE ord_trab_contrato_id = '$cont_id'";

			return ejecutarConsulta($sql);
		}

		// public function estadoServicioOT($cierre_ot_id)
		// {
		// 	$sql 	= 	"SELECT es.est_serv_nombre,
		// 						cces.cc_est_ser_fecha
		// 				 FROM cc_estado_servicio cces 
		// 				 INNER JOIN estado_servicio es
		// 				 ON es.est_ser_id = cces.cc_est_ser_estado_id
		// 				 WHERE cc_est_ser_ot_id = '$cierre_ot_id'";

		// 	return ejecutarConsulta($sql);
		// }


		public function llamarObservacion($cont_id)
		{
			$sql 	=	"SELECT `cc_est_ser_id`,
							 `cc_est_ser_observacion`,
							 `cc_est_ser_fecha`, 
							 usu.usu_nombre, 
							 usu.usu_apellido 
						FROM `cc_estado_servicio` 
						INNER JOIN usuario_log usu
						ON 		usu.usu_id = cc_est_ser_usuario_id
						WHERE `cc_est_ser_contrato_id` = '$cont_id' 
						ORDER BY `cc_est_ser_id` DESC LIMIT 1";

			return ejecutarConsultaSimpleFila($sql);
		}

	public function listarCantOtSede($servicio, $sede)
	{
		$grupo_sede = 	$_SESSION['usu_grupo_tecnica'];
		$id_sede 	= 	$_SESSION['usu_sede_id'];


		if ($_SESSION['usu_area_id'] == 7)
		{
			$sql = "SELECT `cont_estado_servicio_id`, 
					COUNT(*) as total FROM `contrato` 
					WHERE `cont_estado` = 1 
					AND cont_estado_servicio_id = '$servicio'";

		}	
		else if($_SESSION['usu_id'] == 40)
		// ESTA VALIDACIÓN VERIFICA LA SESION DE FIRAVITOBA Y MUESTRA LOS CONTRATOS DE IZA Y FIRA
		{
			$sql = "SELECT `cont_estado_servicio_id`, 
					COUNT(*) as total FROM `contrato` 
					INNER JOIN sede s 
					ON cont_sede_id 	= 	s.sed_id
					WHERE `cont_estado` = 1 
					AND cont_estado_servicio_id = '$servicio'
			 		AND s.sed_grupo_tecnica = 3
			 		OR s.sed_grupo_tecnica = 6
			 		AND cont_estado 	= 	1
			 		AND cont_estado_servicio_id = '$servicio'";
		}
		else if($_SESSION['usu_id'] == 54)
		{
			$sql = "SELECT `cont_estado_servicio_id`, 
					COUNT(*) as total FROM `contrato` 
					INNER JOIN sede s 
					ON cont_sede_id 	= 	s.sed_id
					WHERE `cont_estado` = 1 
					AND cont_estado_servicio_id = '$servicio'
			 		AND cont_sede_id = '$id_sede'
			 		AND cont_estado 	= 	1";	
		}
		else if($_SESSION['usu_area_id'] == 4)
		{
			$sql = "SELECT `cont_estado_servicio_id`, 
					COUNT(*) as total FROM `contrato` 
					INNER JOIN sede s 
					ON cont_sede_id 	= 	s.sed_id
					WHERE s.sed_grupo_tecnica = '$grupo_sede'
					AND cont_estado_servicio_id = '$servicio'
			 		AND `cont_estado` = 1
			 		OR cont_internet = 1
			 		AND cont_estado = 	1
			 		AND cont_estado_servicio_id = '$servicio'";

		}
		else if($_SESSION['usu_area_id'] == 9)
		{
			$sql = "SELECT `cont_estado_servicio_id`, 
					COUNT(*) as total FROM `contrato` 
					INNER JOIN sede s 
					ON cont_sede_id 	= 	s.sed_id
					WHERE `cont_estado` = 1 
					AND cont_estado_servicio_id = '$servicio'
			 		AND s.sed_grupo_tecnica = 3
			 		OR s.sed_grupo_tecnica = 6
			 		AND cont_estado 	= 	1
			 		AND cont_estado_servicio_id = '$servicio'
			 		OR s.sed_grupo_tecnica = 5
			 		AND cont_estado 	= 	1
			 		AND cont_estado_servicio_id = '$servicio'
			 		OR s.sed_grupo_tecnica = 4
			 		AND cont_estado 	= 	1
			 		AND cont_estado_servicio_id = '$servicio'";

		}
		else
		{
			$sql = "SELECT `cont_estado_servicio_id`, 
					COUNT(*) as total FROM `contrato` 
					INNER JOIN sede s 
					ON cont_sede_id 	= 	s.sed_id
					WHERE `cont_estado` = 1 
					AND cont_estado_servicio_id = '$servicio'
			 		AND s.sed_grupo_tecnica = '$grupo_sede'
			 		AND cont_estado 	= 	1";			
		}
			

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarServicios()
	{
		$sql = "SELECT * FROM `estado_servicio` 
				WHERE `est_serv_estado` = 1";

		return ejecutarConsulta($sql);
	}		

}


?>