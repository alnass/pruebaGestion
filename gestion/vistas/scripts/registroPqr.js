var tabla;
	// # encoded by @Francisco Monsalve

	// funcion que se ejecuta siempre al iniciar
function init(){
	// hace referncia otras funciones implementadas
	// Oculta el formulario 
	mostrarform(false);
	// Carga la pagina con el listado de datos de la clase
	listar();
	numeroradicado();

	// Si se hace click en el btnGuardar se ejecuta la funcion submit del formulario y ejecuta la funcion guardaryeditar
	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	})

	// Si se hace click en el btnGuardar se ejecuta la funcion submit del formulario y ejecuta la funcion guardaryeditar
	$("#formnuevoestado").on("submit",function(e){
		guardarnuevoestado(e);
	})

	// Cargar las opciones del la lista 
	$.post("../ajax/registro-pqr.php?op=selecTipoPersona", function(r){
		$("#tipoPersona").html(r);
		$("#tipoPersona").selectpicker('refresh');

	})

	// Cargar las opciones del la lista 
	$.post("../ajax/registro-pqr.php?op=selecTipoCiente", function(r){
		$("#tipoCliente").html(r);
		$("#tipoCliente").selectpicker('refresh');

	})

	// Cargar las opciones del la lista 
	$.post("../ajax/registro-pqr.php?op=selecAlianza", function(r){
		$("#alianza").html(r);
		$("#alianza").selectpicker('refresh');

	})

	// Cargar las opciones del la lista 
	$.post("../ajax/registro-pqr.php?op=selecTipoDocumento", function(r){
		$("#tipoDoc").html(r);
		$("#tipoDoc").selectpicker('refresh');

	})

	// Cargar las opciones del la lista 
	$.post("../ajax/registro-pqr.php?op=selectCiudad", function(r){
		$("#ciudad").html(r);
		$("#ciudad").selectpicker('refresh');

	})

	// Cargar las opciones del la lista 
	$.post("../ajax/registro-pqr.php?op=selecTipoVivienda", function(r){
		$("#tipoVivien").html(r);
		$("#tipoVivien").selectpicker('refresh');

	})

	// Cargar las opciones del la lista 
	$.post("../ajax/registro-pqr.php?op=selectCanal", function(r){
		$("#canal").html(r);
		$("#canal").selectpicker('refresh');

	})
	// Cargar las opciones del la lista 
	$.post("../ajax/registro-pqr.php?op=selectTipoCanal", function(r){
		$("#tipoCanal").html(r);
		$("#tipoCanal").selectpicker('refresh');

	})
	// Cargar las opciones del la lista 
	$.post("../ajax/registro-pqr.php?op=selectProducto", function(r){
		$("#producto").html(r);
		$("#producto").selectpicker('refresh');

	})
	// Cargar las opciones del la lista 
	$.post("../ajax/registro-pqr.php?op=selectTipoPqr", function(r){
		$("#tipoPqr").html(r);
		$("#tipoPqr").selectpicker('refresh');

	})
	// Cargar las opciones del la lista 
	$.post("../ajax/registro-pqr.php?op=selectCategoria", function(r){
		$("#categoriaPqr").html(r);
		$("#categoriaPqr").selectpicker('refresh');

	})

	// Cargar las opciones del la lista 
	$.post("../ajax/registro-pqr.php?op=selectArea", function(r){
		$("#remitido").html(r);
		$("#remitido").selectpicker('refresh');

	})
	// Cargar las opciones del la lista 
	$.post("../ajax/registro-pqr.php?op=selectUsuario", function(r){
		$("#operador").html(r);
		$("#operador").selectpicker('refresh');

	})

	//Cargar las opciones del la lista 
	$.post("../ajax/recaudo.php?op=nuevoestado", function(r){
		$("#nuevoestado").html(r);
		$("#nuevoestado").selectpicker('refresh');
	})
}
		 
