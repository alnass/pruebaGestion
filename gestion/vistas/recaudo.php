<?php
// Activacion de almacenamiento en buffer 
// maintenance effectuee par Anderson Ferrucho
ob_start();
// Inicio de sesion 
session_start();

require_once "../config/conexion.php";

  $sede = $_SESSION['usu_sede_id'];

  $sql = "SELECT * FROM cierre_final
          WHERE '$sede' = cie_fin_sede_id
          ORDER BY cie_fin_id DESC 
          LIMIT 1
          ";
  $valida = ejecutarConsultaSimpleFila($sql);
  $result = $valida['cie_fin_estado'];

if (!isset($_SESSION["usu_nombre"]) ) {
  header("Location: login.html");
}else{
  require 'header.php';
  // Validacion de permisos mediante variable de sesion 
  if ($_SESSION['recaudos']==1 && $result != 0) {
?>
<!--Contenido-->
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content"><!-- Main content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border" style="background: #A9D0F5;">
            <h1 class="">
              Recaudo<br><br>
            </h1>
          </div><!-- /.box-header -->
          <div class="panel-body table-responsive" id="listadoregistros"><!-- centro -->
            <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
              <thead>
                <th>Opciones</th>
                <th>Contrato</th>
                <th>Nombre</th>
                <th>Dirección del servicio</th>
                <th>Cédula</th>
                <th>Teléfono 1</th>
                <th>Mensualidad</th>
                <th>Saldo Anterior</th>
                <th>Saldo Actual</th>
                <th>O.T.</th>
                <th>Estado</th>
              </thead>
              <tbody>
                <!-- Cuerpo de la tabla -->
              </tbody>
              <tfoot>
                <th>Opciones</th>
                <th>Contrato</th>
                <th>Nombre</th>
                <th>Dirección del servicio</th>
                <th>Cédula</th>
                <th>Teléfono 1</th>
                <th>Mensualidad</th>
                <th>Saldo Anterior</th>
                <th>Saldo Actual</th>
                <th>O.T.</th>
                <th>Estado</th>
              </tfoot>
            </table>
          </div>
          <div class="panel-body " style="height: auto;" id="formularioregistro">
            <div class="row">  
              <form name="formulario" id="formulario" method="POST">
                <div class="form-group col-lg-5 col-md-5 col-sm-6 col-xs-12"><!-- DATOS DEL SUSCRIPTOR -->
                  <input type="hidden" name="est_ser_id"        id="est_ser_id"><!--maintenance-->
                  <input type="hidden" name="persona_id"        id="persona_id">
                  <input type="hidden" name="cont_id"           id="cont_id">
                  <input type="hidden" name="mensualidad"       id="mensualidad" >
                  <input type="hidden" name="saldoanterior"     id="saldoanterior">
                  <input type="hidden" name="cargoactual"       id="cargoactual">
                  <input type="hidden" name="valorapagarsindct" id="valorapagarsindct">
                  <input type="hidden" name="prontopago"        id="prontopago">
                  <input type="hidden" name="valorapagar"       id="valorapagar">
                  <label for="no_contrato">Contrato No:</label>
                  <input type="text" class="form-control" name="no_contrato" id="no_contrato" maxlength="45" readonly="">
                  <label for="servicio">Servicios:</label>
                  <input type="text" class="form-control" name="servicio" id="servicio" readonly="">
                  <label for="suscriptor">Suscriptor:</label>
                  <input type="text" class="form-control" name="suscriptor" id="suscriptor" readonly="">
                  <label for="no_documento">Documento:</label>
                  <input type="text" class="form-control" name="no_documento" id="no_documento" readonly="">
                  <label for="telefono">Teléfono:</label>
                  <input type="text" class="form-control" name="telefono" id="telefono" readonly="">
                  <br>
                  <div class="form-group " >
                    <button class="btn btn-success" type="submit" id="btnGuardar" onclick="validarSelect()"> <!-- Boton de guardar -->
                      <i class="fa fa-save"></i>Guardar
                    </button>
                    <button class="btn btn-danger " onclick="cancelarform()" type="button"><!-- Boton de cancelar -->
                      <i class="fa fa-arrow-circle-left"></i>Cancelar
                    </button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal2" id="btnActualizar" > <!-- Boton de guardar -->
                      <i class="fa fa-upload"></i> Actualizar Datos
                    </button>
                  </div>  
                </div>
                <div class="form-group col-lg-1 col-md-1 col-sm-1 col-1">
                 <!-- ESPACIO INTERMEDIO ENTRE LOS DATOS DEL SUSCRIPTOR Y LA CUANTA  -->
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <label for="f_mensualidad">Valor Mensualidad:</label>
                  <input type="text" class="form-control" name="f_mensualidad" id="f_mensualidad" readonly="">
                  <label for="saldoanterior">Saldo Anterior:</label>
                  <input type="text" class="form-control" name="f_saldoanterior" id="f_saldoanterior" readonly="">
                  <label for="cargoactual">Cargo Actual:</label>
                  <input type="text" class="form-control" name="f_cargoactual" id="f_cargoactual" readonly="">
                  <label for="f_valorapagarsindct">Valor a pagar:</label>
                  <input type="text" class="form-control" name="f_valorapagarsindct" id="f_valorapagarsindct" readonly="">
                  <label for="observacion">Observación</label>
                  <textarea class="form-control" name="observacion" id="observacion" cols="30" rows="4" style="resize: none;" placeholder="Escriba aqui las observaciones correspondientes a la transacción"></textarea>                           
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <label for="f_prontopago">Descuento por pronto pago:</label>
                  <input type="text" class="form-control" name="f_prontopago" id="f_prontopago" readonly="" style="background-color:#CEF6E3;">
                  <label for="f_valorapagar">Valor a pagar "CON" descuento:</label>
                  <input type="text" class="form-control" name="f_valorapagar" id="f_valorapagar" readonly="">
                  <label for="concepto">Concepto de transacción:</label>
                  <select class="form-control selectpicker"  data-live-search="true" name="concepto" id="concepto" onchange="
                    if(this.value==2){
                      document.getElementById('no_comprobante').disabled = true;
                      document.getElementById('fecha_comprobante').disabled = true;
                      document.getElementById('imagen').disabled = true;              
                    } else {
                      document.getElementById('no_comprobante').disabled = false;
                      document.getElementById('fecha_comprobante').disabled = false;
                      document.getElementById('imagen').disabled = false;
                      
                    }" required="">
                  </select>
                  <label for="recaudo">RECAUDO:</label>
                  <!-- Début maintenance -->
                  <input type="number" class="form-control" name="recaudo" id="recaudo" required="" style="background-color:#CED8F6;" onblur="validarDeuda()">
                  <!-- Fin maintenance -->
                </div>
                <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                  <label for="no_comprobante">Comprobante:</label>
                  <input type="text" class="form-control" name="no_comprobante" id="no_comprobante" maxlength="45" placeholder="6 digitos" disabled required="" maxlength="6" minlength="6">
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                  <label for="fecha_comprobante">Fecha transacción:</label>
                  <input type="date" class="form-control" name="fecha_comprobante" id="fecha_comprobante" maxlength="45" placeholder="Fecha comprobante" disabled required="">
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12" id="imagen_div">
                  <input type="file" name="imagen" id="imagen" disabled="" required="">
                </div>

              </form>
            </div>
            <div class="row">
              <div class="panel-body table-responsive" id="estadocta">
                <table id="tblestadocta" class="table table-striped table-border table-condensed table-hover">
                  <thead style="background-color: #CED8F6;">
                    <th>Eliminar registro</th>
                    <th>ID</th>
                    <th>Fecha Transacción</th>
                    <th>Comp</th>
                    <th>Concepto</th>
                    <th>Obervación</th>
                    <th>Saldo Anterior</th>
                    <th>Cargos</th>
                    <th>Pagos</th>
                    <th>Saldo Final</th>
                  </thead>
                  <tbody>
                    <!-- Cuerpo de la tabla -->
                  </tbody>
                  <tfoot>
                    <th>Eliminar registro</th>
                    <th>ID</th>
                    <th>Fecha Transacción</th>
                    <th>Comp</th>
                    <th>Concepto</th>
                    <th>Obervación</th>
                    <th>Saldo Anterior</th>
                    <th>Cargos</th>
                    <th>Pagos</th>
                    <th>Saldo Final</th>
                  </tfoot>
                </table>
              </div>
            </div>
          </div><!--Fin centro -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<!-- Début maintenance -->
<!-- # encodé par @Anderson Ferrucho  -->
<!-- Fenetre modale de départ changer le statut du service  -->

<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3>
          Seleccione el nuevo estado del servicio
        </h3>
      </div>
      <form name="formnuevoestado" id="formnuevoestado" method="POST">
        <div class="modal-body">
          <p>Este nuevo estado indicara la orden de corte o reconexión </p>
          <div class="row">
            <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
              <input type="hidden" id="v_contratoid" name="v_contratoid">
              <label for="m_contratoid">No Contrato</label>
              <input class="form-control" type="text" id="m_contratoid" name="m_contratoid" readonly="">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <label for="nuevoestado">Nuevo estado:</label>
                <select class="form-control selectpicker" data-live-search="true" name="nuevoestado" id="nuevoestado"></select>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <label for="nuevoestado">Observación:</label>
                <input class="form-control" name="observacion" id="observacion_est" onKeyUp="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12" id="doc_oculto">
              <label for="nuevoestado">Adjuntar Solicitud:</label>
                <input type="file" class="form-control-file" name="documento" id="documento" >
            </div>
          </div>  
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="btnGuardarEstado" id="btnGuardarEstado" onclick="">Guardar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Fenetre modale finale oú il fait changement d'état -->
<!-- Fenetre modale de départ mise à niveau personne  -->
<div class="modal fade " id="myModal2" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3>
          Actualizar datos del suscriptor
        </h3>
        <p>Este procedimiento almacenará un registro del cambio</p>
      </div>
      <form name="formnactualizarsuscriptor" id="formnactualizarsuscriptor" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
              <input type="hidden" id="contratoid1" name="contratoid">
              <label for="contratoid1">No Contrato</label>
              <input class="form-control" type="text" id="contratoid2" readonly="">
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
              <input type="hidden" id="no_suscriptor1" name="no_suscriptor">
              <label for="no_suscriptor">No Suscriptor</label>
              <input class="form-control" type="text" id="no_suscriptor2" readonly="">
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12" id="doc_oculto">
              <input type="hidden" id="documento_ant" name="documento_ant">
              <label for="documento_upg">Documento</label>
              <input class="form-control" type="text" id="documento_upg" name="documento_upg" required="">
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <input type="hidden" id="nombres_ant" name="nombres_ant">
              <label for="nombres_upg">Nombres</label>
              <input class="form-control" type="text" id="nombres_upg" name="nombres_upg" required="">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <input type="hidden" id="apellidos_ant" name="apellidos_ant">
              <label for="apellidos_upg">Apellidos</label>
              <input class="form-control" type="text" id="apellidos_upg" name="apellidos_upg" required="">
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <input type="hidden" id="direccion_ant_sus" name="direccion_ant_sus">
              <label for="direccion_upg_sus">Direccion Suscriptor</label>
              <input class="form-control" type="text" id="direccion_upg_sus" name="direccion_upg_sus" required=""> 
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <input type="hidden" id="barrio_ant_sus" name="barrio_ant_sus">
              <label for="barrio_upg_sus">Barrio Suscriptor</label>
              <input class="form-control" type="text" id="barrio_upg_sus" name="barrio_upg_sus" required="">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <input type="hidden" id="telefono_ant" name="telefono_ant">
              <label for="telefono_upg">Telefono</label>
              <input class="form-control" type="text" id="telefono_upg" name="telefono_upg" required="">
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <input type="hidden" id="direccion_ant_ser" name="direccion_ant_ser">
              <label for="direccion_upg_ser">Direccion Servicio</label>
              <input class="form-control" type="text" id="direccion_upg_ser" name="direccion_upg_ser" required="">
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <input type="hidden" id="barrio_ant_ser" name="barrio_ant_ser">
              <label for="barrio_upg_ser">Barrio Servicio</label>
              <input class="form-control" type="text" id="barrio_upg_ser" name="barrio_upg_ser"required="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="btnActualizarCliente" id="btnActualizarCliente">Actualizar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Fin maintenance -->
<?php
// Redireccionamiento a por validacion de permisos
}else{
  require 'noacceso.php';
}
 require 'footer.php'
?>
 <script type="text/javascript" src="scripts/recaudo.js"></script>  
<?php 
}
// liberar el espacio del bufer
ob_end_flush();
?>