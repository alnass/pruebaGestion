// maintenance effectuee par Anderson Ferrucho
var tabla;
function init()
{	
	// Envia el valor 1 para procesar facturación
	listar(1);
	listar(2);
	// Envia el valor 2 para procesar recaudo
	// listar();
}

function listar(tipo)
{
	var fecha 	= 	new Date();

	if(fecha.getMonth() < 9)
	{
		// RECAUDO
		$("#reporte").text(fecha.getDate() + "/0" + (fecha.getMonth() +1) + "/" + fecha.getFullYear());
		
		// FACTURAS
		if(fecha.getDate() > 24)
		{
			$("#reporte2").text("24/0"+(fecha.getMonth() +1) + "/" + fecha.getFullYear());
			$("#aviso").show();
		}
		else
		{
			$("#reporte2").text(fecha.getDate() + "/0" + (fecha.getMonth() +1) + "/" + fecha.getFullYear());
			$("#aviso").hide();
		}
	}
	else
	{
		// RECAUDO
		$("#reporte").text(fecha.getDate() + "/" + (fecha.getMonth() +1) + "/" + fecha.getFullYear());

		// FACTURAS
		if(fecha.getDate() > 24)
		{
			$("#reporte2").text((fecha.getMonth() +1) + "/" + fecha.getFullYear());	
			$("#aviso").show();
		}
		else
		{
			$("#reporte2").text(fecha.getDate() + "/" + (fecha.getMonth() +1) + "/" + fecha.getFullYear());	
			$("#aviso").hide();
		}
	}


	if(tipo == 1)
	{
		var tabla  	= 	'tbllistado';
		var valor  	= 	'Recaudo';
	}
	else
	{
		var tabla  	= 	'tbllistado2';	
		var valor  	= 	'Facturación';
	}

	tabla=$('#'+tabla).dataTable({
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'Bfrtip',
		// desactiva paginación del datatable	
		paging:false,
		// desactiva la busqueda
		searching: false,
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
		        title: 'Reporte de '+valor+' :: Sistema GlobalPlay.'
		    }
		],
		"ajax":{
			url:'../ajax/consolidadoVentasMesActual2.php?op=listar&tipo='+tipo,
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
		// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
	// fin maintenance
}


function detalle(sede, mes, anio)
{

	tabla=$('#tblOTS').dataTable({
		// Activar el procesamiento de los datatables

		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		paging:false,
			// desactiva la busqueda
		searching: false,
		dom: 'Bfrtip',
		// Definicion de los botones para html
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax":{
			url: '../ajax/cerradasOT.php?op=listarOT', 
			data: {'sede': sede, 'mes': mes, 'anio': anio},
			type: "post",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},

		"bDestroy": true,
		// Paginacion 
		"iDisplayLenght": 3,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[0,"desc"]]

	}).DataTable();	 

	// tabla=$('#').dataTable({
	// 	// Activar el procesamiento de los datatables
	// 	"aProcessing": true,
	// 	// Paginacion y filtrado realizado por el servidor
	// 	"aServerSide": true,
	// 	// Define los elementos del control de la tabla
	// 	dom: 'Bfrtip',
	// 	// desactiva paginación del datatable	
	// 	paging:false,
	// 	// desactiva la busqueda
	// 	searching: false,
	// 	// muestra la cantidad de registros por hoja
	// 	pageLength: 12,
	// 	// Definicion de los botones para html
	// 	buttons: [
	// 		'excelHtml5',
	// 		'csvHtml5',
	// 		{
	// 	        extend: 'pdfHtml5',
	// 	        text: 'PDF',
	// 	        orientation: 'landscape',
	// 	        title: 'Reporte de Sede '+sede+' :: Sistema GlobalPlay.'
	// 	    }
	// 	],
	// 	"ajax":{
	// 		url:'../ajax/consolidadoVentasMesActual2.php?op=listar&tipo='+sede,
	// 		type: "get",
	// 		dataType: "json",
	// 		error: function(e){
	// 			console.log(e.responseText);
	// 		}
	// 	},
	// 	"bDestroy": true,
	// 	// Paginacion 
	// 	"iDisplayLenght": 5,
	// 	// orden de los datos [[columna, tipo de orden]]
	// 	"order":[[0,"asc"]]
	// }).DataTable();	 
	// 	// tbllistado es el ID de una tabla html que recibe valores por dataTable $("#nombretabla")
	// // fin maintenance
}

init();