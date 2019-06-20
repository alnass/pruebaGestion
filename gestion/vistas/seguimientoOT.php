<?php
// # encoded by @Anderson Ferrucho 
ob_start();
// inicio de sesion
session_start();
if(!isset($_SESSION["usu_nombre"]))
{
  header("Location: login.html");
}else
{
  require 'header.php';
  // validacion de permisos mediante variable de session
  if($_SESSION['ordenTrabajo']==1)
  {

?>
<!-- Ecoded by @Anderson Ferrucho-->

<div class="content-wrapper">
    
    <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Orden de Trabajo - Seguimiento</h1><br><br>
              <!-- <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1> -->
            <div class="box-tools pull-right">
            </div>
          </div>
                  <!-- /.box-header -->
                  <!-- centro -->
          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-border table-condensed table-hover" style="width: 100%">
              <thead style="background-color: #CEE3F6;">
                <th>Estado OT</th>
                <th>Estado Servicio</th>
                <th>ObservacionesRegistradas</th>
                <th>Cliente</th>
                <th>Documento</th>
                <th>Contrato</th>
                <th>Saldo Actual</th>
                <th>No OT</th>
                <th>Tecnico asignado</th>
                <th>Fecha Programación</th>
                <th>Fecha Vencimiento</th>
                <th>Sede</th>
                <th>Imprimir OT</th>
                <th>Opciones OT</th>
              </thead>
              <tbody>
                <tr>
                  
                </tr>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Estado OT</th>
                <th>Estado Servicio</th>
                <th>ObservacionesRegistradas</th>
                <th>Cliente</th>
                <th>Documento</th>
                <th>Contrato</th>
                <th>Saldo Actual</th>
                <th>No OT</th>
                <th>Tecnico asignado</th>
                <th>Fecha Programación</th>
                <th>Fecha Vencimiento</th>
                <th>Sede</th>
                <th>Imprimir OT</th>
                <th>Opciones OT</th>
              </tfoot>
            </table>
          </div> <!-- /. panel-body table-responsive" id="listadoregistros -->
                    <!--Fin centro -->
          <div class="panel-body " style="height: auto;" id="formularioregistro">
            <ul class="nav nav-tabs navbar-light">
              <li><a href="#info1" class="inf">Datos del Suscriptor</a></li>
              <li><a href="#info3" class="inf">Datos de Productos</a></li>
              <li><a href="#info4" class="inf">Datos de Equipos</a></li>
              <li><a href="#info2" class="inf">Reprogramar Orden de Trabajo</a></li>
              <li><a href="#info5" class="inf">Historial OT</a></li>
            </ul>
            <div class="container-fluid">
              <form name="formulario" id="formulario" method="POST">
                <!-- Datos del Cliente -->
                  <!-- <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                    <a data-toggle="modal" href="#myModal2">
                      <button class="btn btn-success" onclick="" type="button">
                          <i class="fa fa-times-circle"></i> Cerrar Orden de Trabajo
                      </button>
                    </a>
                  </div> -->
                <div class="row">
                  <div id="info1" class="col-xs-12 well visible">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <h2 class="box-title">Datos del Suscriptor</h2><br>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="numDoc">Documento:</label>
                      <input type="number" class="form-control" name="numDoc" id="numDoc" disabled="true">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="nombre">Nombres:</label>
                      <input type="text" class="form-control" name="nombre" id="nombre" disabled="true">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="apellido">Apellidos:</label>
                      <input type="text" class="form-control" name="apellido" id="apellido" disabled="true">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="tel1">Teléfono 1:</label>
                      <input type="text" class="form-control" name="tel1" id="tel1" disabled="true">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="correoPer">Correo personal:</label>
                      <input type="email" class="form-control" name="correoPer" id="correoPer" disabled="true">
                    </div>                    
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="ciudad">Ciudad:</label>
                      <input type="text" class="form-control" name="ciudad" id="ciudad" disabled="true">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="cont_id">Numero Contrato:</label>
                      <input type="text" class="form-control" name="cont_id" id="cont_id" disabled="true">
                      <input type="hidden" class="form-control" name="ord_trab_contrato_id" id="ord_trab_contrato_id">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="alianza">Alianza:</label>
                      <input type="text" class="form-control" name="alianza" id="alianza" disabled="true">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="expedDoc">Fecha de afiliación:</label>
                      <input type="date" class="form-control" name="expedCont" id="expedCont" disabled="true">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="direcInst">Dirección Instalación:</label>
                      <input type="text" class="form-control" name="direcInst" id="direcInst" disabled="true">
                    </div>
                    
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="tel2">Teléfono 2:</label>
                      <input type="text" class="form-control" name="tel2" id="tel2" disabled="true">
                    </div>  
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="barrInst">Barrio Instalación:</label>
                      <input type="text" class="form-control" name="barrInst" id="barrInst" disabled="true">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="tipoVivien">Tipo de vivienda:</label>
                      <input type="text" class="form-control" name="tipoVivien" id="tipoVivien" disabled="true">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                      <label for="producto">Estado del servicio:</label>
                      <input type="text" class="form-control" name="estado" id="estado" disabled="true">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="sede">Sede:</label>
                      <input type="text" class="form-control" name="sede" id="sede" disabled="true">
                    </div>
                  </div>
                  <div id="info3" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well oculto" style="background-color: #E0F8F7;">
                    <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12" id="listadoproductos">
                      <h2 class="box-title">Productos</h2><br>
                    </div>
                    <div class="form-group table-responsive col-lg-8 col-md-8 col-sm-12 col-xs-12" id="listadoproductos">
                      <table id="tblproducto" class="table table-striped table-border table-condensed table-hover">
                        <thead>
                          <th>Identificacion del producto.</th>
                          <th>Nombre del producto</th>
                          <th>Precio</th>
                          <th>Valor pronto pago</th>
                        </thead>
                        <tbody>
                            <!-- Cuerpo de la tabla -->
                        </tbody>
                      </table>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12" id="listadoproductos">
                    </div>  
                  </div><!-- Fin datos del cliente --> 
                  <div id="info4" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well oculto" style="background-color: #E6F8E0;">
                    <div class="form-group table-responsive col-lg-12 col-md-12 col-sm-12 col-xs-12" id="listadoregistros">
                      <h2 class="box-title">Equipos Instalados</h2><br>
                      <table id="tblinstalado" class="table table-striped table-border table-condensed table-hover">
                        <thead>
                          <th>Nombre</th>
                          <th>Referencia</th>
                          <th>Marc</th>
                          <th>Serial</th>
                          <th>OT</th>
                          <th>Estado</th>
                          <th>Comodato</th>
                          <th>Retirar</th>
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
                          <th>Retirar</th>
                        </thead>
                      </table>
                    </div>
                  </div> <!-- Fin datos del equipo --> 
                  
                  
                  <div id="info2" class="col-xs-12 well visible" style="background-color: #F1F8E0;">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <h2>Reprogramar Orden de Trabajo</h2>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="ord_trab_nuevo_vencimiento">Reprogramar Vencimiento:</label>
                      <input type="date" class="form-control" name="ord_trab_nuevo_vencimiento" id="ord_trab_nuevo_vencimiento"  placeholder="Fecha de Vencimiento" required="">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <label for="ord_trab_responsable_id">Reasignar Técnico:</label>
                      <input type="hidden" id="ant_resp_id" name="ant_resp_id">
                      <select class="form-control selectpicker" data-live-search="true" name="ord_trab_responsable_id" id="ord_trab_responsable_id" required=""></select>
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12" id="reasig_operacion">
                      <label for="estado">Reasignar Operación:</label>
                      <select class="form-control selectpicker" data-live-search="" name="ord_trab_nva_operacion_id" id="ord_trab_nva_operacion_id" required="">
                      </select>
                      <input type="hidden" name="cont_ide" id="cont_ide">
                    </div>
                    
                    <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12">
                      <label for="ord_trab_observacion">Agregar Observaciones:</label>
                      <textarea class="form-control" name="ord_trab_observacion" id="ord_trab_observacion" placeholder="Observaciones" required="true"></textarea>
                      <input type="hidden" name="ant_obsrv" id="ant_obsrv">
                    </div>
                    <div  class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12">
                      <a data-toggle="modal" href="#myModal">
                        <button id="btnAgregarProducto" type="button" class="btn btn-success" onclick="listarEquipoDetalle()">
                          <span class="fa fa-plus"></span>
                          Asignar Equipo
                        </button>
                      </a>  
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
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group col-lg-10 col-md-10 col-sm-12 col-xs-12" >
                      <!-- Boton de guardar -->
                      <button class="btn btn-primary" type="submit" id="btnGuardar">
                        <i class="fa fa-save"></i>Guardar
                      </button>                           
                      <!-- Boton de cancelar -->
                      <button class="btn btn-danger" onclick="cancelarform()" type="button">
                        <i class="fa fa-arrow-circle-left"></i>Cancelar
                      </button>
                    </div>
                  </div><!-- /.Fin Datos Orden de Trabajo -->
                  <div id="info5" class="col-xs-12 well visible" style="background-color: #F8ECE0;">  
                    <!-- DATOS ORDEN DE TRABAJO -->
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h2>Orden de Trabajo Inicio</h2>  
                      </div>
                      <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                        <label for="ot_id">No OT.</label>
                        <input type="text" class="form-control" name="ot_id" id="ot_id" placeholder="No. OT" disabled="">
                        <input type="hidden" name="ots_id" id="ots_id">
                        <input type="hidden" name="ord_trab_id" id="ord_trab_id">
                      </div>
                      <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label for="ord_trab_fecha_programacion">Programación:</label>
                        <input type="text" class="form-control" name="ord_trab_fecha_programacion" id="ord_trab_fecha_programacion" placeholder="Fecha de programación" disabled="true">
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <label for="ord_trab_fecha_vencimiento">Vencimiento:</label>
                        <input type="text" class="form-control" name="ord_trab_fecha_vencimiento" id="ord_trab_fecha_vencimiento" placeholder="Última fecha de vencimiento" disabled="true">
                        <input type="hidden" name="ord_trab_fecha_vencia" id="ord_trab_fecha_vencia">
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <label for="tec_asignado">Técnico Inicial:</label>
                        <input type="text" class="form-control" name="tec_asignado" id="tec_asignado" placeholder="Técnico asignado" disabled ="true">
                        <input type="hidden" name="tec_cierre" id="tec_cierre">
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <label for="operacion">Operación Inicial:</label>
                        <input type="text" class="form-control" name="operacion" id="operacion" placeholder="Operación" disabled ="true">
                        <input type="hidden" name="ant_operacion" id="ant_operacion">
                      </div>
                      <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12">
                        <label for="ord_trab_observacion">Observacion:</label>
                        <textarea class="form-control" name="ant_obsrvacion" id="ant_obsrvacion" placeholder="Observaciones" disabled="true"></textarea>
                      </div>
                    <div class="form-group table-responsive col-lg-12 col-md-12 col-sm-12 col-xs-12" id="listadoregistros">
                      <h2 class="box-title">Modificaciones</h2><br>
                      <table id="tblOTS" class="table table-striped table-border table-condensed table-hover ">
                        <thead>
                          <th>Modificación</th>
                          <th>Observación</th>
                          <th>Resp. Observación</th>
                          <th>Operación</th>
                          <th>Técnico</th>
                        </thead>
                        <tbody>
                          <tr>
                            
                          </tr>
                          <!-- Cuerpo de la tabla -->
                        </tbody>
                        <tfoot>
                          <th>Fecha Modificación</th>
                          <th>Observación</th>
                          <th>Resp. Observación</th>
                          <th>Operación</th>
                          <th>Técnico</th>
                        </tfoot>
                      </table>
                    </div>
                  </div> <!-- Fin datos del seguimiento --> 
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

 <!-- Ventana modal equipo-->
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
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  <!-- Fin ventana modal equipos -->
  
   <!-- Ventana modal cerrar orden-->
<div class="modal fade " id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Cambiar estado del servicio</h4>
      </div>
      <div class="modal-body">
        <form name="formnuevoestado" id="formnuevoestado" method="POST">
          <div class="modal-body">
            <p>De éste nuevo estado, dependerá el cobro para la próxima facturación </p>
            <div class="row">
              <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <input type="hidden" id="v_contratoid" name="v_contratoid">
                <input type="hidden" id="per_id" name="per_id">
                <input type="hidden" id="mensualidad" name="mensualidad">
                <input type="hidden" name="estado2" id="estado2">
                <label for="m_contratoid">No Contrato</label>
                <input class="form-control" type="text" id="m_contratoid" name="m_contratoid" readonly="">
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <label for="nuevoestado">Nuevo estado:</label>
                  <input type="hidden" id="s_ot_id" name="s_ot_id">
                  <select class="form-control selectpicker" data-live-search="true" name="nuevoestado" id="nuevoestado" required="true"></select>
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <label for="concepto">Motivo de Cierre:</label>
                  <input type="text" name="concepto" class="form-control" id="concepto" required="true">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" name="btnGuardarEstado" id="btnGuardarEstado">Guardar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <!-- Fin ventana cerrar orden -->


<?php
// Redireccionamiento por validacion de permisos
}else{
  require 'noacceso.php';
}
 require 'footer.php';
?>
 <script type="text/javascript" src="scripts/seguimientoOT.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>
