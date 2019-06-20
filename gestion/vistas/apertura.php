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
  if ($_SESSION['reportes']==1) {
?>
<!--  # encoded by @Francisco Monsalve -->
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
              <h1 class="box-title">Consulta de acceso al sistema<br><br></h1>
          </div> <!-- /.box-header -->
          <!-- centro -->
          <div class="panel-body table-responsive" id="listadoregistros">
            <div class="row">
              <div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <label for="fecha_inicio">Fecha de reporte</label>                          
                <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d")?>">
              </div>
              <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                <thead>
                  <th>ID Registro</th>
                  <th>Fecha y hora</th>
                  <th>Nombre de usuario</th>
                  <th>ID de usuario</th>
                  <th>IP de acceso</th>
                  <th>Sede</th>
                </thead>
                <tbody>
                  <!-- Cuerpo de la tabla -->
                </tbody>
                <tfoot>
                  <th>ID Registro</th>
                  <th>Fecha y hora</th>
                  <th>Nombre de usuario</th>
                  <th>ID de usuario</th>
                  <th>IP de acceso</th>
                  <th>Sede</th>
                </tfoot>
              </table>
          </div>
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
 <script type="text/javascript" src="scripts/apertura.js"></script>
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>  


 
