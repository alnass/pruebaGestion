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
  if ($_SESSION['paramet']==1) {

?>
<!--  # encoded by @Francisco Monsalve -->
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content"><!-- Main content -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                  <h1 class="box-title">Alianza <br><br><button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                <div class="box-tools pull-right"></div>
            </div>
            <!-- /.box-header -->
            <!-- centro -->
            <div class="panel-body table-responsive" id="listadoregistros">
                <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                  <thead>
                    <th>Opciones</th>
                    <th>Razon social</th>
                    <th>Ciudad</th>
                    <th>Nombre contacto</th>
                    <th>Tel. Contacto</th>
                    <th>Correo contacto</th>
                    <th>Estado</th>
                  </thead>
                  <tbody>
                    <!-- Cuerpo de la tabla -->
                  </tbody>
                  <tfoot>
                    <th>Opciones</th>
                    <th>Razon social</th>
                    <th>Ciudad</th>
                    <th>Nombre contacto</th>
                    <th>Tel. Contacto</th>
                    <th>Correo contacto</th>
                    <th>Estado</th>
                  </tfoot>
                </table>
            </div> <!--Fin centro -->
            <!-- panel-body -->
            <div class="panel-body " style="height: auto;" id="formularioregistro">
                <form name="formulario" id="formulario" method="POST">
                  <!-- Identificacion de ID y captura de nombre -->
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                    <label for="nombre">Razón social:</label>
                    <input type="hidden"  name="ali_id" id="ali_id">
                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="45" placeholder="Nombre de la compañía" required="">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                    <label for="documento">Número de documento:</label>
                    <input type="number" class="form-control" name="documento" id="documento" maxlength="45" placeholder="Ingrese número sin caracteres" required="">
                  </div>
                  <!-- Captura de descripcion -->
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label for="desc">Descripcion</label>
                    <input type="text" class="form-control" name="desc" id="desc" maxlength="512" placeholder="Descripción">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                    <label for="num_contacto">Número de contacto:</label>
                    <input type="number" class="form-control" name="num_contacto" id="num_contacto" maxlength="45" placeholder="Número telefónico de contacto" required="">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                    <label for="nombre_contacto">Nombre de contacto:</label>
                    <input type="text" class="form-control" name="nombre_contacto" id="nombre_contacto" maxlength="45" placeholder="Nombre de contacto" required="">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                    <label for="apellido_contacto">Apellido de contacto:</label>
                    <input type="text" class="form-control" name="apellido_contacto" id="apellido_contacto" maxlength="45" placeholder="Apellido de contacto" required="">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                    <label for="correo_contacto">Correo de contacto:</label>
                    <input type="email" class="form-control" name="correo_contacto" id="correo_contacto" maxlength="45" placeholder="Correo de contacto" required="">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                    <label for="correo_corporativo">Correo de corporati:</label>
                    <input type="email" class="form-control" name="correo_corporativo" id="correo_corporativo" maxlength="45" placeholder="Correo de contacto" >
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                    <label for="telefono_oficina">Teléfono de oficina:</label>
                    <input type="number" class="form-control" name="telefono_oficina" id="telefono_oficina" maxlength="45" placeholder="Número telefónico de oficina">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                    <label for="direccion_oficina">Dirección de oficina:</label>
                    <input type="text" class="form-control" name="direccion_oficina" id="direccion_oficina" maxlength="45" placeholder="Dirección de oficina" required="">
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <label for="ciudad_id">Ciudad:</label>
                    <select class="form-control selectpicker" data-live-search="true" name="ciudad_id" id="ciudad_id" ></select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                    <label for="barrio">Barrio:</label>
                    <input type="hidden" id="cobertura">
                    <input type="text" class="form-control" name="barrio" id="barrio" maxlength="45" placeholder="Barrio de ubicacion" required="">
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                    <!-- Boton de guardar -->
                    <button class="btn btn-primary" type="submit" id="btnGuardar">
                      <i class="fa fa-save"></i> Guardar
                    </button>
                    <!-- Boton de cancelar -->
                    <button class="btn btn-danger" onclick="cancelarform()" type="button">
                      <i class="fa fa-arrow-circle-left"></i> Cancelar
                    </button>
                  </div>
                </form>
            </div> <!-- fin panel-body -->
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
 <script type="text/javascript" src="scripts/alianza.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>