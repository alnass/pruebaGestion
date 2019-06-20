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
<!--Contenido-->
  <div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
    <section class="content"><!-- Main content -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h1 class="box-title">Activaciones realizadas entre fechas<br><br></h1>
              <div class="box-tools pull-right"></div> <!-- Fin de etiqueta superior derecha -->
            </div><!-- /.box-header -->
            <div class="panel-body table-responsive" id="listadoregistros"> <!-- Inicio del panel de la tabla -->
              <div class="row">
                <div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
                  <label for="fecha_inicio">Fecha de inicio</label>                          
                  <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d")?>">
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
                  <label for="fecha_fin">Fecha de final</label>                          
                  <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d")?>">
                </div>
              </div>
              <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                <thead>
                  <th>Opciones</th>
                  <th>No contrato</th>
                  <th>Fecha</th>
                  <th>Nombre</th>
                  <th>No Documento</th>
                  <th>Mensualidad</th>
                  <th>Saldo anterior</th>
                  <th>Saldo actual</th>
                  <th>Trasacción final</th>
                  <th>Estado</th>
                </thead>
                <tbody>
                  <!-- Cuerpo de la tabla -->
                </tbody>
                <tfoot>
                  <th>Opciones</th>
                  <th>No contrato</th>
                  <th>Fecha</th>
                  <th>Nombre</th>
                  <th>No Documento</th>
                  <th>Mensualidad</th>
                  <th>Saldo anterior</th>
                  <th>Saldo actual</th>
                  <th>Trasacción final</th>
                  <th>Estado</th>
                </tfoot>
              </table> <!-- Fin de la tabla -->
            </div> <!-- Fin del panel de la tabla -->
            <div class="panel-body " style="height: auto;" id="formularioregistro">
              <div class="row">  
                <form name="formulario" id="formulario" method="POST">
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"><!-- DATOS DEL SUSCRIPTOR -->
                    <div class="panel-body table-responsive" id="estadocta">
                      <table id="tblestadocta" class="table table-striped table-border table-condensed table-hover">
                        <thead style="background-color: #CED8F6;">
                          <th>ID</th>
                          <th>Fecha Transacción</th>
                          <th>Comp</th>
                          <th>Concepto</th>
                          <th>Obervación</th>
                          <th>Saldo Anterior</th>
                          <th>Cargos</th>
                          <th>Pagos</th>
                          <th>Saldo Final</th>
                        </thead>
                        <tbody>
                          <!-- Cuerpo de la tabla -->
                        </tbody>
                        <tfoot>
                          <th>ID</th>
                          <th>Fecha Transacción</th>
                          <th>Comp</th>
                          <th>Concepto</th>
                          <th>Obervación</th>
                          <th>Saldo Anterior</th>
                          <th>Cargos</th>
                          <th>Pagos</th>
                          <th>Saldo Final</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="form-group " >
                      <button class="btn btn-danger " onclick="cancelarform()" type="button"><!-- Boton de cancelar -->
                        <i class="fa fa-arrow-circle-left"></i>Cancelar
                      </button>
                    </div>
                  </div>  
                </form>
              </div>
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
 <script type="text/javascript" src="scripts/listarpostcierre.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>