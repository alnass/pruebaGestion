$("#filtrar").change(function()
{
	listar();
});

function init()
{
	mostrarform(false);
	listar();

	$.post("../ajax/persona.php?op=selectCiudad", function(r){
		$("#ciudad").html(r);
		$("#ciudad").selectpicker('refresh');
	})
}

function mostrarform(flag){
	// Mantierne los inpus limpios
	// limpiar();

	if (flag) {
		// Los divs deben contener los ids siguientes $("#nomberdiv")
		$("#listadoregistros").hide();
		$("#formularioregistro").show();
		$("#encabezado_filtro").hide();
		$("#btnGuardar").prop("disabled",false);
		$("#btnAgregar").hide();
		listarActivos();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistro").hide();
		$("#btnAgregar").show();
	}
}

function mostrar()
{
	mostrarform(true);

}



var detalles = 0;

function cancelarform()
{
	// limpiar();
	mostrarform(false);
	location.reload(true);
}

function exitoRegistro()
{
	bootbox.alert('Compra aprobada exitosamente', function(){location.reload(true)});

}

function ocultarRegistro()
{
	bootbox.alert('La compra no se mostrará mas', function(){location.reload(true)});

}

function reactivarRegistro()
{
	bootbox.alert('Esta compra estará disponible nuevamente para su aprobación', function(){location.reload(true)});

}

function listar(){

	valor 	= 	$("#filtrar").val();
	// alert(valor);
	if(valor == 1)
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
				url:'../ajax/compras.php?op=listarSolicitudes',
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
		$("#fecha").text('Fecha');
		$("#responsable").text('Realizada por:');
		$("#fecha2").text('Fecha');
		$("#responsable2").text('Realizada por:');
	}
	else if(valor == 2)
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


init();