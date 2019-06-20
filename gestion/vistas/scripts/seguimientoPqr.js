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

	$.post("../ajax/seguimientoPqr.php?op=selectArea", function(r){
		$("#nvoremision").html(r);
		$("#nvoremision").selectpicker('refresh');

	})

}

 		 
function limpiar(){
	// Los inputs del form deben tener los nombres establecidos a continuacion

	$("#reg_pqr_id").val("");
	$("#canal").val("");
	$("#tipoCanal").val("");
	$("#producto").val("");
	$("#tipoPqr").val("");
	$("#categoriaPqr").val("");
	$("#persona").val("");
	$("#remitido").val("");
	$("#numRadicado").val("");
	$("#fechaInicio").val("");
	$("#fechaRemision").val("");
	$("#fechaFin").val("");
	$("#ticket").val("");
	$("#operador").val("");
	$("#dias").val("");
	$("#observacion").val("");

	$("#seg_id").val(""); 			
	$("#nvoremision").val("");
	// $("#fechaenvio").val(""); 
	$("#fechaRev").val(""); 
	$("#obseguimiento").val("");	
	
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
	$("#insertarobservacion").show();
	$("#cerrarPqr").show();
	$("#btnGuardar").show();

}

// Listar
function listar(){
	// tbllistado es el ID de una tabla html que recibe tel1es por dataTable $("#nombretabla")
	tabla=$('#tbllistado').dataTable({
				// Ordena los elementos segun el indice del arreglo
		
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'Bfrtip',

		//Definicion de los botones para html
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax":{
			url:'../ajax/seguimientoPqr.php?op=listar',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		// Paginacion 
		"iDisplayLenght": 25,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[11,"asc"]]
	}).DataTable();	 
}


// guardar y editar
function guardaryeditar(e){
	// Nose activara la accion predeterminada del evento submit
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);


	$.ajax({

		url: "../ajax/seguimientoPqr.php?op=guardaryeditar",
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
function mostrar(reg_pqr_id){

	$.post("../ajax/seguimientoPqr.php?op=mostrar",{reg_pqr_id : reg_pqr_id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		// $("#nombredelinput") Corresponde al name de los inputs del form

		console.log(data);
		// Datos del suscriptor
		$("#persona").val(data.per_nombre+" "+data.per_apellido);
		$("#direccion").val(data.per_direccion);
		$("#telefono").val(data.per_telefono_1);
		$("#correo").val(data.per_correo_personal);
		
		// Datos de la PQR's
		$("#reg_pqr_id").val(data.reg_pqr_id);
		$("#canal").val(data.can_nombre);
		$("#tipoCanal").val(data.tip_can_nombre);
		$("#producto").val(data.prod_nombre);
		$("#tipoPqr").val(data.tip_pqr_nombre);
		$("#categoriaPqr").val(data.cat_pqr_nombre);
		$("#remitido").val(data.are_nombre);
		$("#numRadicado").val(data.reg_pqr_num_radicado);
		$("#fechaInicio").val(data.reg_pqr_fecha_inicio);
		$("#fechaRemision").val(data.reg_pqr_fecha_remision);
		$("#fechaFin").val(data.reg_pqr_fecha_fin);
		$("#ticket").val(data.reg_pqr_ticket_interno);
		$("#operador").val(data.usu_nombre+" "+data.usu_apellido);
		$("#dias").val(data.reg_pqr_dias_respuesta);
		$("#observacion").val(data.reg_pqr_observacion);


	});

}

function listarseguimiento(reg_pqr_id){

// 	var datos = $.post("../ajax/seguimientoPqr.php?op="+reg_pqr_id,{reg_pqr_id : reg_pqr_id},function(data, status)
// 	{
				
// } );


tabla=$('#tblseguimiento').dataTable({
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'frtip',

		//Definicion de los botones para html
		buttons: [
			
		],
		"ajax":{
			url:"../ajax/listarSeguimiento.php?reg_pqr_id="+reg_pqr_id,
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
// Funcion para desactivar un registro
function cerrarpqr(){

	
			var formData = new FormData($("#formulario")[0]);

	bootbox.confirm("¿Esta seguro de cerar la PQR?",function(result){
		if (result) {

			if ($("#nvoremision").val() != 5) {
				bootbox.alert("Debe seleccionar CAll-CENTER como area de remision final")
			}else{
				$.ajax({

					url: "../ajax/seguimientoPqr.php?op=guardaryeditar",
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,

					// Si la funcion se ejecuta de forma correcta
					success: function(datos){
						// Muestra los datos de reapuesta provenientes de ajax
						bootbox.alert(datos);
						// mostrarform(false);
						// tabla.ajax.reload();
						var reg_pqr_id = $("#reg_pqr_id").val();
						// var formData = new FormData($("#formulario")[0]);

						console.log(reg_pqr_id);
						$.ajax({	

							url: "../ajax/cerrarpqr.php?reg_pqr_id="+reg_pqr_id,
							//data: reg_pqr_id,
							// Si la funcion se ejecuta de forma correcta

							success: function(datos){
								// Muestra los datos de reapuesta provenientes de ajax
								bootbox.alert(datos,function(){location.reload(true)});
								mostrarform(false);
								// tabla.ajax.reload();
							}
						});
					}
				});
			}
		}
	});
}

function ocultarinsertarob(){
	$("#insertarobservacion").hide();
	$("#cerrarPqr").hide();
	$("#btnGuardar").hide();
}

function mostrarestado(verestado){
	if (verestado == 1) {
		$("#cerrado").show();
		$("#vencido").hide();
		$("#pvencer").hide();
		$("#activa").hide();
	}
	if (verestado == 2) {
		$("#cerrado").hide();
		$("#vencido").show();
		$("#pvencer").hide();
		$("#activa").hide();
	}
	if (verestado == 3) {
		$("#cerrado").hide();
		$("#vencido").hide();
		$("#pvencer").show();
		$("#activa").hide();
	}
	if (verestado == 4) {
		$("#cerrado").hide();
		$("#vencido").hide();
		$("#pvencer").hide();
		$("#activa").show();
	}

}

// // Funcion para desactivar un registro
// function activar(reg_pqr_id){
// 	bootbox.confirm("¿Esta seguro de activar la persona?",function(result){
// 		if (result) {
// 			$.post("../ajax/seguimientoPqr.php?op=activar", {reg_pqr_id : reg_pqr_id}, function(e){
// 				bootbox.alert(e);
// 				tabla.ajax.reload();
// 			});
// 		}
// 	})
// }


// Declaracion para ejecucion al iniciar
init();

