var tabla;
// Encoded by @Francisco Monsalve

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
	$.post("../ajax/sede.php?op=slectCategoria", function(r){
		$("#ciudad").html(r);
		$("#ciudad").selectpicker('refresh');

	})

}

function limpiar(){
	// Los inputs del form deben tener los nombres establecidos a continuacion
	$("#sed_id").val("");
	$("#nombre").val("");
	$("#direccion").val("");
	$("#barrio").val("");
	$("#ciudad").val("");
	$("#tel1").val("");
	$("#tel2").val("");
	$("#estado").val("");
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
			url:'../ajax/sede.php?op=listar',
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

		url: "../ajax/sede.php?op=guardaryeditar",
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
function mostrar(sed_id){
	$.post("../ajax/sede.php?op=mostrar",{sed_id : sed_id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		// $("#nombredelinput") Corresponde al name de los inputs del form
		$("#sed_id").val(data.sed_id);
		$("#nombre").val(data.sed_nombre);
		$("#direccion").val(data.sed_direccion);
		$("#barrio").val(data.sed_barrio);
		$("#ciudad").val(data.sed_ciudad_id);
		$("#ciudad").selectpicker('refresh');
		$("#tel1").val(data.sed_telefono_1);
		$("#tel2").val(data.sed_telefono_2);
		$("#estado").val(data.sed_descripcion);
				
	});

	$.post("../ajax/sede.php?op=productos&id="+sed_id, function(r){
		$("#productos").html(r);
	});
}

// Funcion para desactivar un registro
function desactivar(sed_id){
	bootbox.confirm("¿Esta seguro de desactivar la sede?",function(result){
		if (result) {
			$.post("../ajax/sede.php?op=desactivar", {sed_id : sed_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Funcion para desactivar un registro
function activar(sed_id){
	bootbox.confirm("¿Esta seguro de activar la sede?",function(result){
		if (result) {
			$.post("../ajax/sede.php?op=activar", {sed_id : sed_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}


// Declaracion para ejecucion al iniciar
init();