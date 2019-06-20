var tabla;
function init(){

	listardesactivar();

}

// Listar
function listardesactivar(){
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
			url:'../ajax/contrato.php?op=listardesactivar',
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
		"order":[[8,"asc"]]
	}).DataTable();	 
}

// Funcion para desactivar un registro
function desactivar(cont_id){
	bootbox.confirm("¿Esta seguro de desactivar este contrato?",function(result){
		if (result) {
			$.post("../ajax/contrato.php?op=desactivar", {cont_id : cont_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

// Funcion para desactivar un registro
function activar(cont_id){
	bootbox.confirm("¿Esta seguro de activar este contrato?",function(result){
		if (result) {
			$.post("../ajax/contrato.php?op=activar", {cont_id : cont_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();