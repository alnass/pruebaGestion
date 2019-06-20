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
// Seleccionde sede
	$.post("../ajax/sedeproducto.php?op=selectSede", function(r){
		$("#sede").html(r);
		$("#sede").selectpicker('refresh');

	});
}

function limpiar(){
	// Los inputs del form deben tener los nombres establecidos a continuacion
	$("#prod_id").val("");
	$("#codigo").val("");
	$("#prefijo").val("");
	$("#nombre").val("");
	$("#desc").val("");
	$("#valor").val("");
	$("#stock").val("");
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
		listarActivos();
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
			url:'../ajax/sedeproducto.php?op=listar',
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
			url:'../ajax/contrato.php?op=listarActivos',
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

// guardar y editar
function guardaryeditar(e){
	// Nose activara la accion predeterminada del evento submit
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({

		url: "../ajax/sedeproducto.php?op=guardaryeditar",
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
function mostrar(prod_id){
	$.post("../ajax/sedeproducto.php?op=mostrar",{prod_id : prod_id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		// $("#nombredelinput") Corresponde al name de los inputs del form
		$("#prod_id").val(data.prod_id);
		$("#codigo").val(data.prod_codigo);
		$("#prefijo").val(data.prod_prefijo);
		$("#nombre").val(data.prod_nombre);
		$("#desc").val(data.prod_descripcion);
		$("#valor").val(data.prod_valor);
		$("#stock").val(data.prod_stock);
		
	})
}

// Funcion para desactivar un registro
function desactivar(prod_id){
	bootbox.confirm("¿Esta seguro de desactivar el producto?",function(result){
		if (result) {
			$.post("../ajax/sedeproducto.php?op=desactivar", {prod_id : prod_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Funcion para desactivar un registro
function activar(prod_id){
	bootbox.confirm("¿Esta seguro de activar el producto?",function(result){
		if (result) {
			$.post("../ajax/sedeproducto.php?op=activar", {prod_id : prod_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// var impuesto = 19;
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
	detalles = detalles - 1;
}

function desactiva_enlace(enlace){
	enlace.disabled = 'disabled';
}
// Declaracion para ejecucion al iniciar
init();