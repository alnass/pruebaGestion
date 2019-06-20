<?php
// Activacion de almacenamiento en buffer 
ob_start();
// Inicio de sesion 
session_start();
if (!isset($_SESSION["usu_nombre"])) {
  header("Location: login.html");
}else{
  require 'header.php';
  // Validacion de permisos mediante variable de sesion 
  if ($_SESSION['opAdmin']==1) {
?>
<!-- Ecoded by @francisco Monsalve-->
<!--Contenido-->
     
<div class="content-wrapper"> <!-- Content Wrapper. Contains page content -->
  <section class="content"> <!-- Main content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Estados del servicio<br><br>
              <!-- <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> -->
            </h1>
            <div class="box-tools pull-right">
            </div>
          </div><!-- /.box-header -->
            <!-- centro -->
          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado_es" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Contrato</th>
                <th>Suscriptor</th>
                <th>No Documento</th>
                <th>Estado del servicio</th>
                <th>Fecha de cambio</th>
                <th>Usuario</th>
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Contrato</th>
                <th>Suscriptor</th>
                <th>No Documento</th>
                <th>Estado del servicio</th>
                <th>Fecha de cambio</th>
                <th>Usuario</th>
              </tfoot>
            </table>
          </div>
          <div class="panel-body " style="height: auto;" id="formularioregistro">
                <form name="formulario" id="formulario" method="POST">
                </form>
          </div><!--Fin centro -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
// Redireccionamiento a por validacion de permisos
}else{
  require 'noacceso.php';
}
 require 'footer.php'
?>
 <script type="text/javascript" src="scripts/operacionesAdmin.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>