var tabla; 

function init(){
	listar();	
	$("#fecha_inicio").change(listar);
}

// Listar
function listar(){
	var fecha_inicio	= $("#fecha_inicio").val();
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
			'excelHtml5',
			{
				extend: 'pdf',
				text:'PDF',
				title: 'Informe de apertura '+ fecha_inicio, 
			}
			
		],
		"ajax":{
			url:'../ajax/apertura.php?op=listar',
			data:{fecha_inicio: fecha_inicio},
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

init();