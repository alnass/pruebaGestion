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
  if ($_SESSION['equipos']==1) {
?>
<!--# encoded by @Anderson Ferrucho-->
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Fabricantes <br><br><button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Tipo Documento</th>
                            <th>Documento</th>
                            <th>Direccion</th>
                            <th>Teléfono</th>
                            <th>Ciudad</th>
                          </thead>
                          <tbody>
                            <!-- Cuerpo de la tabla -->
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Tipo Documento</th>
                            <th>Documento</th>
                            <th>Direccion</th>
                            <th>Teléfono</th>
                            <th>Ciudad</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body " style="height: 20%;" id="formularioregistro">

                        <form name="formulario" id="formulario" method="POST">
                          <!-- Identificacion de ID y captura de nombre -->

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                            <label for="nombre">Nombre:</label>
                            <input type="hidden"  name="fab_id" id="fab_id">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="45" placeholder="Nombre" required="">
                          </div>

                          <!-- Captura de Tiempo -->
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" maxlength="512" placeholder="Dirección">
                          </div>

                          <!-- Captura de Descripción -->
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="tipoDoc">Tipo Documento:</label>
                            <select class="form-control selcetpicker" data-live-search="true" name="tipoDoc" id="tipoDoc" required=""></select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="documento">Documento:</label>
                            <input type="text" class="form-control" name="documento" id="documento" maxlength="45" placeholder="Documento">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" maxlength="512" placeholder="Teléfono">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="ciudad">Ciudad:</label>
                            <select class="form-control selcetpicker" data-live-search="true" name="ciudad" id="ciudad" required=""></select>
                          </div>

                          <!-- <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="tipoequipo">Tipo Equipo:</label>
                            <select class="form-control selcetpicker" data-live-search="true" name="tipoequipo" id="tipoequipo" required=""></select>
                          </div> -->

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
 <script type="text/javascript" src="scripts/fabricante.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>