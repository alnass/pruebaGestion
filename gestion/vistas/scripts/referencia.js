var tabla;
/// # encoded by 

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

	// Cargar las opciones de la lista 
	$.post("../ajax/equipo.php?op=slectTipoEquipo", function(r){
		$("#tipoequipo").html(r);
		$("#tipoequipo").selectpicker('refresh');

	})

	$.post("../ajax/equipo.php?op=selectFabricante", function(r){
		$("#fabricante").html(r);
		$("#fabricante").selectpicker('refresh');
	})


}

function limpiar(){
	// Los inputs del form deben tener los nombres establecidos a continuacion
	$("#equi_id").val("");
	$("#referencia").val("");
	$("#descripcion").val("");
	$("#tipoequipo").selectpicker('refresh');
	$("#fabricante").selectpicker('refresh');
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
			url:'../ajax/referencia.php?op=listar',
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
		"order":[[1,"asc"]]
	}).DataTable();	 
}

// guardar y editar
function guardaryeditar(e){
	// Nose activara la accion predeterminada del evento submit
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({

		url: "../ajax/referencia.php?op=guardaryeditar",
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
function mostrar(equi_id){
	$.post("../ajax/referencia.php?op=mostrar",{equi_id : equi_id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		// $("#nombredelinput") Corresponde al name de los inputs del form
		$("#equi_id").val(data.equi_id);
		$("#referencia").val(data.equi_referencia);
		$("#tipoequipo").val(data.equi_tipo_id);
		$("#descripcion").val(data.equi_descripcion);
		$("#fabricante").val(data.equi_fabricante_id);
		$("#tipoequipo").selectpicker('refresh');
		$("#fabricante").selectpicker('refresh');
				
	});

}

// Funcion para desactivar un registro
function desactivar(equi_id){
	bootbox.confirm("¿Esta seguro de desactivar esta referencia? Se desactivaran todos los equipos asociados ",function(result){
		if (result) {
			$.post("../ajax/equipo.php?op=desactivar", {equi_id : equi_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Funcion para desactivar un registro
function activar(equi_id){
	bootbox.confirm("¿Esta seguro de activar este equipo?",function(result){
		if (result) {
			$.post("../ajax/equipo.php?op=activar", {equi_id : equi_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}


function detalle(equi_id){
	// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
	tabla=$('#equipoDetalle').dataTable({
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
			url:'../ajax/referencia.php?op=detalle',
			type: "post",
			data: {equi_id},
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		// Paginacion 
		"iDisplayLenght": 3,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[6,"asc"]]
	}).DataTable();	 
}


// Declaracion para ejecucion al iniciar
init();