/// # encoded by @Anderson Ferrucho 

var tabla;

// funcion que se ejecuta siempre al iniciar
function init(){
// hace referncia otras funciones implementadas
// Oculta el formulario 
	mostrarform(false);
// Carga la pagina con el listado de datos de la clase
	listar();

// Si se hace click en el btnGuardar se ejecuta la funcion submit del formulario y ejecuta la funcion guardaryeditar
	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	})

	$("#frm_trasl").on("submit",function(e){
		guardartraslado(e);
	})

	limpiar();
}



// Cargar las opciones de la lista 
$.post("../ajax/equipoDetalle.php?op=selectEquipoEstado", function(r){
		$("#estado").html(r);
		$("#estado").selectpicker('refresh');

	})
$.post("../ajax/equipoDetalle.php?op=selectTipoMovimiento", function(r){
		$("#movimiento").html(r);
		$("#movimiento").selectpicker('refresh');

	})
$.post("../ajax/equipoDetalle.php?op=selectSede", function(r){
		$("#sede").html(r);
		$("#sede").selectpicker('refresh');

	})
$.post("../ajax/equipoDetalle.php?op=selectReferenciaEquipo", function(r){
		$("#referencia").html(r);
		$("#referencia").selectpicker('refresh');

	})


function limpiar(){
	// Los inputs del form deben tener los nombres establecidos a continuacion
	$("#equi_det_id").val("");
	$("#referencia").val("");
	$("#referencia").selectpicker('refresh');
	$("#mac").val("");
	$("#serial").val("");
	$("#fecha_ingreso").val("");
	$("#estado").val("");
	$("#estado").selectpicker('refresh');
	$("#movimiento").val("");
	$("#movimiento").selectpicker('refresh');
	$("#sede").val("");
	$("#sede").selectpicker('refresh');
}

// Interaccion para mostrar formulario o listado 
function mostrarform(flag){
	// Mantierne los inpus limpios
	limpiar();

	if (flag) {
		// Los divs deben contener los ids siguientes $("#nomberdiv")
		$("#listadoregistros").hide();
		$("#formularioregistro").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnAgregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistro").hide();
		$("#btnAgregar").show();
	}
}

// Calcea el formulario
function cancelarform()
{
	limpiar();
	mostrarform(false);
	location.reload(true);
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
			url:'../ajax/equipoDetalle.php?op=listar',
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
		"order":[[8,"desc"]]
	}).DataTable();	 
}

// guardar y editar
function guardaryeditar(e){
	// Nose activara la accion predeterminada del evento submit
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({

		url: "../ajax/equipoDetalle.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		// Si la funcion se ejecuta de forma correcta
		success: function(datos){
			// Muestra los datos de reapuesta provenientes de ajax
			bootbox.alert(datos);
			mostrarform(false);
			tabla.ajax.reload();
		}

	});
	limpiar();
}

function guardartraslado(e){
	// Nose activara la accion predeterminada del evento submit
	e.preventDefault();
	var formData = new FormData($("#frm_trasl")[0]);

	$.ajax({

		url: "../ajax/traslado.php?op=guardartraslado",
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
// Mostrar los datos en los inpts del form
function mostrar(equi_det_id){
	$.post("../ajax/traslado.php?op=listarultimotraslado", function(data, status)
	{
		data = JSON.parse(data);
		$("#orden_traslado").val(parseInt(data.trasl_id)+1);
		$("#orden_traslado").val(data.trasl_id);
	})

	$.post("../ajax/equipoDetalle.php?op=mostrar",{equi_det_id : equi_det_id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		$("#equi_det_id").val(data.equi_det_id);
		$("#mac").val(data.equi_det_mac);
		$("#serial").val(data.equi_det_sn);
		$("#estado").val(data.equi_det_estado_id);
		$("#estado").selectpicker('refresh');
		$("#fecha_ingreso").val(data.equi_det_fecha_entrada);
		$("#referencia").val(data.equi_det_equipo_id);
		$("#referencia").selectpicker('refresh');
		$("#remisionNo").val(data.equi_det_remision_in);
		$("#equipo_id").val(data.equi_det_id);
		$("#sed_actl").val(data.equi_det_sede);
		$("#eqp_est").val(data.equi_det_estado_id);

	})
}

// Declaracion para ejecucion al iniciar
init();