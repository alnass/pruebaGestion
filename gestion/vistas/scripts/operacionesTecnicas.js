var tabla;

function init(){

	

	listarcontrato();
}

function listarcontrato()
{

	if($('#sesion').val() == 30 || $('#sesion').val() == 27)
	{
		tabla=$('#tbllistado').dataTable({
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'Bfrtip',

		//Definicion de los botones para html
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
			"ajax":{
				url:'../ajax/operacionesTecnicas.php?op=listarcontrato',
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
			"order":[[9,"desc"]]
		}).DataTable();	 	
	}
	else
	{
		tabla=$('#tbllistado').dataTable({
		// Activar el procesamiento de los datatables
		"aProcessing": true,
		// Paginacion y filtrado realizado por el servidor
		"aServerSide": true,
		// Define los elementos del control de la tabla
		dom: 'Bfrtip',

		buttons: [],
		//Definicion de los botones para html
			"ajax":{
				url:'../ajax/operacionesTecnicas.php?op=listarcontrato',
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
			"order":[[9,"desc"]]
		}).DataTable();	 	
	}
		
}

function cambiarEstado(ali_id){
	bootbox.confirm('A continuación, se cambiará el estado de los suscriptores a “POR CORTAR”. Esta seguro que desea realiza esta acción.',function(result){
		if (result) {
			$.post("../ajax/operacionesTecnicas.php?op=cambiarEstado",function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}	

init();                                                                                                                                                                                                                                                                                                                                                                            