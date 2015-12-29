<h2><?php echo $title; ?></h2>
<br/>
<?php if ($agendas):
    $tipo_ops = array("-- NO ESPECIFICADO --","visita","llamada","auditoría");
    ?>
    <p>El siguiente listado se encuentra ordenado por la <strong>fecha y hora</strong> para poder gestionar
        cómodamente la agenda diaria y los eventos (llamadas, visitas) que están pendientes de producirse.</p>
    <!--<p>Se mostrarán en <span class="red">color rojo</span> aquellas llamadas cuya fecha de próxima llamada ya <u>ha pasado</u> y en <span class="orange">naranja</span> las que estén a <u>menos de una semana</u> de producirse.</p>-->
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
<?php foreach ($agendas as $item): ?>
    <tr>
			<td><?php echo Html::anchor('agenda/view_events/'.$item->idcliente,Model_Cliente::find($item->idcliente)->get('nombre'),array('title'=>'Ver eventos sólo de este cliente')); ?></td>
			<!--<td><?php /*echo date_conv($item->last_call);*/ ?></td>-->
			<!--<td><?php /*$dist = abs(strtotime($item->next_call) - strtotime(date('Y-m-d'))) / (60*60*24);
                if($item->next_call < date('Y-m-d')){
                    echo "<span class='red'>".date_conv($item->next_call)."</span>";
                }else if( ($item->next_call >= date('Y-m-d')) && $dist<8){
                    echo "<span class='orange'>".date_conv($item->next_call)."</span>";
                }else{
                    echo date_conv($item->next_call);
                }*/
                 ?></td>-->
            <td><?php echo $tipo_ops[$item->tipo]; ?></td>
            <td><?php echo date_conv($item->fecha)." a las ".$item->hora; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('agenda/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('agenda/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar evento', array('class' => 'btn btn-success')); ?>
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

<p><?php echo Html::anchor('agenda/create', '<span class="glyphicon glyphicon-plus"></span> Crear nuevo evento en la Agenda', array('class' => 'btn btn-primary')); ?>&nbsp;&nbsp;
    <?php if($calendar){
        echo Html::anchor('agenda/calendar', '<span class="glyphicon glyphicon-calendar"></span> Ver calendario de visitas', array('class' => 'btn btn-info'))."&nbsp;&nbsp;";
        echo Html::anchor('agenda/llamadas', '<span class="glyphicon glyphicon-eye-open"></span> Ver listado de llamadas', array('class' => 'btn btn-default'));
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