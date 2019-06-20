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
                messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
            },
            {
                extend: 'pdf',
                text: 'PDF',
                title: 'Consolidado de PQR´s del '+ fecha_inicio +' al '+fecha_fin,
                message: 'Prueba de exportar a pdf',
            },
            
		],
		"ajax":{
			url:'../ajax/consultas.php?op=pqrfecha',
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
}



// Declaracion para ejecucion al iniciar
init();