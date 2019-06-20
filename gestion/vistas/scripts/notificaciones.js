function init(){

	cantidad();

	$.post('../ajax/notificaciones.php?op=mostrarnotificacion', function(r) {
		$("#notificaciones").html(r);
	});

}

function cantidad(){

	$.post("../ajax/notificaciones.php?op=cantidad", function(data, status) {
		data = JSON.parse(data);

		if (data.cantidad > 0) {
			var p = '<p  class="label label-danger" id="notif_cantidad">'+
			data.cantidad+'</p>'
		}else{
			p = null;
		}

		$("#contador").append(p);
	});
}

function leernotificacion(not_id){
	$.post('../ajax/notificaciones.php?op=leernotificacion', {not_id: not_id}, function(e){
		window.location.href = "seguimientoPqr.php";
	});
}

init();