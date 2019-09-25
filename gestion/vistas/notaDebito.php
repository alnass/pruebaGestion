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
  if ($_SESSION['notasdebito']==1) {
?>
<!-- encoded by @Francisco Monsalve -->
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border" style="background: pink;">
                          <h1 class="">Registro de 'NOTAS DEBITO'<br></h1>
                          <p>Las notas credito representan un incremento en saldo actual del suscriptor</p>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Num Contrato</th>
                            <th>Nombre</th>
                            <th>Dirección del servicio</th>
                            <th>Cédula</th>
                            <th>Teléfono 1</th>
                            <th>Mensualidad</th>
                            <th>Saldo Anterior</th>
                            <th>Saldo Actual</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>
                            <!-- Cuerpo de la tabla -->
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Num Contrato</th>
                            <th>Nombre</th>
                            <th>Dirección del servicio</th>
                            <th>Cédula</th>
                            <th>Teléfono 1</th>
                            <th>Mensualidad</th>
                            <th>Saldo Anterior</th>
                            <th>Saldo Actual</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body " style="height: auto;" id="formularioregistro">
                      <div class="row">  
                        <form name="formulario" id="formulario" method="POST">
                          <!-- Identificacion de ID y captura de nombre -->

                          <!-- DATOS DEL SUSCRIPTOR -->
                          <div class="form-group col-lg-5 col-md-5 col-sm-6 col-xs-12">
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

                              <!-- Boton de guardar -->
                              <button class="btn btn-success" type="submit" id="btnGuardar">
                                <i class="fa fa-save"></i>Guardar
                              </button>
                              
                              <!-- Boton de cancelar -->
                              <button class="btn btn-danger " onclick="cancelarform()" type="button">
                                <i class="fa fa-arrow-circle-left"></i>Cancelar
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
                            <select class="form-control selectpicker" data-live-search="true" name="concepto" id="concepto" onchange="
                              if(this.value==2){
                                document.getElementById('no_comprobante').disabled = true;
                                document.getElementById('fecha_comprobante').disabled = true;
                              } else {
                                document.getElementById('no_comprobante').disabled = false;
                                document.getElementById('fecha_comprobante').disabled = false;
                              }">
                                  
                            </select>

                            <label for="recaudo">VALOR DE LA NOTA:</label>
                            <input type="number" class="form-control" name="recaudo" id="recaudo" required="" style="background-color:#CED8F6;">

                          
                            <label for="no_comprobante">No de comprobante:</label>
                            <input type="text" class="form-control" name="no_comprobante" id="no_comprobante" maxlength="45" placeholder="Nombres"  >

                            <label for="fecha_comprobante">Fecha transacción:</label>
                            <input type="date" class="form-control" name="fecha_comprobante" id="fecha_comprobante" maxlength="45" placeholder="Nombres"  >
                          
    
                          </div>
                        </form>
                      </div>
                      <div class="row">
                        <div class="panel-body table-responsive" id="estadocta">
                          <table id="tblestadocta" class="table table-striped table-border table-condensed table-hover">
                            <thead style="background-color: #CED8F6;">
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
 <script type="text/javascript" src="scripts/notaDebito.js"></script>  
<?php 
}
// luberar el espacio del bufer
ob_end_flush();
?>