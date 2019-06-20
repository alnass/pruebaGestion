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
  <div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
    <section class="content"><!-- Main content -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <h1 class="box-title">Contratación de servicios<br><br>
                  <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)">
                    <i class="fa fa-plus-circle"></i> 
                      Nuevo contrato
                  </button>
                </h1>
              <div class="box-tools pull-right"> <!-- Inicio de etiqueta superior derecha -->
              </div> <!-- Fin de etiqueta superior derecha -->
            </div><!-- /.box-header -->
            <div class="panel-body table-responsive" id="listadoregistros"> <!-- Inicio del panel de la tabla -->
              <form name="formulario" id="formulario" method="POST"> <!-- Inicio de formulario -->
                <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                  <thead>
                    <th>IMP</th>
                    <th>No Contrato</th>
                    <th>Valor</th>
                    <th>Nombre</th>
                    <th>Num Documento</th>
                    <th>Teléfono 1</th>
                    <th>Vigencia</th>
                    <th>Perm</th>
                    <th>Fin de pemanencia</th>
                    <th>Realizado</th>
                    <th>Estado</th>
                  </thead>
                  <tbody>
                    <!-- Cuerpo de la tabla -->
                  </tbody>
                  <tfoot>
                    <th>IMP</th>
                    <th>No Contrato</th>
                    <th>Valor</th>
                    <th>Nombre</th>
                    <th>Num Documento</th>
                    <th>Teléfono 1</th>
                    <th>Vigencia</th>
                    <th>Permanencia</th>
                    <th>Fin de pemanencia</th>
                    <th>Realizado</th>
                    <th>Estado</th>
                  </tfoot>
                </table> <!-- Fin de la tabla -->
              </form> <!-- Fin de formulario --> 
            </div> <!-- Fin del panel de la tabla -->
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
 <script type="text/javascript" src="scripts/cambioFechapp.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>