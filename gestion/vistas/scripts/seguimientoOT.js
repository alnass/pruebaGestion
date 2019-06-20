// # encoded by @Anderson Ferrucho 
var tabla;
var tabla2;

	// Funcion que se ejecuta siempre al iniciar
function init(){
	// Hace referncia otras funciones implementadas
	// Oculta el formulario 
	mostrarform(false);
	// Carga la pagina con el listado de datos de la clase
	listar();

$.post("../ajax/seguimientoOT.php?op=nuevoestado", function(r){
		$("#nuevoestado").html(r);
		$("#nuevoestado").selectpicker('refresh');
	})

	// Si se hace click en el btnGuardar se ejecuta la funcion submit del formulario y ejecuta la funcion guardaryeditar
	$("#formnuevoestado").on("submit",function(e){
		guardarNuevoEstado(e);
	})


	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	})
}

	// Cargar las opciones de la lista 
	$.post("../ajax/ordenTrabajo.php?op=nuevoestado", function(r){
		$("#ord_trab_nva_operacion_id").html(r);
		$("#ord_trab_nva_operacion_id").selectpicker('refresh');

	})

	$.post("../ajax/ordenTrabajo.php?op=selectTecnico", function(r){
		$("#ord_trab_responsable_id").html(r);
		$("#ord_trab_responsable_id").selectpicker('refresh');

	})

function limpiar(){
	// Los inputs del form deben tener los nombres establecidos a continuacion
	$("#ord_trab_id").val("");
	$("#operacion").val("");
	$("#fecha_program").val("");
	$("#fecha_vence").val("");
	$("#observacion").val("");
	$("#contrato").val("");
	$("#ord_trab_responsable_id").selectpicker('refresh');
	$("#ord_trab_nva_operacion_id").selectpicker('refresh');
}

	// Interaccion para mostrar formulario o listado 
function mostrarform(flag){
	// Mantierne los inpus limpios
	limpiar();

	if (flag) {
		// Los divs deben contener los ids siguientes $("#nomberdiv")
		$("#listadoregistros").hide();
		$("#formularioregistro").show();

		// $("#btnGuardar").prop("disabled",false);
		$("#btnAgregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistro").hide();
		$("#btnAgregar").show();
	}
}

	// Calcea el formulario
function cancelarform(){

	limpiar();
	mostrarform(false);
}

	// Listar
function listar(){
	// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
	tabla=$('#tbllistado').dataTable({
		
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		
		// Define los elementos del control de la tabla
		dom: 'Bfrtip',

		// Definicion de los botones para html
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax":{
			url:'../ajax/seguimientoOT.php?op=listar',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,

		"iDisplayLength": 3,

		// orden de los datos [[columna, tipo de orden]]
		"order":[[7,"desc"]]
	}).DataTable();	 
}

// guardar y editar
function guardaryeditar(e){
	// Nose activara la accion predeterminada del evento submit
	e.preventDefault();
	// $("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({

		url: "../ajax/seguimientoOT.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		// Si la funcion se ejecuta de forma correcta
		success: function(datos){
			// Muestra los datos de reapuesta provenientes de ajax
			bootbox.alert(datos, function(){location.reload(true)});
			mostrarform(false);
			tabla.ajax.reload();
		}

	});
	limpiar();
}

function guardarNuevoEstado(e)
{
	// Nose activara la accion predeterminada del evento submit
	e.preventDefault();
	var formData 		=	new FormData($("#formnuevoestado")[0]);
	var observacion 	=	$("#ord_trab_observacion").val();

	bootbox.confirm("¿Esta seguro de cerrar esta orden y cambiar el estado del servicio?", function(result)
	{
		if (result == true) 
		{
			if($("#estado2").val()== 1)
			{/// realiza esta validación si el contrato es por instalar o por reconectar
				
					$.ajax({


						url: "../ajax/seguimientoOT.php?op=guardarNuevoEstado",
						type: "POST",
						data: formData,
						contentType: false,
						processData: false,

						// Si la funcion se ejecuta de forma correcta
						success: function(datos)
						{
							// Muestra los datos de respuesta provenientes del ajax
							bootbox.alert(datos, function(){location.reload(true)});
							mostrarform(false);
							tabla.ajax.reload();
						}

					});
					
					$.ajax({

						url: 	"../ajax/seguimientoOT.php?op=cobroprorrateo",
						type: 	"POST",
						data: 	formData,
						contentType: false,
						processData: false,

						success: function(datos)
						{
							// bootbox.alert(datos);
							mostrarform(false);
							tabla.ajax.reload();
						}
					});
				}
			else
			{
				$.ajax({

						url: "../ajax/seguimientoOT.php?op=guardarNuevoEstado",
						// url: 	"../ajax/seguimientoOT.php?op=cobroprorrateo",				
						type: "POST",
						data: formData,
						contentType: false,
						processData: false,

						// Si la funcion se ejecuta de forma correcta
						success: function(datos)
						{
							// Muestra los datos de reapuesta provenientes de ajax
							bootbox.alert(datos, function(){location.reload(true)});
							mostrarform(false);
							tabla.ajax.reload();
						}

					});
			}
		}
	})	
	
	limpiar();
}

