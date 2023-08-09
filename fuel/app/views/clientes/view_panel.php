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
                <p>En la siguiente tabla mostramos los datos comúnes a todo tipo de clientes: <strong>tipo de cliente, estado, CIF/NIF,
                        dirección completa, teléfonos, página web, e-mail de contacto, actividad a la que se dedica, su IBAN, el nº de trabajadores, su situación
                        en la adaptación de la LOPD y las observaciones</strong> que estimemos oportunas.</p>
                <br/>
                <table class="table table-striped table-bordered table-hover">
                    <thead></thead>
                    <tbody>
                    <tr class="text-center">
                        <td colspan="2"><?php echo Model_Tipo_Cliente::find($cliente->tipo)->get('tipo'); ?></td>
                        <td><?php echo Model_Estados_Cliente::find($cliente->estado)->get('nombre'); ?></td>
                        <td><?php if($cliente->cif_nif!=''){echo $cliente->cif_nif;}else{echo '<span class="red">-- FALTA NIF/CIF --</span>';} ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"><?php echo $cliente->direccion; ?>, <?php echo $cliente->cpostal; ?>, <?php echo $cliente->loc; ?>. <?php echo $cliente->prov; ?></td>
                    </tr>
                    <tr class="text-center">
                        <td><?php echo $cliente->tel." / ".$cliente->tel2; ?></td>
                        <td><?php if($cliente->pweb!=''){echo $cliente->pweb;}else{echo '<span class="red">-- FALTA PAG. WEB --</span>';} ?></td>
                        <td><?php if($cliente->email!=''){echo $cliente->email;}else{echo '<span class="red">-- FALTA E-MAIL --</span>';} ?></td>
                        <td><?php echo $cliente->actividad; ?></td>
                    </tr>
                    <tr class="text-center">
                        <td><?php if($cliente->iban!=''){echo $cliente->iban;}else{echo '<span class="red">-- FALTA IBAN --</span>';} ?></td>
                        <td>Núm. trabajadores: <?php echo $cliente->num_trab;?></td>
                        <td><?php if($cliente->idsituacion!=0){echo Model_Tipo_Situacion::find($cliente->idsituacion)->get('tipo');}else{echo '<span class="red">-- SITUACIÓN N/D --</span>';} ?></td>
                        <td><?php echo "Clave interna: ";
                            if($cliente->password != NULL){echo "SÍ";}
                            else{echo "NO";}
                            ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"><i>Observaciones: </i><strong>
                                <?php if($cliente->observ!=''){
                                    $res = explode('- ',$cliente->observ);
                                    echo "<ul>";
                                    foreach($res as $r){
                                        echo "<li>".$r."</li>";
                                    }
                                    echo "</ul>";
                                }else{
                                    echo '<span>Sin observaciones aún.</span>';
                                } ?>
                            </strong></td>
                    </tr>
                    <tr>
                        <td colspan="4"><i>Tareas pendientes: </i><strong>
                                <?php if($cliente->pending!=''){
                                    $res = explode('- ',$cliente->pending);
                                    echo "<ul>";
                                    foreach($res as $r){
                                        echo "<li>".$r."</li>";
                                    }
                                    echo "</ul>";
                                }else{
                                    echo '<span>Sin tareas pendientes aún.</span>';
                                } ?>
                            </strong></td>
                    </tr>
                    </tbody>
                </table>
                <br/>
                <?php echo Html::anchor('clientes/edit/'.$cliente->id, '<span class="glyphicon glyphicon-pencil"></span> Editar datos básicos',array('class'=>'btn btn-success')); ?>&nbsp;
                <?php echo Html::anchor('clientes', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de clientes',array('class'=>'btn btn-danger')); ?>&nbsp;
                <?php echo Html::anchor('agenda/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Crear nuevo evento',array('class'=>'btn btn-primary')); ?>&nbsp;
                <?php
                if($cliente->password != NULL) {$btn_title="Cambiar contraseña";}
                else{$btn_title="Generar nueva contraseña";}
                echo Html::anchor('clientes/new_pass/' . $cliente->id, '<span class="glyphicon glyphicon-envelope"></span> '.$btn_title, array('class' => 'btn btn-warning'));
                ?>
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
                            <td>&nbsp;</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($contactos as $c): ?>
                            <tr>
                                <td><?php echo $c->nombre; ?></td>
                                <td><?php echo $c->dni; ?></td>
                                <td><?php echo $c->cargofuncion; ?></td>
                                <td><?php echo Model_Relacion::find($c->relacion)->get('nombre'); ?></td>
                                <td><?php echo Html::anchor('personal/edit/'.$c->id, '<span class="glyphicon glyphicon-pencil"></span> Editar',array('class'=>'btn btn-success','target'=>'_blank','title'=>'Se abre en ventana nueva...')); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <?php echo Html::anchor('personal/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Añadir personal',array('class'=>'btn btn-success')); ?>
                <br/><br/>
                <!--Tipo Comunidad -->
                <?php if($cliente->tipo==6 || $cliente->tipo==10): ?>
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
    <!--<div class="panel panel-default" id="panel2">
        <div class="panel-heading">
            <h3 class="panel-title datos_cliente"><span class="muted">
                <a data-toggle="collapse" data-target="#collapseTwo" href="#collapseTwo" class="collapsed">
                    Presupuestación (Deprecated)
                </a></span>
            </h3>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">
                <h4>Presupuesto asociado</h4>
                <?php if(empty($presupuestos)):?>
                    <p>Aún no existe un presupuesto en el sistema asociado a este cliente. Puedes crearlo desde aquí pulsando en el siguiente botón:</p>
                    <p><?php /*echo Html::anchor('presupuesto/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Crear nuevo presupuesto', array('class' => 'btn btn-success'));*/ ?></p>
                <?php else: ?>
                    <p>Se han encontrado los siguientes presupuestos:</p>
                    <?php
                        /*foreach($presupuestos as $p) {
                            echo Html::anchor('presupuesto/view/' . $p->id, 'Presupuesto nº' . $p->num_p, array('target'=>'_blank','title'=>'Se abre en ventana nueva'));
                        }*/
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </div>-->

    <!-- THIRD PANEL -->
    <div class="panel panel-default" id="panel3">
        <div class="panel-heading">
            <h3 class="panel-title datos_cliente"><span class="muted">
                <a data-toggle="collapse" data-target="#collapseThree" href="#collapseThree" class="collapsed">
                    Contratos y Servicios
                </a></span>
            </h3>
        </div>
        <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body">
                <h4>Contratos del cliente</h4>
                <?php if(empty($contratos)){
                        echo "<p>Aún no se ha creado ningún contrato para este cliente. Puedes crearlo directamente el siguiente botón:</p>";
                    }else{
                        echo "<p>A continuación se listan todos los contratos asociados con el cliente.</p>";
                        echo '<table class="table table-striped"><thead><tr><th>Núm. Contrato</th><th>Fecha de firma</th><th>&nbsp;</th></tr></thead><tbody>';
                    foreach($contratos as $contrato) {
                        ?>
                        <tr>
                        <p><?php echo "<td>".Html::anchor('contrato/view/' . $contrato->id, 'Contrato nº'.$contrato->id, array('target' => '_blank   '))."</td>"; ?>
                            <?php echo "<td>".date_conv($contrato->fecha_firma)."</td>"; ?>
                            <?php echo "<td>".Html::anchor('contrato/doc/' . $contrato->id, '<span class="glyphicon glyphicon-file"></span> Vista previa del contrato', array('class' => 'btn btn-info'))."</td>"; ?></p>
                        </tr>
                        <?php
                    }
                    echo "</tbody></table>";
                }
                echo "<br/><p>".Html::anchor('contrato/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Crear contrato', array('class' => 'btn btn-primary'))."</p>";?>
                <br/>
            </div>
        </div>
    </div>

    <!-- FOURTH PANEL -->
    <div class="panel panel-default" id="panel4">
        <div class="panel-heading">
            <h3 class="panel-title datos_cliente"><span class="muted">
                <a data-toggle="collapse" data-target="#collapseFour" href="#collapseFour" class="collapsed">
                    Protección de Datos
                </a></span>
            </h3>
        </div>
        <div id="collapseFour" class="panel-collapse collapse">
            <div class="panel-body">
                <p>En esta sección mostramos, por orden, los datos recogidos en el <b>cuestionario informático</b>, los <b>ficheros de datos identificados</b> y
                    por último las <b>cesiones de datos</b>.</p>
                <br/>
                <?php if(empty($adaptacion)):?>
                    <p>No se ha realizado el cuestionario informático al cliente. Procede desde el siguiente botón:</p>
                    <p><?php echo Html::anchor('adaptacion/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Cuestionario informático', array('class' => 'btn btn-primary')); ?></p>
                <?php else: ?>
                    <h4>Datos obtenidos del <strong>cuestionario informático</strong></h4>
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
                            <td>Localización de las copias de seguridad</td>
                            <td><?php
                                $store_ops = array(
                                    "pendrive"=>"Pendrive",
                                    "disco"=>"Disco duro externo",
                                    "nube"=>"Servicios en la nube",
                                    "otros"=>"Otros"
                                );
                                if($adaptacion->storage!=''){echo $store_ops[$adaptacion->storage];}else{echo '<span class="red">-- NO ESPECIFICADO --</span>';} ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <p><?php echo Html::anchor('adaptacion/edit/'.$adaptacion->id, '<span class="glyphicon glyphicon-pencil"></span> Editar datos del cuestionario informático', array('class' => 'btn btn-success')); ?></p>
                <?php endif; ?>
                <br/>
                <?php if(empty($ficheros)):?>
                    <p>Aún no se han registrado ficheros de datos para este cliente en el sistema. Utiliza el botón siguiente para crearlos.</p>
                <?php else:
                    $soporte_ops = array(
                        "digital"=>"En formato digital",
                        "papel"=>"En papel",
                        "mixto"=>"Mixto"
                    );

                    ?>
                    <h4>Ficheros de datos identificados</h4>
                <table class="table table-striped table-bordered table-hover table-responsive">
                    <thead>
                    <tr class="text-center">
                        <td><strong>Tipo</strong></td>
                        <td><strong>Nivel de Seguridad</strong></td>
                        <td><strong>Sistema de tratamiento</strong></td>
                        <td>&nbsp;</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($ficheros as $f): ?>
                        <tr>
                            <td><?php echo Model_Tipo_Fichero::find($f->idtipo)->get('tipo'); ?></td>
                            <td><?php
                                switch ($f->nivel) {
                                    case 1:
                                        echo "Básico";
                                        break;
                                    case 2:
                                        echo "Medio";
                                        break;
                                    case 3:
                                        echo "Alto";
                                        break;
                                    default:
                                        echo "-- NO ESPECIFICADO --";
                                }
                                ?></td>
                            <td><?php echo $soporte_ops[$f->soporte]; ?></td>
                            <td><?php echo Html::anchor('ficheros/view/'.$f->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default','target'=>'_blank')); ?>
                                <?php echo Html::anchor('rel/estructura/data/'.$f->id, '<span class="glyphicon glyphicon-file"></span> Datos',array('class'=>'btn btn-info')); ?>
                                <?php echo Html::anchor('ficheros/delete/'.$f->id, '<span class="glyphicon glyphicon-trash"></span> Borrar',array('class'=>'btn btn-danger','onclick'=>"return confirm('¿Estás seguro de querer eliminarlo del sistema?')")); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
                <p><?php echo Html::anchor('ficheros/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo fichero', array('class' => 'btn btn-primary')); ?></p>
                <br/>
                <h4>Cesiones de datos</h4>
                <?php if(empty($cesiones)):?>
                    <p>Aún no se han registrado cesiones de ficheros de datos en el sistema para este cliente.</p>
                <?php else: ?>
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <thead>
                        <tr class="text-center">
                            <td><strong>Cesionario</strong></td>
                            <td><strong>Fichero cesionado</strong></td>
                            <td><strong>Fecha de firma</strong></td>
                            <td>&nbsp;</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($cesiones as $c): ?>
                            <tr>
                                <td><?php echo Model_Cliente::find($c->idcesionaria)->get('nombre'); ?></td>
                                <td><?php echo Model_Tipo_Fichero::find(Model_Fichero::find($c->idfichero)->get('idtipo'))->get('tipo'); ?></td>
                                <td><?php echo date_conv($c->fecha_contrato); ?></td>
                                <td><?php echo Html::anchor('cesiones/view/'.$c->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default','target'=>'_blank','title'=>'Se abre en ventana nueva...')); ?>
                                    <?php echo Html::anchor('cesiones/edit/'.$c->id, '<span class="glyphicon glyphicon-pencil"></span> Editar',array('class'=>'btn btn-success')); ?>
                                    <?php echo Html::anchor('clientes/doc_cesion/'.$cliente->id.'/'.$c->idcesionaria, '<span class="glyphicon glyphicon-file"></span> Vista previa del contrato', array('class' => 'btn btn-info','target'=>'_blank')); ?>
                                    <?php echo Html::anchor('cesiones/delete/'.$c->id, '<span class="glyphicon glyphicon-trash"></span> Borrar cesión',array('class'=>'btn btn-danger','onclick'=>"return confirm('¿Estás seguro de querer eliminarla del sistema?')")); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <p><?php echo Html::anchor('cesiones/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Registrar una nueva cesión', array('class' => 'btn btn-primary')); ?>&nbsp;
                <?php echo Html::anchor('clientes/create/', '<span class="glyphicon glyphicon-plus"></span> Añadir nueva empresa cesionaria', array('target'=>'_blank','title'=>'Se abre en ventana nueva...','class' => 'btn btn-primary')); ?></p>
                <br/>
                <h4>Otras sedes / Empresas del grupo</h4>
                <p>Mostramos a continuación las otras posibles sedes del cliente u otras empresas del mismo grupo empresarial.</p>
                <?php if(!empty($grupossedes)):?>
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <thead>
                        <tr class="text-center">
                            <td><strong>Nombre</strong></td>
                            <td><strong>Tipo</strong></td>
                            <td><strong>Ficheros compartidos</strong></td>
                            <td>&nbsp;</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $tipo_ops = array("Otra sede","Empresa del Grupo");
                            foreach($grupossedes as $g): ?>
                            <tr>
                                <td><?php echo $g->nombre; ?></td>
                                <td><?php echo $tipo_ops[$g->tipo]; ?></td>
                                <td><?php echo $g->ficheros; ?></td>
                                <td><?php echo Html::anchor('gruposedes/view/'.$g->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default','target'=>'_blank','title'=>'Se abre en ventana nueva...')); ?>
                                    <?php echo Html::anchor('gruposedes/edit/'.$g->id, '<span class="glyphicon glyphicon-pencil"></span> Editar',array('class'=>'btn btn-success')); ?>
                                    <?php echo Html::anchor('gruposedes/delete/'.$g->id, '<span class="glyphicon glyphicon-trash"></span> Borrar',array('class'=>'btn btn-danger','onclick'=>"return confirm('¿Estás seguro de querer eliminarla del sistema?')")); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <p><?php echo Html::anchor('gruposedes/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Notificar nueva sede / empresa del grupo', array('class' => 'btn btn-primary')); ?></p>
            </div>
        </div>
    </div>

    <!-- FIFTH PANEL -->
    <div class="panel panel-default" id="panel5">
        <div class="panel-heading">
            <h3 class="panel-title datos_cliente"><span class="muted">
                <a data-toggle="collapse" data-target="#collapseFive" href="#collapseFive" class="collapsed">
                    Certificado Digital / NEOS
                </a></span>
            </h3>
        </div>
        <div id="collapseFive" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Pendiente de rellenar</p>
            </div>
        </div>
    </div>
    <!-- SIXTH PANEL -->
    <div class="panel panel-default" id="panel6">
        <div class="panel-heading">
            <h3 class="panel-title datos_cliente"><span class="muted">
                <a data-toggle="collapse" data-target="#collapseSix" href="#collapseSix" class="collapsed">
                    C.A.E.
                </a></span>
            </h3>
        </div>
        <div id="collapseSix" class="panel-collapse collapse">
            <div class="panel-body">
                <p><?php
                    if($infocae != null){
                        echo "<h4>Información C.A.E.</h4>";
                        if(count($infocae)>1){echo "¡Se han encontrado varias entradas para la misma empresa!. Contacta al administrador.";}
                        ?>
                        <table class="table table-striped table-bordered table-hover table-responsive">
                            <thead>
                                <tr class="text-center">
                                    <td><strong>Listado de instalaciones</strong></td>
                                    <td><strong>Acciones</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $servicios="";
                            foreach($infocae as $info):
                                foreach($info as $i => $v):
                                    if($v==1 and $i!='id' and $i!='idcliente')$servicios=$servicios." // ".$i;
                                endforeach; ?>
                                <tr>
                                    <td><?php echo $servicios; ?></td>
                                    <td><?php echo Html::anchor('infocae/report/'.$info->id, '<span class="glyphicon glyphicon-eye-open"></span> Generar Informe C.A.E.',array('class'=>'btn btn-info','target'=>'_blank','title'=>'Se abre en ventana nueva...')); ?>
                                        <?php echo Html::anchor('infocae/edit/'.$info->id, '<span class="glyphicon glyphicon-pencil"></span> Editar información C.A.E.',array('class'=>'btn btn-success')); ?>
                                        <?php echo Html::anchor('infocae/delete/'.$info->id, '<span class="glyphicon glyphicon-trash"></span> Borrar información C.A.E.',array('class'=>'btn btn-danger','onclick'=>"return confirm('¿Estás seguro de querer eliminar esta información del sistema?')")); ?></td>
                                </tr>

                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php
                    }else{?>
                        <p><?php echo Html::anchor('infocae/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Cuestionario evaluación de riesgos', array('class' => 'btn btn-primary')); ?></p>
                    <?php
                    }
                    echo "<h4>Servicios Externos</h4>";
                        if(count($rel_comconts)>0){
                    ?>
                        <table class="table table-striped table-bordered table-hover table-responsive">
                            <thead>
                                <tr class="text-center">
                                    <td><strong>Servicios externo</strong></td>
                                    <td><strong>Contrata</strong></td>
                                    <td><strong>Email</strong></td>
                                    <td><strong>Fecha informe</strong></td>
                                    <td><strong>Acciones</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $servicios = array("Conserjería","Limpieza","Vigilancia","Socorrista","Seguros","Mantenimientos","Otros");
                                foreach($rel_comconts as $contratas){ ?>
                                <tr><td><?php echo $servicios[$contratas->servicio]; ?></td>
                                    <td><?php echo Model_Cliente::find($contratas->idcontrata)->get('nombre'); ?></td>
                                    <td><?php echo Model_Cliente::find($contratas->idcontrata)->get('email'); ?></td>
                                    <td><?php echo $contratas->fechaenvio; ?></td>
                                    <td><?php echo Html::anchor('rel_comconts/update_date/'.$contratas->id, '<span class="glyphicon glyphicon-calendar"></span> Notificar',array('class'=>'btn btn-info','title'=>'Actualiza la fecha de envío del informe')); ?>
                                    <?php $rel="";echo Html::anchor('rel_comconts/edit/'.$contratas->id, '<span class="glyphicon glyphicon-pencil"></span> Editar',array('class'=>'btn btn-success')); ?>
                                    <?php echo Html::anchor('rel_comconts/delete/'.$contratas->id, '<span class="glyphicon glyphicon-remove-sign"></span> Eliminar',array('class'=>'btn btn-danger','onclick'=>"return confirm('¿Estás seguro de querer eliminar esta relación de contrata del sistema?')")); ?></td></tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } ?>
                <p><?php echo Html::anchor('rel_comconts/create/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo servicio externo', array('class' => 'btn btn-primary')); ?>
                    <?php echo Html::anchor('clientes/create/', '<span class="glyphicon glyphicon-plus"></span> Añadir nueva empresa contrata', array('class' => 'btn btn-danger')); ?></p>
            </div>
        </div>
    </div>
</div>
<br/>
