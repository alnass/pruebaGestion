function init()
{
	$("#filtrar").change(function()
	{
		listar();
	});

	mostrarform(false);
	listar();
	$("#btnGuardar").hide();

	$.post("../ajax/persona.php?op=selectCiudad", function(r){
		$("#ciudad").html(r);
		$("#ciudad").selectpicker('refresh');
	})

	$("#proveedor").hide();
	$("#datos_prov").hide();
}

function mostrarform(flag){
	// Mantierne los inpus limpios
	// limpiar();

	if (flag) {
		// Los divs deben contener los ids siguientes $("#nomberdiv")
		$("#listadoregistros").hide();
		$("#formularioregistro").show();
		$("#btnGuardar").prop("disabled",false);
		$("#filtros").hide();
		listarProveedores();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistro").hide();
		$("#btnAgregar").show();
	}
}

var detalles = 0;

function agregarProducto(){

	var cant 			= 	$('#item_cant').val();
	var descripcion 	= 	$('#item_descp').val();
	var prod_valor 		= 	$('#item_val').val();

	var cantidad = cant;


	if (cant != "") {

		// alert(cant);
		var subtotal = cantidad * prod_valor;

		var fila = '<tr class="filas" id="fila'+contador+'">'+
		'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+contador+')">X</button></td>'+
		'<td><input type="hidden" name="cant[]" value="'+cant+'">'+cant+'</td>'+
		'<td><input type="hidden" name="descripcion[]" value="'+descripcion+'">'+descripcion+'</td>'+
		'<td><input type="hidden" name="prod_precio[]" id="prod_valor" value="'+prod_valor+'">'+prod_valor+'</td>'+
		'<td><span name="subtotal" id="subtotal'+contador+'">'+subtotal+'</td>'+
		'</tr>';
		contador++;
		detalles++;
		$('#tbldetalle').append(fila);
		modificarSubtotales();
		$('#item_cant').val('');
		$('#item_descp').val('');
		$('#item_val').val('');
	}else{
		bootbox.alert("Error al ingresar el producto");
	}
}

function modificarSubtotales(){

	var cant = document.getElementsByName("cant[]");
	var prec = document.getElementsByName("prod_precio[]");
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

function evaluar()
{
	if (detalles > 0) {
		$("#btnGuardar").show();
	}else{
		$("#btnGuardar").hide();
		contador = 0;
	}
}


function eliminarDetalle(indice)
{
	$("#fila"+indice).remove();
	calcularTotales();
	detalles = detalles - 1;
}

function cancelarform(){

	// limpiar();
	mostrarform(false);
	location.reload(true);
}


function listarProveedores(){
	// tbllistado es el ID de una tabla html que recibe tel1es por dataTable $("#nombretabla")
	tabla=$('#tblproveedor').dataTable({
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'frtip',

		"ajax":{
			url:'../ajax/compras.php?op=listarProveedores',
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


function listar()
{
	valor 	= 	$("#filtrar").val();
	
	if(valor == 1)
	{
		// var nColumnas 		= 	$("#tbllistado th").length;
		// var nColumnasFls	= 	$("#tbllistado tr").length;
		
		// if(nColumnas>18)
		// {
		// 	$("#prueba").each(function() 
		// 	{ 
		//     	$(this).filter("th:eq(2)").remove(); 
		// 	}); 
			
		// 	$("tr").each(function() 
		// 	{ 
		//     	$(this).filter("td:eq(2)").remove(); 
		// 	}); 
			
		// }

		// if(nColumnas>18)
		// {
		// 	$("#prueba").remove();
		// }

		// tbllistado es el ID de una tabla html que recibe tel1es por dataTable $("#nombretabla")
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
				url:'../ajax/compras.php?op=listar',
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
			"order":[[0,"desc"]]
		}).DataTable();	 

		$("#solicitante").text('Teléfono');
		$("#doc_princ").text('Documento');
		$("#motivo").text('Ver Detalle');
		$("#proveedor2").text('Proveedor');
		$("#solicitante2").text('Teléfono');
		$("#doc_princ2").text('Documento');
		$("#motivo2").text('Ver Detalle');
		$("#fecha").text('Fecha');
		$("#responsable").text('Realizada por:');
		$("#fecha2").text('Fecha');
		$("#responsable2").text('Realizada por:');
	}
	else if(valor == 2)
	{
		// $('#tbllistado > thead > tr').append('<th id="prueba">Prueba</th>');
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
				url:'../ajax/compras.php?op=listarSolicitudesAprobadas',
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
			"order":[[0,"desc"]]
		}).DataTable();

		$("#proveedor").text('Proveedor');
		$("#solicitante").text('Teléfono');
		$("#doc_princ").text('Documento');
		$("#motivo").text('Ver Detalle');
		$("#proveedor2").text('Proveedor');
		$("#solicitante2").text('Teléfono');
		$("#doc_princ2").text('Documento');
		$("#motivo2").text('Ver Detalle');
		$("#fecha").text('Fecha aprobac.');
		$("#responsable").text('Aprobada por:');
		$("#fecha2").text('Fecha aprobac.');
		$("#responsable2").text('Aprobada por:');
	}
	else
	{
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
				url:'../ajax/compras.php?op=listarSolicitudesRechazadas',
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
			"order":[[0,"desc"]]
		}).DataTable();	 

		$("#proveedor").text('Fecha Solicitud');
		$("#solicitante").text('Solicitado por:');
		$("#doc_princ").text('Documento');
		$("#motivo").text('Descripcion del Motivo');
		$("#proveedor2").text('Fecha Solicitud');
		$("#solicitante2").text('Solicitado por:');
		$("#doc_princ2").text('Documento');
		$("#motivo2").text('Descripcion del Motivo');
		$("#fecha").text('Fecha rechazo');
		$("#responsable").text('Rechazada por:');
		$("#fecha2").text('Fecha rechazo');
		$("#responsable2").text('Rechazada por:');	 	
	}
	
}

function asignarProveedor(uno, dos, tres, cuatro, cinco, seis, siete)
{
	$("#myModal2").modal('hide');

	if(uno == 10)
	{
		$("#proveedor").show();
		$("#datos_prov").hide();
		$("#id_prove").val('');
		$("#datos_proveedor").val('');
		$("#pagar_a").val('');
		$("#cuenta").val('');
		$("#banco").val('');
		$("#ahorros").attr('checked', false);
		$("#corriente").attr('checked', false);
	}
	else
	{
		$("#proveedor").hide();	
		$("#datos_prov").show();
		$("#id_prove").val(uno);
		$("#datos_proveedor").val(dos);
		$("#pagar_a").val(dos);
		$("#cuenta").val(tres);
		if(cuatro == 1)
		{
			$("#ahorros").attr('checked', true);
		}
		else
		{
			$("#corriente").attr('checked', true);
		}
		$("#banco").val(cinco);
		$("#tel_proveedor").val(seis);
		$("#direc_proveedor").val(siete);
	}

}

init();