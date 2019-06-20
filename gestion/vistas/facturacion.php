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
<!-- # Ecoded by @Francisco Monsalve-->
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Cargue de facturacion general</h1>
            <div class="box-tools pull-right">
            </div>
          </div>
   
          <div class="panel-body " style="height: auto;" id="formularioregistro">
            <form name="formulario" id="formulario" method="POST">
              <div class="row">
                <div class="form-group col-lg-5 col-md-5 col-sm-6 col-xs-12">
                  <label for="mes">Seleccione el mes</label>
                  <select class="form-control" name="mes" id="mes">
                    <option value="ENERO">ENERO</option>
                    <option value="FEBRERO">FEBRERO</option>
                    <option value="MARZO">MARZO</option>
                    <option value="ABRIL">ABRIL</option>
                    <option value="MAYO">MAYO</option>
                    <option value="JUNIO">JUNIO</option>
                    <option value="JULIO">JULIO</option>
                    <option value="AGOSTO">AGOSTO</option>
                    <option value="SEPTIEMBRE">SEPTIEMBRE</option>
                    <option value="OCTUBRE">OCTUBRE</option>
                    <option value="NOVIEMBRE">NOVIEMBRE</option>
                    <option value="DICIEMBRE">DICIEMBRE</option>
                  </select>
                </div>
                <div class="form-group col-lg-5 col-md-5 col-sm-6 col-xs-12"">
                  <label for="anio">Seleccione el año</label>
                  <select class="form-control" name="anio" id="anio">
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                  </select>
                </div>
              </div>
              <div id="btncargar" class="form-group">
                <button class="btn btn-warning " type="submit"><!-- Boton de cancelar -->
                  <i class="fa fa-arrow-circle-left"></i> Cargar facturas
                </button>
              </div>  
            </form>
            <div id="carga" style="display: none; text-align: center;">
              <img src="../files/cargando.gif" alt="">
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
 <script type="text/javascript" src="scripts/operacionesAdmin.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>