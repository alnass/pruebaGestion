
// maintenance effectuee par Anderson Ferrucho
var tabla;
function init(){
	listar();
	$("#product").change(listar);
	$("#anio").change(listar);
	$("#reportegral").click(imprimirReporte);
}

function imprimirReporte()
{
	// e.preventDefault();
	$("#reportegral").prop("disabled",true);
	
	$.ajax({
		url: "../ajax/operacionesAdmin.php?op=reporte",
		contentType: false,
		processData: false,
		beforeSend:function(objeto){
			$('#carga').css({display:'block'});
		},

		complete:function(){$('#carga').css('display','none');},
		// Si la funcion se ejecuta de forma correcta
		success: function(datos){
		// Muestra los datos de respuesta provenientes de ajax
		}

	});
}

function listar()
{
	//***** Début maintenance **** /// 
	var producto 	= 	$("#product").val();
	var anio 		=	$("#anio").val();

	if(producto == 1)
	{
	// 	// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
		document.getElementById('reporte').innerHTML = 'General';

		tabla=$('#tbllistado').dataTable({
			// Activar el procesamiento de los datatables
			"aProcessing": true,
			// Paginacion y filtrado realizado por el servidor
			"aServerSide": true,
			// Define los elementos del control de la tabla
			dom: 'Bfrtip',

			// muestra la cantidad de registros por hoja
			pageLength: 12,

			// Definicion de los botones para html
			buttons: [
				'excelHtml5',
				'csvHtml5',
				{
		            extend: 'pdfHtml5',
		            text: 'PDF',
		            orientation: 'landscape',
		            title: 'Reporte de Facturas General:: Sistema GlobalPlay.'
		        }
			],
			"ajax":{
				url:'../ajax/consolidadoFacturas.php?op=listar',
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
	else if(producto == 2)
	{
		document.getElementById('reporte').innerHTML = 'Internet';
		// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
		tabla=$('#tbllistado').dataTable({
			// Activar el procesamiento de los datatables
			"aProcessing": true,
			// Paginacion y filtrado realizado por el servidor
			"aServerSide": true,
			// Define los elementos del control de la tabla
			dom: 'Bfrtip',
			// muestra la cantidad de registros por hoja
			pageLength: 12,
			// Definicion de los botones para html
			buttons: [
			{
		        extend: 'pdfHtml5',
		        text: 'PDF',
		        orientation: 'landscape',
		        title: 'Reporte de Facturas Internet:: Sistema GlobalPlay.'
		    },
				'excelHtml5',
				'csvHtml5'
			],
			"ajax":{
				url:'../ajax/consolidadoFacturas.php?op=listar-int',
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
	else if(producto == 3)
	{
		document.getElementById('reporte').innerHTML = 'Television Analoga';
		// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
		tabla=$('#tbllistado').dataTable({
			// Activar el procesamiento de los datatables
			"aProcessing": true,
			// Paginacion y filtrado realizado por el servidor
			"aServerSide": true,
			// Define los elementos del control de la tabla
			dom: 'Bfrtip',
			// muestra la cantidad de registros por hoja
			pageLength: 12,
			// Definicion de los botones para html
			buttons: [
				'excelHtml5',
				'csvHtml5',
				{
			        extend: 'pdfHtml5',
			        text: 'PDF',
			        orientation: 'landscape',
			        title: 'Reporte de Facturas Television Analoga:: Sistema GlobalPlay.'
			    }
			],
			"ajax":{
				url:'../ajax/consolidadoFacturas.php?op=listar-tva',
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
	else if(producto == 4)
	{
		document.getElementById('reporte').innerHTML = 'Television Digital';

		tabla=$('#tbllistado').dataTable({
			// Activar el procesamiento de los datatables
			"aProcessing": true,
			// Paginacion y filtrado realizado por el servidor
			"aServerSide": true,
			// Define los elementos del control de la tabla
			dom: 'Bfrtip',
			// muestra la cantidad de registros por hoja
			pageLength: 12,
			// Definicion de los botones para html
			buttons: [
				'excelHtml5',
				'csvHtml5',
				{
			        extend: 'pdfHtml5',
			        text: 'PDF',
			        orientation: 'landscape',
			        title: 'Reporte de Facturas Television Digital:: Sistema GlobalPlay.'
			    }
			],
			"ajax":{
				url:'../ajax/consolidadoFacturas.php?op=listar-tvd',
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
	else if(producto == 5)
	{
		document.getElementById('reporte').innerHTML = 'Arriendos y Administracion';

		tabla=$('#tbllistado').dataTable({
			// Activar el procesamiento de los datatables
			"aProcessing": true,
			// Paginacion y filtrado realizado por el servidor
			"aServerSide": true,
			// Define los elementos del control de la tabla
			dom: 'Bfrtip',
			// muestra la cantidad de registros por hoja
			pageLength: 12,
			// Definicion de los botones para html
			buttons: [
				'excelHtml5',
				'csvHtml5',
				{
			        extend: 'pdfHtml5',
			        text: 'PDF',
			        orientation: 'landscape',
			        title: 'Reporte de Facturas Arriendos y/o Administracion :: Sistema GlobalPlay.'
			    }
			],
			"ajax":{
				url:'../ajax/consolidadoFacturas.php?op=listar-otros',
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
	else
	{
		// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
		tabla=$('#tbllistado').dataTable({
			// Activar el procesamiento de los datatables
			"aProcessing": true,
			// Paginacion y filtrado realizado por el servidor
			"aServerSide": true,
			// Define los elementos del control de la tabla
			dom: 'Bfrtip',

			// muestra la cantidad de registros por hoja
			pageLength: 12,

			// Definicion de los botones para html
			buttons: [
				'excelHtml5',
				'csvHtml5',
				'pdf'
			],
			"ajax":{
				url:'../ajax/consolidadoFacturas.php?op=listar',
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

		// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
	// fin maintenance
}
init();