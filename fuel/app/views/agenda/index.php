<h2><span class='muted'>Agenda</span> de AGData</h2>
<br>
<?php if ($agendas): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Cliente</th>
			<th>Última llamada</th>
			<th>Próxima llamada</th>
			<th>Última visita</th>
			<th>Próxima visita</th>
			<!--<th>Información enviada por e-mail</th>
			<th>Observaciones</th>-->
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($agendas as $item): ?>
    <tr>
			<td><?php echo Model_Cliente::find($item->idcliente)->get('nombre'); ?></td>
			<td><?php echo $item->last_call; ?></td>
			<td><?php echo $item->next_call; ?></td>
			<td><?php echo $item->last_visit; ?></td>
			<td><?php echo $item->next_visit; ?></td>
			<!--<td><?php /*echo $item->send_info;*/ ?></td>
			<td><?php /*echo $item->observaciones;*/ ?></td>-->
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('agenda/view/'.$item->id, '<i class="icon-eye-open"></i> Ver registro completo', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('agenda/edit/'.$item->id, '<i class="icon-wrench"></i> Editar', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('agenda/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar entrada', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
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
<p><?php echo Html::anchor('agenda/create', 'Crear nuevo registro en la Agenda', array('class' => 'btn btn-success')); ?></p>
