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
      
    </div>  
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border"><!--box header-->
            <h1 id="titulo">Reporte Recaudo Hasta el <span id="reporte"> </span></h1><br><br>
            <h3>Este reporte contiene un informe general de recaudo efectivo y consignaciones ingresados por cada sede.</h3>
            <input type="hidden" id="sesion" value="<?php echo $_SESSION['usu_id']?>">
          </div><!-- /.box-header -->
          <div class="panel-body table-responsive" id="listadoregistros"><!-- centro -->
            <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Sede</th>
                <th>Valor TVA</th>
                <th>Valor INT</th>
                <th>Valor TVD</th>
                <th>Total Cont</th>
                <th>Valor Total</th>
                <th>Detalle</th>
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Sede</th>
                <th>Valor TVA</th>
                <th>Valor INT</th>
                <th>Valor TVD</th>
                <th>Total Cont</th>
                <th>Valor Total</th>
                <th>Detalle</th>
              </tfoot>
            </table>
          </div>
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border" ><!--box header-->
            <h1 id="titulo">Reporte Facturado Hasta el <span id="reporte2"> </span></h1><br><br>
            <h3 id="aviso">Las facturas generadas del 25 en adelante corresponden al mes siguiente.</h3>
            <input type="hidden" id="sesion" value="<?php echo $_SESSION['usu_id']?>">
          </div><!-- /.box-header -->
          <div class="panel-body table-responsive" id="listadoFacturado"><!-- centro -->
            <table id="tbllistado2" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Sede</th>
                <th>Valor TVA</th>
                <th>Valor INT</th>
                <th>Valor TVD</th>
                <th>Total Cont</th>
                <th>Valor Total</th>
                <th>Detalle</th>
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Sede</th>
                <th>Valor TVA</th>
                <th>Valor INT</th>
                <th>Valor TVD</th>
                <th>Total Cont</th>
                <th>Valor Total</th>
                <th>Detalle</th>
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
 <script type="text/javascript" src="scripts/consolidadoVentasMesActual.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>