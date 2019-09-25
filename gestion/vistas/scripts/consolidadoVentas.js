
// maintenance effectuee par Anderson Ferrucho
var tabla;
function init()
{	
	// Envia el valor 1 para procesar facturación
	listar(1);
	// Envia el valor 2 para procesar recaudo
	listar(2);
	// controla los cambios al select producto
	$("#product").on('change', function(){listar(1);listar(2);});
	// controla los cambios al select semestre
	$("#semestre").on('change', function(){listar(1);listar(2);});
	// controla los cambios al select anio
	$("#anio").on('change', function(){listar(1);listar(2);});
	$("#reportegral").click(imprimirReporte);
	// carga el select con los años
	$.post("../ajax/consolidadoVentas.php?op=anios", function(r){
		$("#anio").html(r);
		$("#anio").selectpicker('refresh');
	})
}

function imprimirReporte()
{
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

function listar(tipo)
{
	//***** Début maintenance **** /// 
// recibe el valor del producto y lo asigna a la variable 
	var producto 	= 	$("#product").val();
// recibe el valor del año y lo asigna a la variable 
	var anio 		=	$("#anio").val();
// recibe el valor del semestre y lo asigna a la variable 
	var semestre 	=	$("#semestre").val();
// Crea un array para dar nombre a la columna de los meses en la tabla que lista los registros
	var meses 		= 	[];
// Crea un array para dar nombre a la columna de los meses en el pie de la tabla que lista los registros 
	var fmeses 		= 	[];
// Recibe el valor del tipo
	if(tipo == 1)
	{
		// Selecciona una tabla según el tipo
		var tabla_repo 	= 	'tbllistado';
		// contador del ciclo
		var contar 		= 	1;
		// ciclo para almacenar en el array los nombres de los meses
		while(contar <= 6)
		{
			meses.push("mes"+contar);
			fmeses.push("fmes"+contar);
			contar++;	
		}
	}
	else
	{
		// Selecciona una tabla según el tipo
		var tabla_repo 	= 	'tbllistado2';
		// contador del ciclo
		var contar 		= 	1;
		// ciclo para almacenar en el array los nombres de los meses
		while(contar <= 6)
		{
			meses.push("2mes"+contar);
			fmeses.push("2fmes"+contar);
			contar++;	
		}
	}
	// valida el select semestre y asigna el nombre del mes
	if(semestre == 2)
	{
		$("#"+meses[0]).text("Julio");
		$("#"+meses[1]).text("Agosto");
		$("#"+meses[2]).text("Septiem");
		$("#"+meses[3]).text("Octubre");
		$("#"+meses[4]).text("Noviemb");
		$("#"+meses[5]).text("Diciemb");
		$("#"+fmeses[0]).text("Julio");
		$("#"+fmeses[1]).text("Agosto");
		$("#"+fmeses[2]).text("Septiem");
		$("#"+fmeses[3]).text("Octubre");
		$("#"+fmeses[4]).text("Noviemb");
		$("#"+fmeses[5]).text("Diciemb");
	}
	else
	{
		$("#"+meses[0]).text("Enero");
		$("#"+meses[1]).text("Febrero");
		$("#"+meses[2]).text("Marzo");
		$("#"+meses[3]).text("Abril");
		$("#"+meses[4]).text("Mayo");
		$("#"+meses[5]).text("Junio");
		$("#"+fmeses[0]).text("Enero");
		$("#"+fmeses[1]).text("Febrero");
		$("#"+fmeses[2]).text("Marzo");
		$("#"+fmeses[3]).text("Abril");
		$("#"+fmeses[4]).text("Mayo");
		$("#"+fmeses[5]).text("Junio");	
	}

	if(producto == 1)
	{
		var opcion 	= 	'listar';
		document.getElementById('reporte').innerHTML = 'General';
		document.getElementById('reporte2').innerHTML = 'General';
	}
	else if(producto == 2)
	{
		var opcion 	= 	'listar-int';
		document.getElementById('reporte').innerHTML = 'Internet';	
		document.getElementById('reporte2').innerHTML = 'Internet';	
	}
	else if(producto == 3)
	{
		var opcion 	= 	'listar-tva';
		document.getElementById('reporte').innerHTML = 'Television Analoga';	
		document.getElementById('reporte2').innerHTML = 'Television Analoga';	
	}
	else if(producto == 4)
	{
		var opcion 	= 	'listar-tvd';	
		document.getElementById('reporte').innerHTML = 'Television Digital';
		document.getElementById('reporte2').innerHTML = 'Television Digital';
	}
	else if(producto == 5)
	{
		var opcion 	= 	'listar-otros';	
		document.getElementById('reporte').innerHTML = 'Otros Productos';
		document.getElementById('reporte2').innerHTML = 'Otros Productos';
	}

	tabla=$('#'+tabla_repo).dataTable({
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
		        title: 'Reporte de Recaudo Arriendos y/o Administracion :: Sistema GlobalPlay.'
		    }
		],
		"ajax":{
			url:'../ajax/consolidadoVentas.php?op='+opcion+'&semestre='+semestre+'&tipo='+tipo,
			type: "get",
			data: anio, 
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
init();