function limpiar(){
	// Los inputs del form deben tener los nombres establecidos a continuacion

	$("#per_id").val("");
	$("#prefijo").val("");
	$("#marca").val("");
	$("#precinto").val("");
	$("#tipoPersona").val("");
	$("#tipoCliente").val("");
	$("#alianza").val("");
	$("#tipoDoc").val("");
	$("#numDoc").val("");
	$("#expedDoc").val("");
	$("#nombre").val("");
	$("#apellido").val("");
	$("#nacimiento").val("");
	$("#tel1").val("");
	$("#tel2").val("");
	$("#ciudad").val("");
	$("#barrio").val("");
	$("#tipoVivien").val("");
	$("#direccion").val("");
	$("#correoPer").val("");
	$("#correoCorp").val("");
	$("#usuario").val("");
	$("#pass").val("");
	
	$("#reg_pqr_id").val("");
	$("#canal").val("");
	$("#tipoCanal").val("");
	$("#producto").val("");
	$("#tipoPqr").val("");
	$("#categoriaPqr").val("");
	$("#persona").val("");
	$("#remitido").val("");
	//$("#numRadicado").val("");
	$("#fechaInicio").val("");
	$("#fechaRemision").val("");
	$("#fechaFin").val("");
	$("#ticket").val("");
	$("#operador").val("");
	$("#dias").val("");
	$("#observacion").val("");
}

