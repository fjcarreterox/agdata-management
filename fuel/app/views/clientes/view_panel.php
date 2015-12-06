<h2>Ficha completa del cliente: <span class='muted'><?php echo $cliente->nombre; ?></span> </h2>
<br/>

<div class="panel-group" id="accordion">

    <!-- FIRST PANEL -->
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
                    <?php echo Html::anchor('rel/comaaff/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Asociar administrador de fincas',array('class'=>'btn btn-primary')); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- SECOND PANEL -->
    <div class="panel panel-default" id="panel2">
        <div class="panel-heading">
            <h3 class="panel-title datos_cliente"><span class="muted">
                <a data-toggle="collapse" data-target="#collapseTwo" href="#collapseTwo" class="collapsed">
                    Datos adicionales para presupuestación
                </a></span>
            </h3>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">
                <h4>Datos para presupuestación</h4>
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
                                <td><strong>Fecha de entrega de documentación</strong></td>
                                <td><?php echo date_conv($ficha->fecha_entrega); ?></td>
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
                <br/><br/>
                <h4>Presupuesto asociado</h4>
                <?php if(empty($presupuestos)):?>
                    <p>Aún no existe un presupuesto en el sistema asociado a este cliente. Puedes crearlo desde aquí pulsando en el siguiente botón:</p>
                    <p><?php echo Html::anchor('presupuesto/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Crear nuevo presupuesto', array('class' => 'btn btn-success')); ?></p>
                <?php else: ?>
                    <p>Se han encontrado los siguientes presupuestos:</p>
                    <?php
                        foreach($presupuestos as $p) {
                            echo Html::anchor('presupuesto/view/' . $p->id, 'Presupuesto nº' . $p->num_p, array('target'=>'_blank','title'=>'Se abre en ventana nueva'));
                        }
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- THIRD PANEL -->
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
                <h4>Contrato vigente</h4>
                <?php if(empty($contrato)):?>
                    <p>Aún no se ha creado ningún contrato para este cliente. Puedes crearlo directamente el siguiente botón:</p>
                    <p><?php echo Html::anchor('contrato/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Crear contrato', array('class' => 'btn btn-primary')); ?></p>
                <?php else: ?>
                    <p>A continuación puedes ver el contrato al detalle, incluidos los <strong>servicios contratados</strong> que están
                    contenidos en dicho contrato.</p>
                    <p><?php echo Html::anchor('contrato/view/'.$contrato->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver detalle', array('class' => 'btn btn-default')); ?>&nbsp;&nbsp;
                    <?php echo Html::anchor('contrato/doc/'.$cliente->id, '<span class="glyphicon glyphicon-file"></span> Vista previa del contrato', array('class' => 'btn btn-info')); ?></p>
                <?php endif; ?>
                <br/>
            </div>
        </div>
    </div>

    <!-- FOURTH PANEL -->
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
                            <!--<td><strong>Fecha de firma del contrato</strong></td>-->
                            <td>&nbsp;</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($cesiones as $c): ?>
                            <tr>
                                <td><?php echo $c->nombre; ?></td>
                                <td><?php echo Model_Tipo_Cesionaria::find($c->idtipo_empresa)->get('nombre'); ?></td>
                                <td><?php echo Model_Tipo_Fichero::find($c->idfichero)->get('tipo'); ?></td>
                                <!--<td><?php /*echo date_conv($c->fecha_contrato);*/ ?></td>-->
                                <td><?php echo Html::anchor('cesiones/view/'.$c->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default','target'=>'_blank')); ?>
                                    <?php echo Html::anchor('cesiones/doc/'.$c->id, '<span class="glyphicon glyphicon-file"></span> Vista previa contrato',array('class'=>'btn btn-info','target'=>'_blank')); ?>
                                    <?php echo Html::anchor('cesiones/delete/'.$c->id, '<span class="glyphicon glyphicon-trash"></span> Borrar cesión',array('class'=>'btn btn-danger','onclick'=>"return confirm('¿Estás seguro de querer eliminarla del sistema?')")); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <p><?php echo Html::anchor('cesiones/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Registrar nueva cesión', array('class' => 'btn btn-success')); ?></p>
               </div>
        </div>
    </div>

    <!-- FIFTH PANEL -->
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