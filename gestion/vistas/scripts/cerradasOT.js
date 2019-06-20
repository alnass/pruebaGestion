// Encoded by @Anderson Ferrucho
var tabla;
var tabla2;

// funcion que se ejecuta siempre al iniciar
function init(){
// hace referncia otras funciones implementadas
// Oculta el formulario 
	mostrarform(false);
// // Carga la pagina con el listado de datos de la clase
	listar();

// Si se hace click en el btnGuardar se ejecuta la funcion submit del formulario y ejecuta la funcion guardaryeditar
	$("#formnuevoestado").on("submit",function(e){
		guardarNuevoEstado(e);
	})

	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	})
}


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
}

// Listar
function listar()
{
	// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
	tabla=$('#tbllistado').dataTable({
		// Activar el procesamiento de los datatables

		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'Bfrtip',

		"lengthMenu": true,
		// Definicion de los botones para descargar
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax":{
			url:'../ajax/cerradasOT.php?op=listar',
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
		"order":[[7,"desc"]]
	}).DataTable();	 

}


function mostrar2(ord_trab_id)
{
	$.post("../ajax/cerradasOT.php?op=mostrar",{ord_trab_id : ord_trab_id}, function(data, status)
	{
		data = JSON.parse(data);

 		// $("#nombredelinput") Corresponde al name de los inputs del form
		$("#m_contratoid").val(data.cont_no_contrato + '-' + data.cont_id);
		$("#v_contratoid").val(data.cont_id);
		$("#mensualidad").val(data.cont_valor_basico_mes);
		$("#per_id").val(data.per_id);
		$("#ant_obsrvacion").val(data.ord_trab_observacion);
		$("#ord_trab_fecha_programacion").val(data.ord_trab_fecha_programacion);
		$("#tec_asignado").val(data.usu_nombre + ' ' + data.usu_apellido);
		$("#ord_trab_fecha_cierre").val(data.ord_trab_cie_fecha);
		$("#operacion").val(data.est_serv_inic);
		$("#s_ot_id").text(data.ord_trab_id);
		$("#ord_trab_id").val(data.ord_trab_id);
		$("#estado2").val(data.est_serv_id);
		$("#nuevoestado").val('');

		listarOTS(data.ord_trab_id);
		// listarOTS(data.ord_trab_id);
		// listarOT(data.ord_trab_id);
	})

	
}

function listarOT(ord_trab_id){
	// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")

	tabla=$('#tblOTS').dataTable({
		// Activar el procesamiento de los datatables

		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		paging:false,
			// desactiva la busqueda
		searching: false,
		dom: 'Bfrtip',
		// Definicion de los botones para html
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax":{
			url: '../ajax/cerradasOT.php?op=listarOT', 
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
		"order":[[0,"desc"]]

	}).DataTable();	 
}

function listarOTS(ord_trab_id){
	// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
	tabla=$('#tblOTS').dataTable({
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		paging:false,
			// desactiva la busqueda
		searching: false,
		dom: 'Bfrtip',
		// Definicion de los botones para html
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax":{
			url:'../ajax/cerradasOT.php?op=listarOTS',
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
		"order":[[0,"desc"]]
	}).DataTable();	 
}


// Declaracion para ejecucion al iniciar
init();