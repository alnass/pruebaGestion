 var tabla;
// # encoded by @Francisco Monsalve

// funcion que se ejecuta siempre al iniciar
function init(){
// hace referncia otras funciones implementadas
listar();

$("#fecha_inicio").change(listar);
$("#fecha_fin").change(listar);

}


// Listar
function listar(){
	var fecha_inicio	= $("#fecha_inicio").val();
	var fecha_fin		= $("#fecha_fin").val();
	var efectivo 		= "";
	var descuento 		= "";

	$.post("../ajax/consultas.php?op=totalefectivo",{fecha_inicio:fecha_inicio, fecha_fin:fecha_fin}, function(data, status)
	{
		
		data = JSON.parse(data);
		efectivo 		= data.est_cta_debe;
		// mostrarform(true);
		// $("#nombredelinput") Corresponde al name de los inputs del form
		$("#efectivo").val("$ "+number_format(efectivo,0));

		$.post("../ajax/consultas.php?op=totaledescuento",{fecha_inicio:fecha_inicio, fecha_fin:fecha_fin}, function(data, status)
		{
			
			data = JSON.parse(data);
			descuento 		= data.est_cta_debe;
			// mostrarform(true);
			// $("#nombredelinput") Corresponde al name de los inputs del form
			$("#descuento").val("$ "+number_format(descuento,0));
			// var efectivo		= $("#efectivo").val();
		
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
					'copy',
		            {
		                extend: 'excel',
		            },
		            {
		                extend: 'pdf',
		                text: 'PDF',
		                title: 'Reporte de caja del '+ fecha_inicio +' al '+fecha_fin,
		                message: 'Total Efectivo: $'+number_format(efectivo,0) +'\nTotal Descuentos: $'+number_format(descuento,0),
		            },
		            
				],
				"ajax":{
					url:'../ajax/consultas.php?op=efectivoensedes',
					data:{fecha_inicio: fecha_inicio ,fecha_fin :fecha_fin},
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
		});		
	});
}

function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
}

// Declaracion para ejecucion al iniciar
init();