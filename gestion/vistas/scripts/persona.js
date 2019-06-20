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

// Cargar las opciones del la lista 
	$.post("../ajax/persona.php?op=selecTipoPersona", function(r){
		$("#tipoPersona").html(r);
		$("#tipoPersona").selectpicker('refresh');
	})

// Cargar las opciones del la lista 
	$.post("../ajax/persona.php?op=selecTipoCiente", function(r){
		$("#tipoCliente").html(r);
		$("#tipoCliente").selectpicker('refresh');
	})

// Cargar las opciones del la lista 
	$.post("../ajax/persona.php?op=selecAlianza", function(r){
		$("#alianza").html(r);
		$("#alianza").selectpicker('refresh');
	})

// Cargar las opciones del la lista 
	$.post("../ajax/persona.php?op=selecTipoDocumento", function(r){
		$("#tipoDoc").html(r);
		$("#tipoDoc").selectpicker('refresh');
	})

// Cargar las opciones del la lista 
	$.post("../ajax/persona.php?op=selectCiudad", function(r){
		$("#ciudad").html(r);
		$("#ciudad").selectpicker('refresh');
	})

// Cargar las opciones del la lista 
	$.post("../ajax/persona.php?op=selecTipoVivienda", function(r){
		$("#tipoVivien").html(r);
		$("#tipoVivien").selectpicker('refresh');
	})
	// Cargar las opciones del la lista 
	$.post("../ajax/persona.php?op=selecTipoVivienda", function(r){
		$("#conttipvivi").html(r);
		$("#conttipvivi").selectpicker('refresh');
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

	$("#cont_id").val("");  				
	$("#no_contrato").val(""); 			
	$("#persona_id").val(""); 			
	$("#direccion_serv").val(""); 		
	$("#estrato").val(""); 				
	$("#minimo_mensual").val(""); 		
	// $("#vigencia_a_partir").val(""); 	
	$("#renovacion_auto").val(""); 		
	$("#tv_analogica").val(""); 			
	$("#tv_digital").val(""); 			
	$("#internet").val(""); 				
	$("#adicional").val(""); 			
	//$("#fecha_activacion").val(); 		
	$("#valor_basico_mes").val(""); 		
	$("#valor_total_mes").val(""); 		
	$("#permanencia").val(""); 			
	$("#cargo_conexion").val("120000"); 		
	$("#valor_diferido").val("0"); 		
	// $("#fecha_ini_perm").val(""); 		
	// $("#fecha_fin_perm").val(""); 		
	$("#costo_reconexion").val("15000"); 		
	$("#fecha_transaccion").val(""); 	
	$("#usuario_id").val(""); 
	$("#cargo_adicional").val("");	
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
		$("#btnNvoContrato").hide();
		listarActivos();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistro").hide();
		$("#btnAgregar").show();
		$("#btnNvoContrato").show();
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
		dom: 'frtip',

		// Definicion de los botones para html
		// buttons: [
		// 	'copyHtml5',
		// 	'excelHtml5',
		// 	'csvHtml5',
		// 	'pdf'
		// ],
		"ajax":{
			url:'../ajax/persona.php?op=listar',
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

		url: "../ajax/persona.php?op=guardaryeditar",
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
function mostrar(per_id){
	$.post("../ajax/persona.php?op=mostrar",{per_id : per_id}, function(data, status)
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

	})
}

// Funcion para desactivar un registro
function desactivar(per_id){
	bootbox.confirm("¿Esta seguro de desactivar la persona?",function(result){
		if (result) {
			$.post("../ajax/persona.php?op=desactivar", {per_id : per_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Funcion para desactivar un registro
function activar(per_id){
	bootbox.confirm("¿Esta seguro de activar la persona?",function(result){
		if (result) {
			$.post("../ajax/persona.php?op=activar", {per_id : per_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Listar
function listarActivos(){
	// tbllistado es el ID de una tabla html que recibe tel1es por dataTable $("#nombretabla")
	tabla=$('#tblproductos').dataTable({
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'frtip',

		"ajax":{
			url:'../ajax/contrato.php?op=listarPorSede',
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
		"order":[[1,"desc"]]
	}).DataTable();	 
}

// Declaracion de variables para cargar los productos y sus detalles
var impuesto = 19;
var contador = 0;
var detalles = 0;

$("#btnGuardar").hide();

function agregarDetalle(prod_id, prod_nombre, prod_descripcion,prod_valor){

	var cantidad = 1;

	if (prod_id != "") {

		var subtotal = cantidad * prod_valor;

		var fila = '<tr class="filas" id="fila'+contador+'">'+
		'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+contador+')">X</button></td>'+
		'<td><input type="hidden" name="cont_prod_producto_id[]" value="'+prod_id+'">'+prod_id+'</td>'+
		'<td><input type="hidden" name="prod_nombre[]" value="'+prod_nombre+'">'+prod_nombre+'</td>'+
		'<td><input type="hidden" name="prod_descripcion[]" value="'+prod_descripcion+'">'+prod_descripcion+'</td>'+
		'<td><input type="number" name="cont_prod_cantidad[]" id="cantidad" value="'+cantidad+'"></td>'+
		'<td><input type="hidden" name="cont_prod_precio[]" id="prod_valor" value="'+prod_valor+'">'+prod_valor+'</td>'+
		'<td><span name="subtotal" id="subtotal'+contador+'">'+subtotal+'</td>'+
		'<td><button type="button" onclick="modificarSubtotales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>'+
		'</tr>';
		contador++;
		detalles++;
		$('#tbldetalle').append(fila);
		modificarSubtotales();
	}else{
		bootbox.alert("Error al ingresar el producto");
	}
}

function modificarSubtotales(){

	var cant = document.getElementsByName("cont_prod_cantidad[]");
	var prec = document.getElementsByName("cont_prod_precio[]");
	var sub  = document.getElementsByName("subtotal");

	for (var i = 0; i < cant.length; i++) {
		var inpC = cant[i];
		var inpP = prec[i];
		var inpS = sub[i];

		inpS.value = inpC.value * inpP.value;
		document.getElementsByName('subtotal')[i].innerHTML = inpS.value;
	}

	calcularTotales();
}

function calcularTotales(){

	var sub = document.getElementsByName("subtotal");
	var total = 0;

	for (var i = 0; i < sub.length; i++) {
		total += document.getElementsByName("subtotal")[i].value;
	}
	$("#total").html("$ "+ total);
	$("#minimo_mensual").val(total);

	evaluar();
}

function evaluar(){

	if (detalles > 0) {
		$("#btnGuardar").show();
	}else{
		$("#btnGuardar").hide();
		contador = 0;
	}
}

function eliminarDetalle(indice){
	$("#fila"+indice).remove();
	calcularTotales();
	evaluar();
	detalles = detalles - 1;
}


// Declaracion para ejecucion al iniciar
init();