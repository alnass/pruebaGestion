// # encoded by @Francisco Monsalve
var tabla;
// funcion que se ejecuta siempre al iniciar
function init(){
// Haace referncia otras funciones implementadas
// Oculta el formulario 
	mostrarform(false);
// Carga la pagina con el listado de datos de la clase
	listar();
// Si se hace click en el btnGuardar se ejecuta la funcion submit del formulario y ejecuta la funcion guardaryeditar
	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	})
// Cargar las opciones del la lista 
	$.post("../ajax/alianza.php?op=selectCiudad", function(r){
		$("#ciudad_id").html(r);
		$("#ciudad_id").selectpicker('refresh');
	})
}
function limpiar(){
	// Los inputs del form deben tener los nombres establecidos a continuacion
	// 	ali_id
	$("#ali_id").val("");
	$("#nombre").val("");
	$("#documento").val("");
	$("#desc").val("");
	$("#num_contacto").val("");
	$("#nombre_contacto").val("");
	$("#apellido_contacto").val("");
	$("#correo_contacto").val("");
	$("#correo_corporativo").val("");
	$("#telefono_oficina").val("");
	$("#direccion_oficina").val("");
	$("#ciudad_id").val("");
	$("#barrio").val("");
	$("#cobertura").val("");
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
			url:'../ajax/alianza.php?op=listar',
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
		url: "../ajax/alianza.php?op=guardaryeditar",
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
function mostrar(ali_id){
	$.post("../ajax/alianza.php?op=mostrar",{ali_id : ali_id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		// $("#nombredelinput") Corresponde al name de los inputs del form
		$("#ali_id").val(data.ali_id);
		$("#nombre").val(data.ali_nombre);
		$("#documento").val(data.ali_no_documento);
		$("#desc").val(data.ali_descripcion);
		$("#num_contacto").val(data.ali_num_contacto);
		$("#nombre_contacto").val(data.ali_nombre_contacto);
		$("#apellido_contacto").val(data.ali_apellido_contacto);
		$("#correo_contacto").val(data.ali_correo_contacto);
		$("#correo_corporativo").val(data.ali_correo_corporativo);
		$("#telefono_oficina").val(data.ali_telefono_oficina);
		$("#direccion_oficina").val(data.ali_direccion_oficina);
		$("#ciudad_id").val(data.ali_ciudad_id);
		$("#barrio").val(data.ali_barrio);
		$("#cobertura").val(data.ali_cobertura);
	})
}
// Funcion para desactivar un registro
function desactivar(ali_id){
	bootbox.confirm("¿Esta seguro de desactivar el tipo de persona?",function(result){
		if (result) {
			$.post("../ajax/alianza.php?op=desactivar", {ali_id : ali_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}
// Funcion para desactivar un registro
function activar(ali_id){
	bootbox.confirm("¿Esta seguro de activar el tipo de persona?",function(result){
		if (result) {
			$.post("../ajax/alianza.php?op=activar", {ali_id : ali_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}
// Declaracion para ejecucion al iniciar
init();