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
<!-- // # encoded by @Francisco Monsalve-->
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Consulta general de PQR´s <br><br> 
                            <!-- <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> -->
                          </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
                          <label for="fecha_inicio">Fecha de inicio</label>                          
                          <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d")?>">
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
                          <label for="fecha_fin">Fecha de final</label>                          
                          <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d")?>">
                        </div>
                        <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                          <thead>
                            <th>Id PQR</th>
                            <th>Canal</th>
                            <th>Tipo de canal</th>
                            <th>Producto</th>
                            <th>Tipo PQR</th>
                            <th>Categoría</th>
                            <th>Cédula</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Radicado</th>
                            <th>Fecha inicial</th>
                            <th>Fecha final</th>
                            <th>Ticket</th>
                            <th>Operador</th>
                            <th>RPTA</th>
                            <th>Observación</th>
                            <th>Estado</th>
                            
                          </thead>
                          <tbody>
                            <!-- Cuerpo de la tabla -->
                          </tbody>
                          <tfoot>
                            <th>Id PQR</th>
                            <th>Canal</th>
                            <th>Tipo de canal</th>
                            <th>Producto</th>
                            <th>Tipo PQR</th>
                            <th>Categoría</th>
                            <th>Cédula</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Radicado</th>
                            <th>Fecha inicial</th>
                            <th>Fecha final</th>
                            <th>Ticket</th>
                            <th>Operador</th>
                            <th>RPTA</th>
                            <th>Observación</th>
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
 <script type="text/javascript" src="scripts/consultapqrfecha.js"></script>
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>  