<h2>Gestión de <span class='muted'>llamadas y visitas</span></h2>
<br/>
<?php if ($agendas): ?>
    <p>El siguiente listado se encuentra ordenado por la <strong>fecha de la próxima llamada</strong> para poder gestionar cómodamente
    la agenda diaria y las llamadas que están pendientes de ser realizadas.</p>
    <p>Se mostrarán en <span class="red">color rojo</span> aquellas llamadas cuya fecha de próxima llamada ya <u>ha pasado</u> y en <span class="orange">naranja</span> las que estén a <u>menos de una semana</u> de producirse.</p>
<br/>
    <table class="table table-striped">
	<thead>
		<tr>
			<th>Cliente</th>
			<th>Última llamada</th>
			<th>Próxima llamada</th>
			<th>Última visita</th>
			<th>Próxima visita</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($agendas as $item): ?>
    <tr>
			<td><?php echo Html::anchor('clientes/view/'.$item->idcliente,Model_Cliente::find($item->idcliente)->get('nombre'),array('target'=>'_blank','title'=>'Ir a la ficha del cliente (se abre en ventana nueva)')); ?></td>
			<td><?php echo date_conv($item->last_call); ?></td>
			<td><?php $dist = abs(strtotime($item->next_call) - strtotime(date('Y-m-d'))) / (60*60*24);
                if($item->next_call < date('Y-m-d')){
                    echo "<span class='red'>".date_conv($item->next_call)."</span>";
                }else if( ($item->next_call >= date('Y-m-d')) && $dist<8){
                    echo "<span class='orange'>".date_conv($item->next_call)."</span>";
                }else{
                    echo date_conv($item->next_call);
                }
                 ?></td>
			<td><?php echo date_conv($item->last_visit); ?></td>
			<td><?php echo date_conv($item->next_visit); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('agenda/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Registro completo', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('agenda/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('agenda/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar entrada', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
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
<p><?php echo Html::anchor('agenda/create', '<span class="glyphicon glyphicon-plus"></span> Crear nuevo registro en la Agenda', array('class' => 'btn btn-success')); ?></p>