<?php
// Activacion de almacenamiento en buffer 
ob_start();
// Inicio de sesion 
session_start();


if (!isset($_SESSION["usu_nombre"]) ) {
  header("Location: login.html");
}else{
  require 'header.php';
  // Validacion de permisos mediante variable de sesion 
  if ($_SESSION['opTecnicas']==1) {
?>
<!-- encoded by @Francisco Monsalve -->
<!--Contenido-->
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content"><!-- Main content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border" >
            <h1 class="">
              <input type="hidden" id="sesion" value="<?php echo $_SESSION['usu_id']?>">Base de datos general<br><br>
            </h1>
          </div><!-- /.box-header -->
          <div class="panel-body table-responsive" id="listadoregistros"><!-- centro -->
            <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Contrato</th>
                <th>Nombre</th>
                <th>Dirección del servicio</th>
                <th>Barrio</th>
                <th>Cédula</th>
                <th>Teléfono 1</th>
                <th>Servicio</th>
                <th>Mensualidad</th>
                <th>Saldo Anterior</th>
                <th>Saldo Actual</th>
                <th>M</th>
                <th>Sede</th>
                <th>Estado</th>
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Contrato</th>
                <th>Nombre</th>
                <th>Dirección del servicio</th>
                <th>Barrio</th>
                <th>Cédula</th>
                <th>Teléfono 1</th>
                <th>Servicio</th>
                <th>Mensualidad</th>
                <th>Saldo Anterior</th>
                <th>Saldo Actual</th>
                <th>M</th>
                <th>Sede</th>
                <th>Estado</th>
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
 <script type="text/javascript" src="scripts/bdGeneral.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>