// Mostrar los datos en los inpts del form
function mostrar(ord_trab_id){
	$.post("../ajax/seguimientoOT.php?op=mostrar",{ord_trab_id : ord_trab_id}, function(data, status)
	{
		data = JSON.parse(data);
		// var utfdecodif 	=	utf8_decode(data.ord_trab_observacion);

		mostrarform(true);

 		// $("#nombredelinput") Corresponde al name de los inputs del form
		$("#numDoc").val(data.per_num_documento);
		$("#nombre").val(data.per_nombre);
		$("#apellido").val(data.per_apellido);
		$("#ciudad").val(data.ciu_nombre);
		$("#direccion").val(data.per_direccion);
		$("#tel1").val(data.per_telefono_1);
		$("#cont_id").val(data.cont_no_contrato + '-' + data.cont_id);
		$("#m_contratoid").val(data.cont_no_contrato + '-' + data.cont_id);
		$("#ord_trab_contrato_id").val(data.cont_id);
		$("#v_contratoid").val(data.cont_id);
		$("#barrInst").val(data.cont_barrio);
		$("#marca").val(data.per_marca);
		$("#alianza").val(data.ali_nombre);
		$("#expedCont").val(data.cont_vigencia_a_partir);
		$("#direcInst").val(data.cont_direccion_serv);
		$("#correoPer").val(data.per_correo_personal);
		$("#tel2").val(data.per_telefono_2);
		$("#tipoVivien").val(data.tip_viv_nombre);
		$("#estado").val(data.est_serv_nombre);
		$("#estado2").val(data.est_serv_id);
		$("#ord_trab_fecha_programacion").val(data.ord_trab_fecha_programacion);
		$("#ord_trab_fecha_vencimiento").val(data.ord_trab_fecha_vencimiento);
		$("#ord_trab_fecha_vencia").val(data.ord_trab_fecha_vencimiento);
		$("#tec_asignado").val(data.usu_nombre + ' ' + data.usu_apellido);
		$("#tec_cierre").val(data.usu_id);
		$("#ot_id").val(data.ord_trab_id);
		$("#s_ot_id").val(data.ord_trab_id);
		$("#ord_trab_id").val(data.ord_trab_id);
		$("#ot_id_lbl").val(data.ord_trab_id);
		$("#sede").val(data.sed_nombre);
		$("#operacion").val(data.operacion);
		$("#ant_operacion").val(data.est_serv_id);
		$("#per_id").val(data.per_id);
		$("#mensualidad").val(data.cont_valor_basico_mes);
		// $("#ant_resp_id").val(data.cont_valor_basico_mes);
		$("#ord_trab_responsable_id").val('');
		$("#ord_trab_nva_operacion_id").val('');
		$("#nuevoestado").val('');
		$("#ant_obsrv").val(data.ord_trab_observacion);


		$("#ant_obsrvacion").val('Fecha elaboracion ' +  data.ord_trab_fecha_elaboracion + ' Usuario: ' + data.usu_resp_nombre  + '  ' +data.usu_resp_apellido +'\n'+ data.ord_trab_observacion);

		listarEquipoInstalado(data.cont_id);
		listarOTS(ord_trab_id);
		listarProductos(data.cont_id);

		if(data.est_serv_id == 1)
		{
			$("#reasig_operacion").hide("fast");
			$("#ord_trab_nva_operacion_id").val(1);
			$("#ord_trab_nva_operacion_id").removeAttr("required");
		}

	})
	
}


function mostrar2(ord_trab_id){
	$.post("../ajax/seguimientoOT.php?op=mostrar",{ord_trab_id : ord_trab_id}, function(data, status)
	{
		data = JSON.parse(data);

 		// $("#nombredelinput") Corresponde al name de los inputs del form
		$("#m_contratoid").val(data.cont_no_contrato + '-' + data.cont_id);
		$("#v_contratoid").val(data.cont_id);
		$("#mensualidad").val(data.cont_valor_basico_mes);
		$("#per_id").val(data.per_id);
		$("#s_ot_id").val(data.ord_trab_id);
		$("#ord_trab_id").val(data.ord_trab_id);
		$("#estado2").val(data.est_serv_id);
		$("#nuevoestado").val('');
	})
	
}