function limpirRegPqr(){
	$("#reg_pqr_id").val("");
	$("#canal").val("");
	$("#tipoCanal").val("");
	$("#producto").val("");
	$("#tipoPqr").val("");
	$("#categoriaPqr").val("");
	$("#persona").val("");
	$("#remitido").val("");
	//$("#numRadicado").val("");
	$("#fechaInicio").val("");
	$("#fechaRemision").val("");
	$("#fechaFin").val("");
	$("#ticket").val("");
	$("#operador").val("");
	$("#dias").val("");
	$("#observacion").val("");
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
	//location.reload(true);
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
		dom: 'frtip',

		// Definicion de los botones para html
		// buttons: [
		// 	'copyHtml5',
		// 	'excelHtml5',
		// 	'csvHtml5',
		// 	'pdf'
		// ],
		"ajax":{
			url:'../ajax/registro-pqr.php?op=listar',
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

// Listar
function listarcontrato(per_id){

	// tblcontrato es el ID de una tabla html que recibe tel1es por dataTable $("#nombretabla")
	tabla=$('#tblcontrato').dataTable({// Activar el procesamiento de los datatables
		"aProcessing": true,// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,// Define los elementos del control de la tabla
		"searching": false,// Deshabilita el input de busqueda
		dom: 'frtip',

		// Definicion de los botones para html
		// buttons: [
		// 	'copyHtml5',
		// 	'excelHtml5',
		// 	'csvHtml5',
		// 	'pdf'
		// ],
		"ajax":{
			url:'../ajax/registro-pqr.php?op=listarcontrato',
			type: "post",
			dataType: "json",
			data:{per_id:per_id},
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

		url: "../ajax/registro-pqr.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		// Si la funcion se ejecuta de forma correcta
		success: function(datos){
			// Muestra los datos de reapuesta provenientes de ajax
			//bootbox.alert(datos);
			// mostrarform(false);
			// tabla.ajax.reload();
		}
	});

	$.ajax({

		url: "../ajax/registro-pqr.php?op=guardaryeditarpersona",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,


		// Si la funcion se ejecuta de forma correcta
		success: function(datos){
			// Muestra los datos de reapuesta provenientes de ajax
			// bootbox.alert("Los datos han sido registrados con exito", function(){location.reload(true)});
			// bootbox.alert(datos);
			// mostrarform(false);
			// tabla.ajax.reload();
		}
	});

	$.ajax({
		url: '../ajax/registro-pqr.php?op=insertarnotificacion',
		type: 'POST',
		data: formData,
		contentType: false,
		processData: false,

		success: function(datos){
			bootbox.alert("Los datos han sido registrados con exito", function(){location.reload(true)});
			// bootbox.alert(datos);
			mostrarform(false);
			// tabla.ajax.reload();
		}
	});
	
	

	limpiar();

}

// Mostrar los datos en los inpts del form
function mostrar(reg_pqr_id){
	
		
	var hoy = new Date();
	var dd = hoy.getDate();
	var mm = hoy.getMonth()+1; //hoy es 0!
	var yyyy = hoy.getFullYear();
	var hh = hoy.getHours();
	var mm = hoy.getMinutes();
	var ss = hoy.getMinutes();

	if(dd<10) {
	    dd='0'+dd
	} 

	if(mm<10) {
	    mm='0'+mm
	} 

	hoy = yyyy+'/'+mm+'/'+dd+''+hh+':'+mm+':'+ss;
		


	$.post("../ajax/registro-pqr.php?op=mostrar",{reg_pqr_id : reg_pqr_id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		// $("#nombredelinput") Corresponde al name de los inputs del form
		
// Impementacion de metodo para listar registros

		$("#per_id").val(data.per_id);
		$("#prefijo").val(data.per_prefijo);
		$("#marca").val(data.per_marca);
		$("#precinto").val(data.per_precinto);

		$("#tipoPersona").val(data.per_tipo_persona_id);
		$("#tipoPersona").selectpicker('refresh');

		$("#tipoCliente").val(data.per_tipo_cliente_id);
		$("#tipoCliente").selectpicker('refresh');

		$("#alianza").val(data.per_alianza_id);
		$("#alianza").selectpicker('refresh');

		$("#tipoDoc").val(data.per_tipo_documento_id);
		$("#tipoDoc").selectpicker('refresh');

		$("#numDoc").val(data.per_num_documento);
		$("#expedDoc").val(data.per_fecha_exped_doc);
		$("#nombre").val(data.per_nombre);
		$("#apellido").val(data.per_apellido);
		$("#nacimiento").val(data.per_fecha_nacimiento);
		$("#tel1").val(data.per_telefono_1);
		$("#tel2").val(data.per_telefono_2);

		$("#ciudad").val(data.per_ciudad_id);
		$("#ciudad").selectpicker('refresh');

		$("#barrio").val(data.per_barrio);

		$("#tipoVivien").val(data.per_tipo_vivienda_id);
		$("#tipoVivien").selectpicker('refresh');

		$("#direccion").val(data.per_direccion);
		$("#correoPer").val(data.per_correo_personal);
		$("#correoCorp").val(data.per_correo_corp);
		$("#usuario").val(data.per_usuario);
		$("#pass").val(data.per_contrasenia);

		$("#reg_pqr_id").val(data.reg_pqr_id);
		$("#canal").val(data.reg_pqr_canal_id);
		$("#tipoCanal").val(data.reg_pqr_tipo_canal_id);
		$("#producto").val(data.reg_pqr_producto_id);
		$("#tipoPqr").val(data.reg_pqr_tipo_pqr_id);
		$("#categoriaPqr").val(data.reg_pqr_categoria_pqr_id);
		$("#persona").val(data.per_id);
		$("#remitido").val(data.reg_pqr_remitido_id);

		// $("#numRadicado").val(data.per_id+dd+data.reg_pqr_id);
		
					
		$("#fechaRemision").val(data.reg_pqr_fecha_remision);
		$("#fechaFin").val(data.reg_pqr_fecha_fin);
		$("#ticket").val(data.reg_pqr_ticket_interno);
		$("#operador").val(data.reg_pqr_operador_id);
		$("#dias").val(data.reg_pqr_dias_respuesta);
		$("#observacion").val(data.reg_pqr_observacion);

	});

		
}

function numeroradicado(){
	
	var hoy = new Date();
	var dd = hoy.getDate();
	var mm = hoy.getMonth()+1; //hoy es 0!
	var yyyy = hoy.getFullYear();
	var hh = hoy.getHours();
	

	$.post("../ajax/registro-pqr.php?op=numeroradicado", function(data, status)
	{
		data = JSON.parse(data);
		
		$("#numRadicado").val(mm+''+dd+''+data.reg_pqr_id);
	})
}

	

// Funcion para desactivar un registro
function desactivar(reg_pqr_id){
	bootbox.confirm("¿Esta seguro de desactivar la persona?",function(result){
		if (result) {
			$.post("../ajax/registro-pqr.php?op=desactivar", {reg_pqr_id : reg_pqr_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Funcion para desactivar un registro
function activar(reg_pqr_id){
	bootbox.confirm("¿Esta seguro de activar la persona?",function(result){
		if (result) {
			$.post("../ajax/registro-pqr.php?op=activar", {reg_pqr_id : reg_pqr_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function listarpqrusuario(per_id){

	// tbllistado es el ID de una tabla html que recibe tel1es por dataTable $("#nombretabla")
	tabla=$('#tblpqrusuario').dataTable({
				// Ordena los elementos segun el indice del arreglo
		
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'Bfrtip',

		//Definicion de los botones para html
		buttons: [
			// 'copyHtml5',
			// 'excelHtml5',
			// 'csvHtml5',
			// 'pdf'
		],
		"ajax":{
			url:'../ajax/listarpqrusuario.php?per_id='+per_id,
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
		"order":[[6,"asc"]]
	}).DataTable();	 
}

function listarestadocuenta(cont_id){
	// tbllistado es el ID de una tabla html que recibe tel1es por dataTable $("#nombretabla")
	var nombre = $("#suscriptor").val();


	tabla=$('#tblestadocta').dataTable({
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
			{
                extend: 'pdf',
                text: 'PDF',
                title: 'Estado de cuenta',
                message: 'Nombre : $'+nombre+'\nDocumento: ',
            },
		],
		"ajax":{
			url:'../ajax/recaudo.php?op=listarestadocuenta',
			type: "post",
			dataType: "json",
			data:{cont_id:cont_id},
			error: function(e){
				console.log(e.responseText);
			}
		},
		"columnDefs": [
            // cambiar el color del contenido de una columa 
            {
              	"targets": [5], // El objetivo de la columna de posición, desde cero.
              	"render": function(data, type, full) { // Devuelve el contenido personalizado
                  		return "<span style='color:orange;'>" + data + "</span>";
              	}
          	},
          	{
              	"targets": [6], // El objetivo de la columna de posición, desde cero.
              	"render": function(data, type, full) { // Devuelve el contenido personalizado
                  		return "<span style='color:red;'>" + data + "</span>";
              	}
          	},
          	{
              	"targets": [7], // El objetivo de la columna de posición, desde cero.
              	"render": function(data, type, full) { // Devuelve el contenido personalizado
                  		return "<span style='color:green;'>" + data + "</span>";
              	}
          	}
          	
        ],
		"bDestroy": true,
		// Paginacion 
		"iDisplayLenght": 5,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[0,"desc"]]
	}).DataTable();	 
}

function listarproductos(cont_id){

	// tblcontrato es el ID de una tabla html que recibe tel1es por dataTable $("#nombretabla")
	tabla=$('#tblproductos').dataTable({// Activar el procesamiento de los datatables
		"aProcessing": true,// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,// Define los elementos del control de la tabla
		"searching": false,// Deshabilita el input de busqueda
		dom: 'frtip',

		// Definicion de los botones para html
		// buttons: [
		// 	'copyHtml5',
		// 	'excelHtml5',
		// 	'csvHtml5',
		// 	'pdf'
		// ],
		"ajax":{
			url:'../ajax/registro-pqr.php?op=listarproductos',
			type: "post",
			dataType: "json",
			data:{cont_id:cont_id},
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

function listarestadoservicio(cont_id){

	// tblcontrato es el ID de una tabla html que recibe tel1es por dataTable $("#nombretabla")
	tabla=$('#tblestadoservicios').dataTable({// Activar el procesamiento de los datatables
		"aProcessing": true,// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,// Define los elementos del control de la tabla
		"searching": false,// Deshabilita el input de busqueda
		dom: 'frtip',

		// Definicion de los botones para html
		// buttons: [
		// 	'copyHtml5',
		// 	'excelHtml5',
		// 	'csvHtml5',
		// 	'pdf'
		// ],
		"ajax":{
			url:'../ajax/registro-pqr.php?op=listarestadoservicio',
			type: "post",
			dataType: "json",
			data:{cont_id:cont_id},
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
// Muestra los datos del contrato en la ventana modal
function vermodal(cont_id){

$.post("../ajax/recaudo.php?op=mostrar",{cont_id : cont_id}, function(data, status)
	{
		data = JSON.parse(data);

		$("#m_contratoid").val(data.cont_no_contrato+'-'+data.cont_id);
		$("#v_contratoid").val(data.cont_id);
	});
}

function guardarnuevoestado(e){
	// Nose activara la accion predeterminada del evento submit
	e.preventDefault();
	$("#btnGuardarEstado").prop("disabled",true);
	var formData = new FormData($("#formnuevoestado")[0]);

	$.ajax({

		url: "../ajax/registro-pqr.php?op=guardarnuevoestado",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		// Si la funcion se ejecuta de forma correcta
		success: function(datos){
			// Muestra los datos de reapuesta provenientes de ajax
			bootbox.alert(datos);
			$('#modalCambioEstado').modal('hide');
			// mostrarform(false);
			tabla.ajax.reload();
		}

	});
	limpiar();
}
// Declaracion para ejecucion al iniciar
init();
