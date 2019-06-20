$("#frmAcceso").on('submit',function(e){

	e.preventDefault();
	logina = $("#logina").val();
	clavea = $("#clavea").val();

	$.post("../ajax/usuario.php?op=verificar",{"logina":logina, "clavea":clavea},function(data){
		if (data!="null") {
			$(location).attr("href","escritorio.php");
		}else{
			bootbox.alert("Usuario y/o contraseña incorrectos");
		}
	});
})

$("#mostrarPass").click(function()
{
	MostrarContrasenia();
})


function MostrarContrasenia()
{
	if ($('#mostrarPass').is(':checked'))
	{
      $('#clavea').attr('type', 'text');
    } 
    else 
    {
      $('#clavea').attr('type', 'password');
    }
}