function listarEquipoDetalle(){
	// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
	tabla3=$('#tblequipos').dataTable({
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'Bfrtip',

		// Modifica el mensaje que muestra con tablas vacias 
		"language":
		{
			"sEmptyTable": "No hay equipos disponibles"
		},

		// Definicion de los botones para html
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax":{
			url:'../ajax/seguimientoOT.php?op=listarEquipoDetalle',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		// Paginacion 
		"iDisplayLenght": 3,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[0,"asc"]]
	}).DataTable();	 
}


function listarProductos(cont_id)
{

	tabla2=$('#tblproducto').dataTable({
			// desactiva paginación del datatable	
			paging:false,
			// desactiva la busqueda
			searching: false,
			// Modifica el mensaje del contador de registros 
			"language":
			{
				"info": ""
			},
			// Activar el procesamiento de los datatables
			"aProcessing": true,
			// Paginacion y filtrado realizado por el servidor
			"aServerSide": true,
			// Define los elementos del control de la tabla
			dom: 'Bfrtip',
			// Definicion de los botones para html
			buttons: [
			],
			"ajax":{
				url:'../ajax/seguimientoOT.php?op=listarProductos', 
				data: {cont_id}, // son los datos que se envian a la funcion
				type: "POST", // el metodo por el cual los recibe
				dataType: "json",
				error: function(e){
					console.log(e.responseText);
				}
			},
			"bDestroy": true,
			// Paginacion 
			"iDisplayLenght": 3,
			// orden de los datos [[columna, tipo de orden]]
			"order":[[0,"asc"]]
		}).DataTable();	 
}


function listarEquipoInstalado(cont_id){
	// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
	tabla4=$('#tblinstalado').dataTable({
		"columnDefs": 
		[
        	{"className": "dt-center", "targets": "_all"}
      	],
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'Bfrtip',

		// Modifica el mensaje que muestra con tablas vacias 
		"language":
		{
			"sEmptyTable": "El usuario no tiene equipos asociados"
		},

		// Definicion de los botones para html
		buttons: [
			],
		"ajax":{
			url:'../ajax/seguimientoOT.php?op=listarEquipoInstalado',
			data: {cont_id},
			type: "post",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		// Paginacion 
		"iDisplayLenght": 3,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[0,"asc"]]
	}).DataTable();	 
}


function asignarEquipo(equi_det_id, equi_tip_nombre, equi_referencia, equi_det_mac, equi_det_sn)
{
	var contador = 0;
	var detalles = 0;
	var cantidad = 1;

	if (equi_det_id != "") 
	{

		var fila = '<tr class="filas" id="fila'+contador+'">'+
		'<td><button type="button" data-toggle="tooltip" title="Eliminar Equipo" class="btn btn-danger" onclick="eliminarAsignacion('+contador+')">X</button></td>'+
		'<td><input type="hidden" name="id_detalle_equipo[]" value="'+equi_det_id+'">'+equi_tip_nombre+'</td>'+
		'<td><input type="hidden" name="equipo_referencia[]" value="'+equi_referencia+'">'+equi_referencia+'</td>'+
		'<td><input type="hidden" name="equipo_mac[]" value="'+equi_det_mac+'">'+equi_det_mac+'</td>'+
		'<td><input type="hidden" name="equipo_sn[]" value="'+equi_det_sn+'">'+equi_det_sn+'</td>'+
		'<td><select name="cliente[]" required=""><option value=""></option><option value="1">Si</option><option value="0">No</option></td>'+
		'</tr>';
		contador++;
		detalles++;
		$('#tblasignacion').append(fila);
	}
	else
	{
		bootbox.alert("Error al asignar el equipo");
	}
}

function eliminarAsignacion(indice)
{
	$("#fila"+indice).remove();
	detalles = detalles - 1;
}

function listarOTS(ord_trab_id){
	// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
	tabla=$('#tblOTS').dataTable({
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'Bfrtip',

		// Definicion de los botones para html
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax":{
			url:'../ajax/seguimientoOT.php?op=listarOTS',
			data: {ord_trab_id},
			type: "post",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		// Paginacion 
		"iDisplayLenght": 3,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[0,"asc"]]
	}).DataTable();	 
}


// Declaracion para ejecucion al iniciar
init();