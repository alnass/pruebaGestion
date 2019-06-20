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
  if ($_SESSION['configGeneral']==1) {
?>

<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Concepto de transacciones <br><br><button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Código</th>
                            <th>Area</th>
                            <th>Tipo</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>
                            <!-- Cuerpo de la tabla -->
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Código</th>
                            <th>Area</th>
                            <th>Tipo</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body " style="height: auto;" id="formularioregistro">

                        <form name="formulario" id="formulario" method="POST">
                          <!-- Identificacion de ID y captura de nombre -->

                          <!-- Captura de departamento -->
                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <label for="area_trans">Area de la transacción:</label>
                            <select class="form-control selectpicker" data-live-search="true" name="area_trans" id="area_trans" ></select>
                          </div>

                          <!-- Captura de departamento -->
                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <label for="transaccion">Tipo de transacción:</label>
                            <select class="form-control selectpicker" data-live-search="true" name="transaccion" id="transaccion" ></select>
                          </div>

                          <!-- Captura de descripcion -->
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="tran_nombre">Nombre de la transacción</label>
                            <input type="text" class="form-control" name="tran_nombre" id="tran_nombre" maxlength="512" placeholder="Descripción">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="descripcion">Descripción de la transaccion</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="512" placeholder="Descripción">
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >

                            <!-- Boton de guardar -->
                            <button class="btn btn-primary" type="submit" id="btnGuardar">
                              <i class="fa fa-save"></i>Guardar
                            </button>
                            
                            <!-- Boton de cancelar -->
                            <button class="btn btn-danger" onclick="cancelarform()" type="button">
                              <i class="fa fa-arrow-circle-left"></i>Cancelar
                            </button>
                          </div>
                          
                        </form>
                    </div>

                    <!--Fin centro -->
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
 <script type="text/javascript" src="scripts/conceptotransaccion.js"></script>  
<?php 
}
// luberar el espacio del bufe
ob_end_flush();
?>