<h2>Ficha completa del cliente: <span class='muted'><?php echo $cliente->nombre; ?></span> </h2>
<br/>
<div class="panel-group" id="accordion">
    <div class="panel panel-default" id="panel1">
        <div class="panel-heading">
            <h3 class="panel-title datos_cliente"><span class="muted">
                <a data-toggle="collapse" data-target="#collapseOne" href="#collapseOne">
                    Datos identificativos
                </a></span>
            </h3>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
                <h4>Datos básicos de contacto</h4>
                <p>En la siguiente tabla mostramos los datos comúnes a todo tipo de clientes: <strong>estado, DNI/NIF, tipo de cliente,
                        dirección completa, teléfono, página web, e-mail de contacto, actividad a la que se dedica y las observaciones</strong> que estimemos oportunas.</p>
                <br/>
                <table class="table table-striped table-bordered table-hover">
                    <thead></thead>
                    <tbody>
                    <tr class="text-center">
                        <td><?php echo Model_Estados_Cliente::find($cliente->estado)->get('nombre'); ?></td>
                        <td><?php if($cliente->cif_nif!=''){echo $cliente->cif_nif;}else{echo '<span class="red">-- FALTA NIF/CIF --</span>';} ?></td>
                        <td colspan="2"><?php echo Model_Tipo_Cliente::find($cliente->tipo)->get('tipo'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"><?php echo $cliente->direccion; ?>, <?php echo $cliente->cpostal; ?>, <?php echo $cliente->loc; ?>. <?php echo $cliente->prov; ?></td>
                    </tr>
                    <tr class="text-center">
                        <td><?php echo $cliente->tel; ?></td>
                        <td><?php if($cliente->pweb!=''){echo $cliente->pweb;}else{echo '<span class="red">-- FALTA PAG. WEB --</span>';} ?></td>
                        <td><?php if($cliente->email!=''){echo $cliente->email;}else{echo '<span class="red">-- FALTA E-MAIL --</span>';} ?></td>
                        <td><?php echo $cliente->actividad; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"><?php if($cliente->observ!=''){echo $cliente->observ;}else{echo '<span>Sin observaciones aún.</span>';} ?></td>
                    </tr>
                    </tbody>
                </table>
                <br/>
                <?php echo Html::anchor('clientes/edit/'.$cliente->id, '<span class="glyphicon glyphicon-pencil"></span> Editar datos básicos',array('class'=>'btn btn-success')); ?> &nbsp;
                <?php echo Html::anchor('clientes', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de clientes',array('class'=>'btn btn-danger')); ?>
                <br/><br/>
                <h4>Personal de contacto</h4>
                <?php if(empty($contactos)): ?>
                    <p>No se ha encontrado aún personal de este cliente registrado en nuestro sistema.</p>
                <?php else: ?>
                    <p>A continuación listamos el personal registrado en el sistema que tenga algún tipo de relación con nosotros</p>
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <thead>
                        <tr class="text-center">
                            <td><strong>Nombre</strong></td>
                            <td><strong>DNI</strong></td>
                            <td><strong>Cargo o función</strong></td>
                            <td><strong>Relación con AGDATA</strong></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($contactos as $c): ?>
                            <tr>
                                <td><?php echo $c->nombre; ?></td>
                                <td><?php echo $c->dni; ?></td>
                                <td><?php echo $c->cargofuncion; ?></td>
                                <td><?php echo Model_Relacion::find($c->relacion)->get('nombre'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <?php echo Html::anchor('personal/associate/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Añadir personal',array('class'=>'btn btn-success')); ?>
                <br/><br/>
                <!--Tipo Comunidad -->
                <?php if($cliente->tipo==6): ?>
                    <h4>Administrador de fincas asociado</h4>
                    <?php if(empty($aaff)): ?>
                        <p>No se ha encontrado aún un administrador de fincas que gestione esta comunidad. Selecciona una empresa gestora que la represente.</p>
                        <?php echo Html::anchor('rel/comaaff/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Añadir adminitrador de fincas',array('class'=>'btn btn-success')); ?>
                    <?php else: ?>
                        <table class="table table-striped table-bordered table-hover table-responsive">
                        <?php
                        foreach($aaff as $af){
                            echo "<tr><td>".Model_Cliente::find($af->idaaff)->get('nombre')."</td>";
                            echo "<td>".Html::anchor('rel/comaaff/edit/'.$af->id, '<span class="glyphicon glyphicon-pencil"></span> Editar asociación',array('class'=>'btn btn-success'))."&nbsp;";
                            echo Html::anchor('rel/comaaff/delete/'.$af->id, '<span class="glyphicon glyphicon-trash"></span> Borrar asociación',array('class'=>'btn btn-danger'))."</td></tr>";
                        }?>
                        </table>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="panel panel-default" id="panel2">
        <div class="panel-heading">
            <h3 class="panel-title datos_cliente"><span class="muted">
                <a data-toggle="collapse" data-target="#collapseTwo" href="#collapseTwo" class="collapsed">
                    Datos para presupuestación
                </a></span>
            </h3>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">
                    <?php if(empty($ficha)):?>
                        <p>Se ha detectado que este cliente aún no tiene creada su ficha completa con los
                            datos específicos requeridos para gestionar adecuadamente sus presupuestos y contratos.</p>
                        <?php echo Html::anchor('ficha/create/'.$cliente->id, '<span class="glyphicon glyphicon-list"></span> Crear ficha completa de cliente',array('class'=>'btn btn-success')); ?>
                    <?php else: ?>
                        <p>Los clientes deben tener cumplimentados los siguientes campos adicionales que nos ayuden a gestionar los servicios
                            contratados.</p>
                        <table class="table table-striped table-bordered table-hover table-responsive">
                            <tbody>
                            <tr>
                                <td><strong>Móvil de contacto</strong></td>
                                <td><?php if($ficha->movil_contacto!=0){echo $ficha->movil_contacto;}else{echo '<span class="red">-- FALTA MÓVIL DE CONTACTO --</span>';} ?></td>
                            </tr>
                            <tr>
                                <td><strong>E-mail de contacto</strong></td>
                                <td><?php if($ficha->email_contacto!=''){echo $ficha->email_contacto;}else{echo '<span class="red">-- FALTA EMAIL DE CONTACTO --</span>';} ?></td>
                            </tr>
                            <tr>
                                <td><strong>Ubicación de otras sedes</strong></td>
                                <td><?php if($ficha->otras_sedes!=''){echo $ficha->otras_sedes;}else{echo '<span>No especificadas.</span>';} ?></td>
                            </tr>
                            <tr>
                                <td><strong>Núm. aproximado de trabajadores</strong></td>
                                <td><?php echo $ficha->num_trabajadores; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Núm. aproximado de equipos informáticos</strong></td>
                                <td><?php echo $ficha->num_equipos; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Código IBAN</strong></td>
                                <td><?php if($ficha->iban!=''){echo $ficha->iban;}else{echo '<span class="red">-- FALTA CÓDIGO IBAN --</span>';} ?></td>
                            </tr>
                            <tr>
                                <td><strong>Fecha envío correo de bienvenida</strong></td>
                                <td><?php echo date_conv($ficha->fecha_bienvenida); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Fecha de auditoría</strong></td>
                                <td><?php echo date_conv($ficha->fecha_auditoria); ?></td>
                            </tr>

                            </tbody>
                        </table>
                        <?php echo Html::anchor('ficha/edit/'.$cliente->id, '<span class="glyphicon glyphicon-pencil"></span> Editar datos específicos',array('class'=>'btn btn-success')); ?> &nbsp;
                        <?php echo Html::anchor('clientes', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de clientes',array('class'=>'btn btn-danger')); ?>
                    <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="panel panel-default" id="panel3">
        <div class="panel-heading">
            <h3 class="panel-title datos_cliente"><span class="muted">
                <a data-toggle="collapse" data-target="#collapseThree" href="#collapseThree" class="collapsed">
                    Servicios contratados y forma de pago
                </a></span>
            </h3>
        </div>
        <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body">
                <br/>
                <?php if(empty($servicios)):?>
                    <p>Aún no se ha asociado ningún servicio a contratar por este cliente. Accede desde el siguiente botón:</p>
                <?php else: ?>
                    <h4>Servicios contratados por el cliente</h4>
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <thead>
                            <tr class="text-center">
                                <td><strong>Tipo servicio</strong></td>
                                <td><strong>Importe sin IVA</strong></td>
                                <td><strong>Año</strong></td>
                                <td><strong>Mes de facturación</strong></td>
                                <td><strong>Periodicidad</strong></td>
                                <td><strong>Cuota</strong></td>
                                <td><strong>Forma de pago</strong></td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                    <?php foreach($servicios as $s): ?>
                        <tr class="text-center">
                            <td><?php echo Model_Servicio::find($s->idtipo_servicio)->get('nombre'); ?></td>
                            <td><?php echo $s->importe; ?> &euro;</td>
                            <td><?php echo $s->year; ?></td>
                            <td><?php echo $s->mes_factura; ?></td>
                            <td><?php echo $s->periodicidad; ?></td>
                            <td><?php echo $s->cuota; ?> &euro;</td>
                            <td><?php echo $s->forma_pago; ?></td>
                            <td><?php echo Html::anchor('servicios/contratados/edit/'.$s->id, '<span class="glyphicon glyphicon-pencil"></span> Editar',array('class'=>'btn btn-success')); ?></td>
                        </tr>
                    <?php endforeach; ?>
                        </tbody>
                        </table>
                <?php endif; ?>
                <p><?php echo Html::anchor('servicios/contratados/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Añadir nueva contratación de servicio', array('class' => 'btn btn-success')); ?></p>
            </div>
        </div>
    </div>
    <div class="panel panel-default" id="panel4">
        <div class="panel-heading">
            <h3 class="panel-title datos_cliente"><span class="muted">
                <a data-toggle="collapse" data-target="#collapseFour" href="#collapseFour" class="collapsed">
                    Auditoría de adaptación
                </a></span>
            </h3>
        </div>
        <div id="collapseFour" class="panel-collapse collapse">
            <div class="panel-body">
                <p>En esta sección mostramos, por orden, los datos recogidos en el <b>cuestionario de la auditoría</b>, los <b>ficheros de datos identificados</b> y
                    por último las <b>cesiones de datos</b>.</p>
                <br/>
                <?php if(empty($adaptacion)):?>
                    <p>No se ha realizado el cuestionario básico de adaptación al cliente. Procede desde el siguiente botón:</p>
                    <p><?php echo Html::anchor('adaptacion/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Cuestionario básico de adaptación', array('class' => 'btn btn-success')); ?></p>
                <?php else: ?>
                    <h4>Datos obtenidos del cuestionario básico de adptación</h4>
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <tbody>
                        <tr class="text-left">
                            <td>Núm. de servidores de datos</td>
                            <td><?php echo $adaptacion->num_serv; ?></td>
                        </tr>
                        <tr class="text-left">
                            <td>Núm. de equipos de sobremesa</td>
                            <td><?php echo $adaptacion->num_pc; ?></td>
                        </tr>
                        <tr class="text-left">
                            <td>Núm. de equipos de sobremesa conectados a un servidor</td>
                            <td><?php echo $adaptacion->num_pc_online; ?></td>
                        </tr>
                        <tr class="text-left">
                            <td>'Núm. de equipos portátiles</td>
                            <td><?php echo $adaptacion->num_laptop; ?></td>
                        </tr>
                        <tr class="text-left">
                            <td>Núm. de equipos portátiles conectados a un servidor</td>
                            <td><?php echo $adaptacion->num_laptop_online; ?></td>
                        </tr>
                        <tr class="text-left">
                            <td>Frecuencia de cambio de constraseñas en los equipos</td>
                            <td><?php echo $adaptacion->pass_freq; ?></td>
                        </tr>
                        <tr class="text-left">
                            <td>Frecuencia de realización de copias de seguridad</td>
                            <td><?php echo $adaptacion->backup_freq; ?></td>
                        </tr>
                        <tr class="text-left">
                            <td>Software de gestión para almacenar datos de carárter personal</td>
                            <td><?php if($adaptacion->management_sw!=''){echo $adaptacion->management_sw;}else{echo '<span class="red">-- NO ESPECIFICADO --</span>';} ?></td>
                        </tr>
                        <tr class="text-left">
                            <td>Tipo de control de acceso a los ficheros de datos</td>
                            <td><?php if($adaptacion->access_control!=''){echo $adaptacion->access_control;}else{echo '<span class="red">-- NO ESPECIFICADO --</span>';} ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <p><?php echo Html::anchor('adaptacion/edit/'.$adaptacion->id, '<span class="glyphicon glyphicon-pencil"></span> Editar datos del cuestionario', array('class' => 'btn btn-success')); ?></p>
                <?php endif; ?>
                <br/>
                <?php if(empty($ficheros)):?>
                    <p>Aún no se han registrado ficheros de datos para este cliente en el sistema. Utiliza el botón siguiente para crearlos.</p>
                <?php else: ?>
                    <h4>Ficheros de datos identificados</h4>
                <table class="table table-striped table-bordered table-hover table-responsive">
                    <thead>
                    <tr class="text-center">
                        <td><strong>Tipo</strong></td>
                        <td><strong>Ubicación</strong></td>
                        <td><strong>Registrado en AEPD</strong></td>
                        <td><strong>Cesión de datos</strong></td>
                        <td>&nbsp;</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($ficheros as $f): ?>
                        <tr>
                            <td><?php echo Model_Tipo_Fichero::find($f->idtipo)->get('tipo'); ?></td>
                            <td><?php echo $f->ubicacion; ?></td>
                            <td><?php if($f->inscrito){echo "SÍ";}else{echo "NO";}; ?></td>
                            <td><?php if($f->cesion){echo "SÍ";}else{echo "NO";}; ?></td>
                            <td><?php echo Html::anchor('ficheros/view/'.$f->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default','target'=>'_blank')); ?>
                                <?php echo Html::anchor('ficheros/delete/'.$f->id, '<span class="glyphicon glyphicon-trash"></span> Borrar',array('class'=>'btn btn-danger','onclick'=>"return confirm('¿Estás seguro de querer eliminarlo del sistema?')")); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
                <p><?php echo Html::anchor('ficheros/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo fichero', array('class' => 'btn btn-success')); ?></p>
                <br/>
                <h4>Cesiones de datos</h4>
                <?php if(empty($cesiones)):?>
                    <p>Aún no se han registrado cesiones de ficheros de datos en el sistema para este cliente.</p>
                <?php else: ?>
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <thead>
                        <tr class="text-center">
                            <td><strong>Empresa</strong></td>
                            <td><strong>Tipo</strong></td>
                            <td><strong>Fichero cesionado</strong></td>
                            <td><strong>Fecha de firma del contrato</strong></td>
                            <td>&nbsp;</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($cesiones as $c): ?>
                            <tr>
                                <td><?php echo $c->nombre; ?></td>
                                <td><?php echo Model_Tipo_Cesionaria::find($c->idtipo_empresa)->get('nombre'); ?></td>
                                <td><?php echo Model_Tipo_Fichero::find($f->idtipo)->get('tipo'); ?></td>
                                <td><?php echo date_conv($c->fecha_contrato); ?></td>
                                <td><?php echo Html::anchor('cesiones/view/'.$f->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default','target'=>'_blank')); ?>
                                    <?php echo Html::anchor('cesiones/delete/'.$f->id, '<span class="glyphicon glyphicon-trash"></span> Borrar',array('class'=>'btn btn-danger','onclick'=>"return confirm('¿Estás seguro de querer eliminarla del sistema?')")); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <p><?php echo Html::anchor('cesiones/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Registrar nueva cesión', array('class' => 'btn btn-success')); ?></p>
               </div>
        </div>
    </div>
    <div class="panel panel-default" id="panel5">
        <div class="panel-heading">
            <h3 class="panel-title datos_cliente"><span class="muted">
                <a data-toggle="collapse" data-target="#collapseFive" href="#collapseFive" class="collapsed">
                    Auditoría de mantenimiento
                </a></span>
            </h3>
        </div>
        <div id="collapseFive" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Pendiente de rellenar</p>
            </div>
        </div>
    </div>
</div>
<br/>