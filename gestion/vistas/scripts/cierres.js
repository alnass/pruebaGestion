// # encoded by @Francisco Monsalve

function insertarcierreparcial(){
	$.post("../ajax/cierres.php?op=guardar");
}

function insertarcierrefinal(){

	bootbox.confirm("Esta segurpo de cerrar la operacion del día", function(result){


		if (result) {

			$.post("../ajax/cierres.php?op=correoInformeDiario", function(e){
				if (e) {
	 				bootbox.alert(e, function(){
						$.post("../ajax/cierres.php?op=insertarcierrefinal");
				
						window.open("../respaldosdb/backupdb.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=200");
						window.location.href ="../reportes/exCierreParcial.php?cierre=Cierre final de caja";
	 					
	 				});
				}else {
	 				bootbox.alert("No es posible enviar el correo", function(){
						$.post("../ajax/cierres.php?op=insertarcierrefinal");
				
						window.open("../respaldosdb/backupdb.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=200");
						window.location.href ="../reportes/exCierreParcial.php?cierre=Cierre final de caja";
	 					
	 				});
				}
			});
		}
	})
	
}
