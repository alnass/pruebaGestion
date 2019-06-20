function mostrarPassword(id){
		var cambio = document.getElementById(id);
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
	
$(document).ready(function () {
	//CheckBox mostrar contraseña
	$('#ShowPassword').click(function () {
		$('#clavea').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});

	$('#ShowPassword2').click(function () {
		$('#newpass').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});
});


$("#frmAcceso").on('submit',function(e){

	e.preventDefault();
	logina = $("#logina").val();
	clavea = $("#clavea").val();
	newpass= $("#newpass").val();

	$.post("../ajax/restablecerPass.php?op=validarusu",{"logina":logina, "clavea":clavea, "newpass":newpass},function(data){
		if (data!="null") {
			bootbox.alert(data, function(){location.href = "index.php"});
		}else{
			bootbox.alert("Usuario y/o contraseña incorrectos");
		}
	});
})