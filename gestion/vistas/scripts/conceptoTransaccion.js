// # encoded by @Francisco Monsalve

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
// Cargar las opciones del la lista 
	$.post("../ajax/conceptoTransaccion.php?op=selectTransaccion", function(r){
		$("#transaccion").html(r);
		$("#transaccion").selectpicker('refresh');
	})
// Cargar las opciones del la lista 
	$.post("../ajax/conceptoTransaccion.php?op=selectAreaTransaccion", function(r){
		$("#area_trans").html(r);
		$("#area_trans").selectpicker('refresh');
	})
}

function limpiar(){
	// Los inputs del form deben tener los nombres establecidos a continuacion
	// 	ali_id

	$("#con_tran_id").val("");
	$("#area_trans").val("");
	$("#transaccion").val("");
	$("#tran_nombre").val("");
	$("#descripcion").val("");

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
			url:'../ajax/conceptoTransaccion.php?op=listar',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		// Paginacion 
		"iDisplayLenght": 5,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[0,"asc"]]
	}).DataTable();	 
}

// guardar y editar
function guardaryeditar(e){
	// Nose activara la accion predeterminada del evento submit
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({

		url: "../ajax/conceptoTransaccion.php?op=guardaryeditar",
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

// Mostrar los datos en los inpts del form
function mostrar(con_tran_id){
	$.post("../ajax/conceptoTransaccion.php?op=mostrar",{con_tran_id : con_tran_id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		// $("#nombredelinput") Corresponde al name de los inputs del form

		$("#con_tran_id").val(data.con_tran_id);
		$("#area_trans").val(data.con_tran_area_trans_id);
		$("#transaccion").val(data.con_tran_transaccion_id);
		$("#tran_nombre").val(data.con_tran_nombre);
		$("#descripcion").val(data.con_tran_descripcion);
		
	})
}

// Funcion para desactivar un registro
function desactivar(con_tran_id){
	bootbox.confirm("¿Esta seguro de desactivar este concepto de transaccion?",function(result){
		if (result) {
			$.post("../ajax/conceptoTransaccion.php?op=desactivar", {con_tran_id : con_tran_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Funcion para desactivar un registro
function activar(con_tran_id){
	bootbox.confirm("¿Esta seguro de activar este concepto de transaccion?",function(result){
		if (result) {
			$.post("../ajax/conceptoTransaccion.php?op=activar", {con_tran_id : con_tran_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}


// Declaracion para ejecucion al iniciar
init();