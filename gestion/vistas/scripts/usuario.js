var tabla;
// # encoded by @Francisco Monsalve
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
// 	|	c	|ciudad 		| ciu_id 		|ciu_nombre 	|usu_ciudad_id			|
// 	|	s	|sede 			| sed_id 		|sed_nombre 	|usu_sede_id			|
// 	|	a	|area   		| are_id 		|are_nombre 	|usu_area_id			|
// 	|	g	|cargo  		| car_id 		|car_nombre 	|usu_cargo_id			|
// 	|	t	|tipo_documento | tip_doc_id 	|tip_doc_nombre |usu_tipo_documento_id	|

// CASOS OP DE AJAX
// 		selectCiudad
// 		selectSede
// 		selectArea
// 		selectCargo
// 		selectTipDoc

// NOMBRES DE LOS INPUTS DEL HTMPL
// 		ciudad
// 		sede
// 		area
// 		cargo
// 		tipoDoc

	$("#imagenmuestra").hide();


	// Cargar las opciones del la lista 
	$.post("../ajax/usuario.php?op=selectCiudad", function(r){
		$("#ciudad").html(r);
		$("#ciudad").selectpicker('refresh');

	});
// Cargar las opciones del la lista 
	$.post("../ajax/usuario.php?op=selectSede", function(r){
		$("#sede").html(r);
		$("#sede").selectpicker('refresh');

	});
// Cargar las opciones del la lista 
	$.post("../ajax/usuario.php?op=selectArea", function(r){
		$("#area").html(r);
		$("#area").selectpicker('refresh');

	});
// Cargar las opciones del la lista 
	$.post("../ajax/usuario.php?op=selectCargo", function(r){
		$("#cargo").html(r);
		$("#cargo").selectpicker('refresh');

	});
// Cargar las opciones del la lista 
	$.post("../ajax/usuario.php?op=selectTipDoc", function(r){
		$("#tipoDoc").html(r);
		$("#tipoDoc").selectpicker('refresh');
	});
// Mostrar los permisos 
	$.post("../ajax/usuario.php?op=permisos&id=", function(r){
		$("#permisos").html(r);
	});

// Cargar las opciones del la lista 
	$.post("../ajax/persona.php?op=selecAlianza", function(r){
		$("#alianza").html(r);
		$("#alianza").selectpicker('refresh');
	})
}
 		 
function limpiar(){
	// Los inputs del form deben tener los nombres establecidos a continuacion
	$("#usu_id").val("");
	$("#ciudad").val("");
	$("#sede").val("");
	$("#area").val("");
	$("#cargo").val("");
	$("#alianza").val("");
	$("#tipoDoc").val("");
	$("#numDoc").val("");
	$("#nombre").val("");
	$("#apellido").val("");
	$("#nacimiento").val("");
	$("#tel1").val("");
	$("#tel2").val("");
	$("#direccion").val("");
	$("#correoPer").val("");
	$("#correoCorp").val("");
	$("#login").val("");
	$("#pass").val("");
	$('#imagen').val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	
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
			url:'../ajax/usuario.php?op=listar',
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

		url: "../ajax/usuario.php?op=guardaryeditar",
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
function mostrar(usu_id){
	$.post("../ajax/usuario.php?op=mostrar",{usu_id : usu_id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		// $("#nombredelinput") Corresponde al name de los inputs del form
//  DESCRIPCION DE RELACION DE CAMPOS
//  -----------------------------------------------------------------
// 	| ALIAS	| TABLA 	    | CAMPO 		|MUESTRA |		RELACION				|	
//  -----------------------------------------------------------------
// 	|	u	|				|				|				|usu_id 				|
// 	|	c	|ciudad 		| ciu_id 		|ciu_nombre 	|usu_ciudad_id			|
// 	|	s	|sede 			| sed_id 		|sed_nombre 	|usu_sede_id			|
// 	|	a	|area   		| are_id 		|are_nombre 	|usu_area_id			|
// 	|	g	|cargo  		| car_id 		|car_nombre 	|usu_cargo_id			|
// 	|	t	|tipo_documento | tip_doc_id 	|tip_doc_nombre |usu_tipo_documento_id	|
//  |		|				|				|				|usu_num_documento		|
// 	|		|				|				|				|usu_nombre				|
// 	|		|				|				|				|usu_apellido			|
// 	|		|				|				|				|usu_fecha_nacimiento	|
// 	|		|				|				|				|usu_telefono_1			|
// 	|		|				|				|				|usu_telefono_2			|
// 	|		|				|				|				|usu_direccion			|
// 	|		|				|				|				|usu_correo_personal	|
// 	|		|				|				|				|usu_correo_cop			|
// 	|		|				|				|				|usu_login				|
// 	|		|				|				|				|usu_pass				|
// 	|		|				|				|				|usu_permiso			|
//  -----------------------------------------------------------------
		$("#usu_id").val(data.usu_id);

		$("#ciudad").val(data.usu_ciudad_id);
		$("#ciudad").selectpicker('refresh');

		$("#sede").val(data.usu_sede_id);
		$("#sede").selectpicker('refresh');

		$("#area").val(data.usu_area_id);
		$("#area").selectpicker('refresh');

		$("#cargo").val(data.usu_cargo_id);
		$("#cargo").selectpicker('refresh');

		$("#alianza").val(data.usu_alianza_id);
		$("#alianza").selectpicker('refresh');

		$("#tipoDoc").val(data.usu_tipo_documento_id);
		$("#tipoDoc").selectpicker('refresh');
		
		$("#numDoc").val(data.usu_num_documento);
		$("#nombre").val(data.usu_nombre);
		$("#apellido").val(data.usu_apellido);
		$("#nacimiento").val(data.usu_fecha_nacimiento);
		$("#tel1").val(data.usu_telefono_1);
		$("#tel2").val(data.usu_telefono_2);
		$("#direccion").val(data.usu_direccion);
		$("#correoPer").val(data.usu_correo_personal);
		$("#correoCorp").val(data.usu_correo_cop);
		$("#login").val(data.usu_login);
		$("#pass").val(data.usu_pass);
		$("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../files/perfiles/"+data.usu_imagen)
		$("#imagenactual").val(data.usu_imagen)
		$("#permiso").val(data.usu_permiso);

	});

	$.post("../ajax/usuario.php?op=permisos&id="+usu_id, function(r){
		$("#permisos").html(r);
	});
}

// Funcion para desactivar un registro
function desactivar(usu_id){
	bootbox.confirm("¿Esta seguro de desactivar la usuario?",function(result){
		if (result) {
			$.post("../ajax/usuario.php?op=desactivar", {usu_id : usu_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

// Funcion para desactivar un registro
function activar(usu_id){
	bootbox.confirm("¿Esta seguro de activar la usuario?",function(result){
		if (result) {
			$.post("../ajax/usuario.php?op=activar", {usu_id : usu_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}


// Declaracion para ejecucion al iniciar
init();