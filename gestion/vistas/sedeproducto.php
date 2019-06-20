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
  if ($_SESSION['gestionProductos']==1) {
?>
<!-- # encoded by @Francisco Monsalve-->

<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Asignacion de productos a sedes<br><br><button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Asignar productos</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                          <thead>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Descripción</th>
                            <th>Valor</th>
                            <th>Sede</th>
                            <th>Dirección</th>
                          </thead>
                          <tbody>
                            <!-- Cuerpo de la tabla -->
                          </tbody>
                          <tfoot>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Descripción</th>
                            <th>Valor</th>
                            <th>Sede</th>
                            <th>Dirección</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body " style="height: 400px;" id="formularioregistro">

                        <form name="formulario" id="formulario" method="POST">
                          <!-- Identificacion de ID y captura de nombre -->
                          <div class="row">
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                              <label for="sede">Sede:</label>
                              <select class="form-control selectpicker" data-live-search="true" name="sede" id="sede" required=""></select>
                            </div>
                          </div>
                            
                          <div class="row">
                            <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                              <a data-toggle="modal" href="#myModal">
                                <button id="btnAgregarProducto" type="button" class="btn btn-success">
                                  <span class="fa fa-plus"></span>
                                  Agregar productos
                                </button>
                              </a>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="panel-body table-responsive" id="listadoregistros">
                              <table id="tbldetalle" class="table table-striped table-border table-condensed table-hover">
                                <thead style="background-color: #CEE3F6;">
                                  <th>Opciones</th>     
                                  <th>Còdigo</th>     
                                  <th>Nombre</th>     
                                  <th>Descripciòn</th>     
                                  <th>Cantidad</th>     
                                  <th>Valor</th>   
                                  <th>Subtotal</th>  
                                  <th>Actualizar</th>  
                                </thead>
                                <tbody>
                                  <!-- Cuerpo de la tabla -->
                                </tbody>
                                <tfoot>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th><input type="hidden" name="minimo_mensual" id="minimo_mensual"></th>
                                  <th>TOTAL</th>
                                  <th><h4 id="total">$/.  00</h4></th>
                                  <th></th>
                                </tfoot>
                              </table>
                            </div>
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
  <!-- Ventana modal -->
  <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Seleccione un producto</h4>
      </div>
      <div class="modal-body">
        <table id="tblproductos" class="table table-striped table-bordered table-condensed table-hover">
          <thead style="background-color: #CEE3F6;">
            <th>Opciones</th>     
            <th>Còdigo</th>     
            <th>Prefijo</th>     
            <th>Nombre</th>     
            <th>Descripciòn</th>     
            <th>Valor</th>     
          </thead>
          <tbody>
            
          </tbody>
          <tfoot>
            <th>Opciones</th>     
            <th>Còdigo</th>     
            <th>Prefijo</th>     
            <th>Nombre</th>     
            <th>Descripciòn</th>     
            <th>Valor</th>    
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  <!-- Fin ventana modal -->
<?php
// Redireccionamiento a por validacion de permisos
}else{
  require 'noacceso.php';
}
 require 'footer.php'
?>
 <script type="text/javascript" src="scripts/sedeproducto.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>