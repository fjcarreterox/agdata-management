<h2><?php echo $title; ?></h2>
<br/>
<?php
$tipo_ops = array("-- NO ESPECIFICADO --","visita","llamada","auditoría");
if ($agendas):
    $tipo_ops = array("-- NO ESPECIFICADO --","visita","llamada","auditoría");
    $subject = 'Servicios AGDATA LOPD 2016';
    $body_aaff = 'A/A.:_______%0D%0A%0D%0ABuenos días,%0D%0A%0D%0ASegún conversación telefónica, le hacemos llegar información sobre nuestros servicios en materia de Protección de Datos, tanto para su despacho como para sus Comunidades de Propietarios.%0D%0A%0D%0AComo podrá comprobar, Análisis y Gestión de Datos SL, se encarga de actualizarles toda la documentación legal necesaria, de modificar o inscribir en la Agencia Española de Protección de Datos los ficheros de datos que gestione Ud. o la Comunidad de Propietarios, así como del asesoramiento jurídico ante cualquier consulta que puedan plantearle los propietarios en materia de protección de datos.%0D%0A%0D%0AComo asesores jurídicos del Colegio de Administradores de Fincas, le instamos a poder ampliarles esta información en una visita personal, para conocer su situación actual, así como aclararle cualquier consulta que tenga.%0D%0A%0D%0ASin otro particular,%0D%0A%0D%0AReciba un cordial saludo.%0D%0A%0D%0A ';
    $body = 'A/A.:_______%0D%0A%0D%0ABuenos días,%0D%0A%0D%0ASegún conversación telefónica, le hacemos llegar información sobre nuestros servicios en materia de Protección de Datos.%0D%0A%0D%0AComo podrá comprobar, Análisis y Gestión de Datos SL, se encarga de actualizarles toda la documentación legal necesaria, de modificar o inscribir en la Agencia Española de Protección de Datos los ficheros de datos que gestione en el desarrollo de su actividad profesional, así como del asesoramiento jurídico ante cualquier consulta que se le puedan plantear en materia de protección de datos.%0D%0A%0D%0AEn cualquier caso, le instamos a poder ampliarles esta información en una visita personal, para conocer su situación actual, así como aclararle cualquier consulta que tenga.%0D%0A%0D%0ASin otro particular,%0D%0A%0D%0AReciba un cordial saludo.%0D%0A%0D%0A ';
    ?>
    <p><?php echo $intro;?></p>
    <br/>
    <p><?php
        if($calendar) {
            echo Html::anchor('agenda/calendar', '<span class="glyphicon glyphicon-calendar"></span> Ver calendario de visitas', array('class' => 'btn btn-info'));
        }?>&nbsp;
        <?php echo Html::anchor('agenda/create_activo', '<span class="glyphicon glyphicon-plus"></span> Crear nuevo evento en la Agenda', array('class' => 'btn btn-primary')); ?></p>
    <br/>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Cliente</th>
            <th>Tipo evento</th>
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
            $hora=explode(":",$item->hora);
            ?>
            <tr>
                <td><?php echo Model_Cliente::find($item->idcliente)->get('nombre');
                    /*Html::anchor('agenda/view_events/'.$item->idcliente,Model_Cliente::find($item->idcliente)->get('nombre'),array('title'=>'Ver eventos sólo de este cliente'));*/ ?></td>
                <td><?php echo $tipo_ops[$item->tipo]; ?></td>
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
                            /*$tipo = Model_Cliente::find($item->idcliente)->get('tipo');
                            if($tipo ==1){$body=$body_aaff;}
                            echo Html::mail_to(Model_Cliente::find($item->idcliente)->get('email'),'<span class="glyphicon glyphicon-envelope"></span> Enviar Info ',$subject.'&body='.$body , array('class' => 'btn btn-warning'));*/ ?>
                            <?php echo Html::anchor('agenda/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar evento', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php else: ?>
    <p>No se han encontrado aún entradas en la Agenda.</p>
<?php endif; ?>

<p><?php echo Html::anchor('agenda/create_activo', '<span class="glyphicon glyphicon-plus"></span> Crear nuevo evento en la Agenda', array('class' => 'btn btn-primary')); ?>&nbsp;&nbsp;
    <?php if($calendar){
        echo Html::anchor('agenda/calendar', '<span class="glyphicon glyphicon-calendar"></span> Ver calendario de visitas', array('class' => 'btn btn-info'))."&nbsp;&nbsp;";
    }
?></p>
<br/>
<!-- For uncategorized events -->
<?php if (count($void)>0):
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
                <td><?php echo Html::anchor('clientes/view/'.$v->idcliente,Model_Cliente::find($v->idcliente)->get('nombre'),array('target'=>'_blank','title'=>'Ir a la ficha del cliente (se abre en ventana nueva)')); ?></td>
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