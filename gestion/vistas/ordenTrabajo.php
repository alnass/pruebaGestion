<?php
// # encodé par @Anderson Ferrucho 
ob_start();
// inicio de sesion
session_start();
if(!isset($_SESSION["usu_nombre"]))
{
	header("Location: login.html");
}else
{
	require 'header.php';
	/// validation des autorisations par variable de session 
	if($_SESSION['ordenTrabajo']==1)
	{
?>

<div class="content-wrapper">
    <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <input type="hidden" id="sesion" value="<?php echo $_SESSION['usu_id']?>">
            <h1 class="box-title">Generar Orden de Trabajo </h1><br><br>
            <div class="box-tools pull-right">
            </div>
          </div>
          <div class="box-header with-border" id="filtros">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href=""></a>
              <h1 class="box-title"><strong> Discriminación ordenes de trabajo</strong> </h1>
              <br><br><p>Al dar click sobre el boton de estado de servicio se filtrará las ordenes correspondiente al estado que haya seleccionado</p>
              <p>En este filtro solo estan disponibles los estados correspondientes a una acción que se deba realizar sobre el contrato, ejemplo: <span class="label bg-yellow">Por instalar</span>, <span class="label bg-red">Por cortar</span>, <span class="label bg-gray">Mantenimiento</span> etc...</p>
              <div class="text-center" id="div-filtro">
                <button id="btn-filtro" class="btn btn-danger">Quitar Filtro</button>
              </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
              <table id="listadoOTS" class="table table-striped table-border table-condensed table-hover">
                <thead>
                  <th>Ordenes Pendientes</th>
                  <th>Estado Servicio</th>
                </thead>  
              </table>
            </div>
          </div>
          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Contrato No.</th>
                <th>Nombres</th>
                <th>Documento</th>
                <th>Estado Servicio</th>
                <th>Fecha Estado</th>
                <th>Observacion</th>
                <th>Direccion</th>
                <th>Sede</th>
                <th>Generar OT</th>
                <th>Servicio</th>
                <th>Contrato Inicio</th>
                <th>Telefono1</th>
              </thead>
              <tbody>
                  <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Contrato No.</th>
                <th>Nombres</th>
                <th>Documento</th>
                <th>Estado Servicio</th>
                <th>Fecha Estado</th>
                <th>Observacion</th>
                <th>Direccion</th>
                <th>Sede</th>
                <th>Generar OT</th>
                <th>Servicio</th>
                <th>Contrato Inicio</th>
                <th>Telefono1</th>
              </tfoot>
            </table>
          </div>
                    <!--Fin centro -->
          <div class="panel-body " style="height: auto;" id="formularioregistro">
            <ul class="nav nav-tabs navbar-light">
              <li><a href="#info1" class="inf">Datos principales</a></li>
              <li><a href="#info2" class="inf">Datos del Contrato</a></li>
              <li><a href="#info3" class="inf">Generar Orden de Trabajo</a></li>
            </ul>
          
            <div class="container-fluid">
              <form name="formulario" id="formulario" method="POST">
                <div class="row">
                  <div id="info1" class="col-xs-12 well visible" style="background-color: #E0ECF8;">
                    <h2>Datos principales</h2>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="numDoc">Documento:</label>
                      <input type="number" class="form-control" name="numDoc" id="numDoc" disabled="true">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                      <label for="nombre">Nombres:</label>
                      <input type="text" class="form-control" name="nombre" id="nombre" disabled="true">
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                      <label for="apellido">Apellidos:</label>
                      <input type="text" class="form-control" name="apellido" id="apellido" disabled="true">
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="ciudad">Ciudad:</label>
                      <input type="text" class="form-control" name="ciudad" id="ciudad" disabled="true">
                    </div>
   
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                      <input type="hidden" name="direccion_per" id="direccion_per">
                      <label for="direccion">Dirección:</label>
                      <input type="text" class="form-control" name="direccion" id="direccion" disabled="true">
                    </div>
                            
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="tel1">Teléfono 1:</label>
                      <input type="text" class="form-control" name="tel1" id="tel1" disabled="true">
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="correoPer">Correo personal:</label>
                      <input type="email" class="form-control" name="correoPer" id="correoPer" disabled="true">
                    </div>
                  </div><!-- Fin de datos principales -->
                  <div id="info2" class="col-xs-12 well visible" style="background-color: #E3F6CE;">
                    <h2>Datos del Contrato</h2>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="cont_id">Numero Contrato:</label>
                      <input type="text" class="form-control" name="cont_id" id="cont_id" disabled="true">
                      <input type="hidden" class="form-control" name="ord_trab_contrato_id" id="ord_trab_contrato_id">
                    </div>

                    <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                      <label for="marca">Marca:</label>
                      <input type="text" class="form-control" name="marca" id="marca" disabled="true">
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="alianza">Alianza:</label>
                      <input type="text" class="form-control" name="alianza" id="alianza" disabled="true">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                      <label for="expedCont">Fecha de creación:</label>
                      <input type="date" class="form-control" name="expedCont" id="expedCont" disabled="true">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="direcInst">Dirección Instalación:</label>
                      <input type="text" class="form-control" name="direcInst" id="direcInst" disabled="true">
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="barrInst">Barrio Instalación:</label>
                      <input type="text" class="form-control" name="barrInst" id="barrInst" disabled="true">
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="tel2">Teléfono 2:</label>
                      <input type="text" class="form-control" name="tel2" id="tel2" disabled="true">
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="tipoVivien">Tipo de vivienda:</label>
                      <input type="text" class="form-control" name="tipoVivien" id="tipoVivien" disabled="true">
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="producto">Estado:</label>
                      <input type="text" class="form-control" name="estado" id="estado" disabled="true">
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="usuRegCont">Vendedor:</label>
                      <input type="text" class="form-control" name="usuRegCont" id="usuRegCont" disabled="true">
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="sede">Sede:</label>
                      <input type="text" class="form-control" name="sede" id="sede" disabled="true">
                    </div>
                    <div class="form-group table-responsive col-lg-12 col-md-12 col-sm-12 col-xs-12" id="listadoregistros">
                      <label for="tblproducto">Productos:</label>
                      <table id="tblproducto" class="table table-striped table-border table-condensed table-hover">
                        <thead>
                          <th>Id prod.</th>
                          <th>Nombre</th>
                          <th>Asig. Equipo</th>
                        </thead>
                        <tbody>
                            <!-- Cuerpo de la tabla -->
                        </tbody>
                        <!-- <tfoot>
                          <th>Id prod.</th>
                          <th>Nombre</th> -->
                          <!-- <th>Asig. Equipo</th> -->
                        <!-- </tfoot> -->
                      </table>
                    </div>
                    <div class="form-group table-responsive col-lg-12 col-md-12 col-sm-12 col-xs-12" id="listadoregistros">
                      <label for="tblinstalado">Equipos Instalados:</label>
                      <table id="tblinstalado" class="table table-striped table-border table-condensed table-hover">
                        <thead>
                          <th>Nombre</th>
                          <th>Referencia</th>
                          <th>Marc</th>
                          <th>Serial</th>
                          <th>OT</th>
                          <th>Estado</th>
                          <th>Comodato</th>
                        </thead>
                        <tbody>
                            <!-- Cuerpo de la tabla -->
                        </tbody>
                        <thead>
                          <th>Nombre</th>
                          <th>Referencia</th>
                          <th>Marc</th>
                          <th>Serial</th>
                          <th>OT</th>
                          <th>Estado</th>
                          <th>Comodato</th>
                        </thead>
                      </table>
                    </div>

                  </div> <!-- Fin de datos complementarios --> 
                  <div id="info3" class="col-xs-12 well visible" style="background-color: #F9FDAC;">
                    <h2>Orden de Trabajo</h2>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="ord_trab_fecha_programacion">Fecha de programación:</label>
                      <input type="date" class="form-control" name="ord_trab_fecha_programacion" id="ord_trab_fecha_programacion" maxlength="45" placeholder="Fecha de programación" required="true">
                      <input type="hidden" class="form-control" id="ord_trab_id" name="ord_trab_id">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="ord_trab_fecha_vencimiento">Fecha de Vencimiento:</label>
                      <input type="date" class="form-control" name="ord_trab_fecha_vencimiento" id="ord_trab_fecha_vencimiento" maxlength="45" placeholder="Fecha de Vencimiento" required="true">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12" id="operacion">
                      <label for="ord_trab_operacion_id">Operación:</label>
                      <select class="form-control selectpicker" data-live-search="true" name="ord_trab_operacion_id" id="ord_trab_operacion_id" required=""></select>
                      <input type="hidden" name="cont_ide" id="cont_ide" >
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="ord_trab_tecnico_id">Tecnico Responsable:</label>
                      <select class="form-control selectpicker" data-live-search="true" name="ord_trab_tecnico_id" id="ord_trab_tecnico_id" required="true"></select>
                    </div>
                    <div class="form-group col-lg-9 col-md-9 col-sm-6 col-xs-12">
                      <label for="observacion_cada">Última Observación:</label>
                      <textarea class="form-control" name="observacion_caja" id="observacion_caja" placeholder="Observaciones desde caja" disabled="true"></textarea>
                      <input type="hidden" name="observacion_caja2" id="observacion_caja2">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="info_adicional">Información Adicional del Contrato:</label>
                      <input type="text" class="form-control" name="info_adicional" id="info_adicional" disabled="true">
                    </div>

                    <div class="form-group col-lg-9 col-md-9 col-sm-6 col-xs-12">
                      <label for="ord_trab_observacion">Observaciones Sobre la OT:</label>
                      <textarea class="form-control" name="ord_trab_observacion" id="ord_trab_observacion" placeholder="Observaciones" required="true"></textarea>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="row">
                        <div class="panel-body table-responsive" id="listadoasignados">
                          <label>Asignación de Equipos:</label>
                          <table id="tblasignacion" class="table table-striped table-border table-condensed table-hover">
                            <thead style="background-color: #CEE3F6;">
                              <th>Opciones</th>     
                              <th>Nombre</th>     
                              <th>Referencia</th>     
                              <th>Mac</th>     
                              <th>Serial</th>     
                              <th>Comodato</th>     
                            </thead>
                            <tbody>
                              <!-- Cuerpo de la tabla -->
                            </tbody>
                            <tfoot>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                            </tfoot>
                          </table>
                        </div>
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
                  </div><!-- /.div Orden de Trabajo -->
                </div><!-- /.row formulario -->
              </form>
            </div><!-- /.fin container-fluid -->
          </div><!-- /.fin panel-body -->  
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
        <h4>Seleccione un equipo</h4>
      </div>
      <div class="modal-body">
        <table id="tblequipos" class="table table-striped table-bordered table-condensed table-hover">
          <thead style="background-color: #CEE3F6;">
            <th>Número</th>     
            <th>Nombre</th>     
            <th>Referencia</th>     
            <th>Mac</th>     
            <th>Serial</th>     
            <th>Opciones</th>     
          </thead>
          <tbody>
            
          </tbody>
          <tfoot>
            <th>Número</th>     
            <th>Nombre</th>     
            <th>Referencia</th>     
            <th>Mac</th>     
            <th>Serial</th>     
            <th>Opciones</th>     
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="desplazar()">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  <!-- Fin ventana modal -->


<?php
// Redireccionamiento por validacion de permisos
}else{
  require 'noacceso.php';
}
 require 'footer.php';
?>
 <script type="text/javascript" src="scripts/ordenTrabajo.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>
