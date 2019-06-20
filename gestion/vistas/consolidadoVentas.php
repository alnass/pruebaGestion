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
  if ($_SESSION['informes']==1) {
?>
<!-- // # encoded by @Francisco Monsalve-->
<!-- maintenance effectuee par Anderson Ferrucho -->
<!--Contenido-->
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content"><!-- Main content -->
    <div class="row" style="margin-bottom: 15px">
      <form name="formulario" id="formulario" method="POST">
        <div class="col-md-3">
          <h4>Seleccione un año para mostrar resultados</h4>
        </div>
        <div class="col-md-3" style="padding-top: 15px ">
          <select class="form-control" name="anio" id="anio">
            <option value="1">
              PRIMER SEMESTRE 2018
            </option>
            <option value="2">
              SEGUNDO SEMESTRE 2018
            </option>
            <option value="3" selected="true">
              PRIMER SEMESTRE 2019
            </option>
            <option value="4">
              SEGUNDO SEMESTRE 2019
            </option>
          </select>
        </div>
        <div class="col-md-3">
          <h4>Seleccione un producto para mostrar resultados</h4>
        </div>
        <div class="col-md-3" style="padding-top: 15px ">
          <select class="form-control" name="product" id="product" required="">
            <option value="1">
                GENERAL
            </option>
            <option value="2">
                INTERNET
            </option>
            <option value="3">
                TV. ANALOGA
            </option>
            <option value="4">
                TV. DIGITAL
            </option>
            <option value="5">
                OTROS
            </option>
          </select>
        </div>
      </form>
    </div>  
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border" ><!--box header-->
            <h1 id="titulo">Consolidado de Recaudo</h1><h1 id="reporte"> </h1><br><br>
            <input type="hidden" id="sesion" value="<?php echo $_SESSION['usu_id']?>">
            <div class="box-tools pull-right">
              <div>
                <a href="../reportes/consolidadoVentas.php" target="_blank"><button id="reportegral" class="btn btn-default" title="Genera PDF con consolidado de todos los productos">Generar PDF Consolidado</button></a>
              </div>
              <div id="carga" class="text-center"  style="display: none; text-align: center;">
                <img src="../files/cargando.gif" alt="cargando" style="width: 20%; height: 20%;">
                <h5>Se esta generando el reporte por favor espere unos segundos...</h5>
              </div>
            </div>
          </div><!-- /.box-header -->
          <div class="panel-body table-responsive" id="listadoregistros"><!-- centro -->
            <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Sede</th>
                <th>Cant</th>
                <th>Enero</th>
                <th>Cant</th>
                <th>Febrero</th>
                <th>Cant</th>
                <th>Marzo</th>
                <th>Cant</th>
                <th>Abril</th>
                <th>Cant</th>
                <th>Mayo</th>
                <th>Cant</th>
                <th>Junio</th>
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Sede</th>
                <th>Cant</th>
                <th>Enero</th>
                <th>Cant</th>
                <th>Febrero</th>
                <th>Cant</th>
                <th>Marzo</th>
                <th>Cant</th>
                <th>Abril</th>
                <th>Cant</th>
                <th>Mayo</th>
                <th>Cant</th>
                <th>Junio</th>
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
 <script type="text/javascript" src="scripts/consolidadoVentas.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>