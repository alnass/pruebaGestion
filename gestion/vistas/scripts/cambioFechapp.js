var tabla;

function init(){

	listarcontrato();
}

function listarcontrato(){
	tabla=$('#tbllistado').dataTable({
		"aProcessing": true,
		"aServerSide":true,
		dom:"Btrip",
		buttons:[
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax":{
			url:'../ajax/operacionesAdmin.php?op=listarcontrato',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		// Paginacion 
		"iDisplayLength": 5,
		// orden de los datos [[columna, tipo de orden]]
		"order":[[0,"asc"]]
	}).DataTable();
}

init();