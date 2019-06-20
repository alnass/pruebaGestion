var tabla;
/// # encoded by @Anderson Ferrucho
// funcion que se ejecuta siempre al iniciar
function init(){
// hace referencia otras funciones implementadas
// Oculta el formulario 
	mostrarform(false);
// Carga la pagina con el listado de datos de la clase
	listar();

// Si se hace click en el btnGuardar se ejecuta la funcion submit del formulario y ejecuta la funcion guardaryeditar
	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	})

	$.post("../ajax/fabricante.php?op=slectCategoria", function(r){
		$("#ciudad").html(r);
		$("#ciudad").selectpicker('refresh');

	})

	$.post("../ajax/persona.php?op=selecTipoDocumento", function(r){
		$("#tipoDoc").html(r);
		$("#tipoDoc").selectpicker('refresh');
	})


}

function limpiar(){
	// Los inputs del form deben tener los nombres establecidos a continuacion
	$("#fab_id").val("");
	$("#nombre").val("");
	$("#tip_doc_id").val("");
	$("#documento").val("");
	$("#direccion").val("");
	$("#telefono").val("");
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
function cancelarform(){

	limpiar();
	mostrarform(false);
}

// Listar
function listar(){
	// tbllistado es el ID de una tabla html que recibe tel1es por dataTable $("#nombretabla")
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
			url:'../ajax/fabricante.php?op=listar',
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

		url: "../ajax/fabricante.php?op=guardaryeditar",
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
function mostrar(fab_id){
	$.post("../ajax/fabricante.php?op=mostrar",{fab_id : fab_id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		// $("#nombredelinput") Corresponde al name de los inputs del form
		$("#fab_id").val(data.fab_id);
		$("#nombre").val(data.fab_nombre);
		$("#tip_doc_id").val(data.fab_tip_doc_id);
		$("#tip_doc_id").selectpicker('refresh');
		$("#documento").val(data.fab_documento);
		$("#direccion").val(data.fab_direccion);
		$("#telefono").val(data.fab_telefono);
		$("#ciudad").val(data.fab_ciudad_id);
		$("#ciudad").selectpicker('refresh');
				
	});

}

// Funcion para desactivar un registro
function desactivar(fab_id){
	bootbox.confirm("¿Esta seguro de desactivar este fabricante?",function(result){
		if (result) {
			$.post("../ajax/fabricante.php?op=desactivar", {fab_id : fab_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Funcion para desactivar un registro
function activar(fab_id){
	bootbox.confirm("¿Esta seguro de activar este fabricante?",function(result){
		if (result) {
			$.post("../ajax/fabricante.php?op=activar", {fab_id : fab_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Declaracion para ejecucion al iniciar
init();