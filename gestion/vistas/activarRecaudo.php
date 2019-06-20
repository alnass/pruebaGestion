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
<!-- // # encoded by @Francisco Monsalve -->
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Sedes <br><br><button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
            <div class="box-tools pull-right">
            </div>
          </div>
              <!-- /.box-header -->
              <!-- centro -->
          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Estado</th>
                <th>ID</th>
                <th>ID Sede</th>
                <th>Sede</th>
                <th>Ultmo Cierre</th>
                <th>Usuario</th>
                <th>Opciones</th>
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Estado</th>
                <th>ID</th>
                <th>ID Sede</th>
                <th>Sede</th>
                <th>Ultmo Cierre</th>
                <th>Usuario</th>
                <th>Opciones</th>
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