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
        <div class="col-md-2">
          <h4>Seleccione un año para mostrar resultados</h4>
        </div>
        <div class="col-md-2" style="padding-top: 15px ">
          <select class="form-control" name="anio" id="anio">
          </select>
        </div>
        <div class="col-md-2">
          <h4>Seleccione un semestre para mostrar resultados</h4>
        </div>
        <div class="col-md-2" style="padding-top: 15px ">
          <select class="form-control" name="semestre" id="semestre">
            <option value="1">
              PRIMER SEMESTRE
            </option>
            <option value="2">
              SEGUNDO SEMESTRE
            </option>
          </select>
        </div>
        <div class="col-md-2">
          <h4>Seleccione un producto para mostrar resultados</h4>
        </div>
        <div class="col-md-2" style="padding-top: 15px ">
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
            <!-- <option value="5">
                OTROS
            </option> -->
          </select>
        </div>
      </form>      
    </div>  
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border" ><!--box header-->
            <h1 id="titulo">Consolidado de Facturado <span id="reporte"> </span></h1><br><br>
            <input type="hidden" id="sesion" value="<?php echo $_SESSION['usu_id']?>">
          </div><!-- /.box-header -->
          <div class="panel-body table-responsive" id="listadoregistros"><!-- centro -->
            <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Sede</th>
                <th>Total Cont</th>
                <th id="mes1">Enero</th>
                <th>Total Cont</th>
                <th id="mes2">Febrero</th>
                <th>Total Cont</th>
                <th id="mes3">Marzo</th>
                <th>Total Cont</th>
                <th id="mes4">Abril</th>
                <th>Total Cont</th>
                <th id="mes5">Mayo</th>
                <th>Total Cont</th>
                <th id="mes6">Junio</th>
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Sede</th>
                <th>Total Cont</th>
                <th id="fmes1">Enero</th>
                <th>Total Cont</th>
                <th id="fmes2">Febrero</th>
                <th>Total Cont</th>
                <th id="fmes3">Marzo</th>
                <th>Total Cont</th>
                <th id="fmes4">Abril</th>
                <th>Total Cont</th>
                <th id="fmes5">Mayo</th>
                <th>Total Cont</th>
                <th id="fmes6">Junio</th>
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
            <h1 id="titulo">Consolidado de Recaudo <span id="reporte2"></span> </h1><br><br>
            <input type="hidden" id="sesion" value="<?php echo $_SESSION['usu_id']?>">
            
          </div><!-- /.box-header -->
          <div class="panel-body table-responsive" id="listadoregistros2"><!-- centro -->
            <table id="tbllistado2" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Sede</th>
                <th>Total Cont</th>
                <th id="2mes1">Enero</th>
                <th>Total Cont</th>
                <th id="2mes2">Febrero</th>
                <th>Total Cont</th>
                <th id="2mes3">Marzo</th>
                <th>Total Cont</th>
                <th id="2mes4">Abril</th>
                <th>Total Cont</th>
                <th id="2mes5">Mayo</th>
                <th>Total Cont</th>
                <th id="2mes6">Junio</th>
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Sede</th>
                <th>Total Cont</th>
                <th id="2fmes1">Enero</th>
                <th>Total Cont</th>
                <th id="2fmes2">Febrero</th>
                <th>Total Cont</th>
                <th id="2fmes3">Marzo</th>
                <th>Total Cont</th>
                <th id="2fmes4">Abril</th>
                <th>Total Cont</th>
                <th id="2fmes5">Mayo</th>
                <th>Total Cont</th>
                <th id="2fmes6">Junio</th>
              </tfoot>
            </table>
          </div>
          <div class="box-tools pull-right">
            <div>
              <a href="../reportes/consolidadoVentas.php" target="_blank"><button id="reportegral" class="btn btn-success" title="Genera PDF con consolidado de todos los productos">Generar PDF Facturas y Recaudo</button></a>
            </div>
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