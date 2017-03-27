<h2><?php echo $title; ?></h2>
<br/>
<?php if ($agendas):
    $tipo_ops = array("-- NO ESPECIFICADO --","visita","llamada","auditoría");
    $subject = 'Servicios AGDATA LOPD 2017';
    $body_aaff = 'A/A.:%0D%0A%0D%0ABuenos días,%0D%0A%0D%0ASegún conversación telefónica, le hacemos llegar información sobre nuestros servicios en materia de Protección de Datos, tanto para su despacho como para sus Comunidades de Propietarios.%0D%0AComo asesores jurídicos del Colegio de Administradores de Fincas, podrán beneficiarse de unas tarifas más económicas orientadas a los Administradores de Fincas colegiados.%0D%0A%0D%0AComo podrá comprobar, Análisis y Gestión de Datos SL, se encarga de actualizarles toda la documentación legal necesaria, de modificar o inscribir en la Agencia Española de Protección de Datos los ficheros de datos que gestione Ud. o la Comunidad de Propietarios, así como del asesoramiento jurídico ante cualquier consulta que puedan plantearle los propietarios en materia de protección de datos.%0D%0A%0D%0ASin otro particular, le instamos a poder ampliarles esta información en una visita personal, para conocer su situación actual, así como aclararle cualquier consulta que le surja.%0D%0A%0D%0AReciba un cordial saludo.%0D%0A%0D%0A ';
    $body_proc = 'A/A.:%0D%0A%0D%0ABuenos días,%0D%0A%0D%0ASegún conversación telefónica, le hacemos llegar información sobre nuestros servicios de asesoramiento en materia de Protección de Datos.%0D%0A%0D%0AComo asesores jurídicos del Ilustre Colegio de Procuradores de Sevilla, podrán beneficiarse de unas tarifas muy económicas y orientadas a los colegiados.%0D%0A%0D%0AComo podrá comprobar, Análisis y Gestión de Datos SL, se encarga de actualizarles toda la documentación legal necesaria, de modificar o inscribir en la Agencia Española de Protección de Datos los ficheros de datos que Ud. gestione, así como del asesoramiento jurídico ante cualquier consulta que puedan plantearle en materia de protección de datos.%0D%0A%0D%0ASin otro particular, le instamos a poder ampliarles esta información en una visita personal, para conocer su situación actual de cumplimiento y poder explicarles nuestra metodología de trabajo.%0D%0A%0D%0AReciba un cordial saludo.%0D%0A%0D%0A ';
    $body_pod = 'A/A.:%0D%0A%0D%0ABuenos días,%0D%0A%0D%0ASegún conversación telefónica, le hacemos llegar información sobre nuestros servicios en materia de Protección de Datos.%0D%0A%0D%0AComo asesores jurídicos del Colegio de Podólogos de Andalucía, podrán beneficiarse de unas tarifas muy económicas orientadas a los profesionales colegiados.%0D%0A%0D%0AComo podrá comprobar, Análisis y Gestión de Datos SL, se encarga de actualizarles toda la documentación legal necesaria, de modificar o inscribir en la Agencia Española de Protección de Datos los ficheros de datos que gestione en su clínica, así como del asesoramiento jurídico ante cualquier consulta que puedan plantearle en materia de protección de datos.%0D%0A%0D%0A”Sin otro particular, le instamos a poder ampliarles esta información cuando lo deseen, para conocer su situación actual, así como aclararle cualquier consulta que le surja.%0D%0A%0D%0AReciba un cordial saludo.%0D%0A%0D%0A ';
    $body = 'A/A.:%0D%0A%0D%0ABuenos días,%0D%0A%0D%0ASegún conversación telefónica, le hacemos llegar información sobre nuestros servicios en materia de Protección de Datos.%0D%0A%0D%0AComo podrá comprobar, Análisis y Gestión de Datos SL, se encarga de actualizarles toda la documentación legal necesaria, de modificar o inscribir en la Agencia Española de Protección de Datos los ficheros de datos que gestione en el desarrollo de su actividad profesional, así como del asesoramiento jurídico ante cualquier consulta que se le puedan plantear en materia de protección de datos.%0D%0A%0D%0AEn cualquier caso, le instamos a poder ampliarles esta información cuando lo deseen, para conocer su situación actual, así como aclararle cualquier consulta que le surja.%0D%0A%0D%0ASin otro particular,%0D%0A%0D%0AReciba un cordial saludo.%0D%0A%0D%0A ';
    ?>
    <p><?php echo $intro;?></p>
    <br/>
    <p><?php
        if($calendar) {
            echo Html::anchor('agenda/calendar', '<span class="glyphicon glyphicon-calendar"></span> Ver calendario de visitas', array('class' => 'btn btn-info'));
        }?>&nbsp;
        <?php echo Html::anchor('agenda/create', '<span class="glyphicon glyphicon-plus"></span> Crear nuevo evento en la Agenda', array('class' => 'btn btn-primary')); ?>
        <?php echo Html::anchor('agenda/create_asunto', '<span class="glyphicon glyphicon-plus"></span> Nuevo asunto particular', array('class' => 'btn btn-primary')); ?></p>
    <br/>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Cliente</th>
            <th>Teléfono</th>
            <th>Fecha y hora</th>
            <th>Asignado a</th>
            <?php if($calendar){
                echo "<th>Estado cliente</th>";
            }
            ?>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($agendas as $item):
            if($item->idcliente != 0){
                $hora=explode(":",$item->hora);
                ?>
                <tr>
                    <td><?php echo Model_Cliente::find($item->idcliente)->get('nombre'); /*Html::anchor('agenda/view_events/'.$item->idcliente,Model_Cliente::find($item->idcliente)->get('nombre'),array('title'=>'Ver eventos sólo de este cliente'));*/ ?></td>
                    <td><?php echo Model_Cliente::find($item->idcliente)->get('tel'); ?></td>
                    <td><?php $dist = abs(strtotime($item->fecha) - strtotime(date('Y-m-d'))) / (60*60*24);
                        if($item->fecha < date('Y-m-d')){
                            echo "<span class='red'>".date_conv($item->fecha)." a las $hora[0]:$hora[1]</span>";
                        }else if( ($item->fecha >= date('Y-m-d')) && $dist<1){
                            echo "<span class='orange'>".date_conv($item->fecha)." a las $hora[0]:$hora[1]</span>";
                        }else{
                            echo date_conv($item->fecha)." a las $hora[0]:$hora[1]";
                        }
                        ?></td>
                    <td><?php
                        $user = Model_Usuario::find($item->iduser);
                        if($user != null){
                            echo $user->user;
                        }else{
                            echo "-- N/A --";
                        }
                        ?></td>
                    <?php if($calendar) {
                        echo "<td>".Model_Estados_Cliente::find(Model_Cliente::find($item->idcliente)->get('estado'))->get('nombre')."</td>";
                    }?>
                    <td>
                        <div class="btn-toolbar">
                            <div class="btn-group">
                                <?php echo Html::anchor('clientes/view/'.$item->idcliente, '<span class="glyphicon glyphicon-eye-open"></span> Ficha Cliente', array('class' => 'btn btn-default')); ?>
                                <?php echo Html::anchor('agenda/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar evento', array('class' => 'btn btn-success')); ?>
                                <?php
                                $tipo = Model_Cliente::find($item->idcliente)->get('tipo');
                                if($tipo ==1){$body=$body_aaff;}
                                elseif($tipo == 7){$body=$body_proc;}
                                elseif($tipo == 4){$body=$body_pod;}
                                echo Html::mail_to(Model_Cliente::find($item->idcliente)->get('email'),'<span class="glyphicon glyphicon-envelope"></span> Enviar Info ',$subject.'&body='.$body , array('class' => 'btn btn-warning')); ?>
                                <?php echo Html::anchor('agenda/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar evento', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
                            </div>
                        </div>

                    </td>
                </tr>
            <?php } endforeach; ?>
        </tbody>
    </table>

<?php else: ?>
    <p>No se han encontrado aún entradas en la Agenda.</p>
<?php endif; ?>

<p><?php echo Html::anchor('agenda/create', '<span class="glyphicon glyphicon-plus"></span> Crear nuevo evento en la Agenda', array('class' => 'btn btn-primary')); ?>&nbsp;&nbsp;
    <?php if($calendar){
        echo Html::anchor('agenda/calendar', '<span class="glyphicon glyphicon-calendar"></span> Ver calendario de visitas', array('class' => 'btn btn-info'))."&nbsp;&nbsp;";
        echo Html::anchor('agenda/llamadas_comerciales', '<span class="glyphicon glyphicon-eye-open"></span> Ver listado de llamadas', array('class' => 'btn btn-default'));
    }
    else{
        echo Html::anchor('agenda', '<span class="glyphicon glyphicon-eye-open"></span> Ver listado de visitas', array('class' => 'btn btn-default'));
    }?></p>
<br/>
<!-- For uncategorized events -->
<?php if (count($void)>0):
    $tipo_ops = array("-- NO ESPECIFICADO --","visita","llamada");
    ?>
    <h3>Eventos no categorizados</h3>
    <p>Se han detectado los siguientes eventos sin categorizar. Por favor, edítalos y establece si son <strong>
            visitas o llamadas.</strong></p>
    <br/>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Cliente</th>
            <th>Tipo</th>
            <th>Fecha y hora</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($void as $v): ?>
            <tr>
                <td><?php echo $v->idcliente; ?></td>
                <td><?php /*echo Html::anchor('clientes/view/'.$v->idcliente,Model_Cliente::find($v->idcliente)->get('nombre'),array('target'=>'_blank','title'=>'Ir a la ficha del cliente (se abre en ventana nueva)'));*/ ?></td>
                <td><?php echo $tipo_ops[$v->tipo]; ?></td>
                <td><?php echo date_conv($v->fecha)." a las ".$v->hora; ?></td>
                <td>
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <?php echo Html::anchor('agenda/view/'.$v->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
                            <?php echo Html::anchor('agenda/edit/'.$v->id, '<span class="glyphicon glyphicon-pencil"></span> Editar evento', array('class' => 'btn btn-success')); ?>
                            <?php echo Html::anchor('agenda/delete/'.$v->id, '<span class="glyphicon glyphicon-trash"></span> Borrar evento', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>