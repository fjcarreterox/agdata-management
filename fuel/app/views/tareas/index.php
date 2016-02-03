<h2>Listing <span class='muted'>Tareas</span></h2>
<br>
<?php if ($tareas): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Idcliente</th>
			<th>Idtipotarea</th>
			<th>Fecha</th>
			<th>Fecha respuesta</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($tareas as $item): ?>		<tr>

			<td><?php echo $item->idcliente; ?></td>
			<td><?php echo $item->idtipotarea; ?></td>
			<td><?php echo $item->fecha; ?></td>
			<td><?php echo $item->fecha_respuesta; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('tareas/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('tareas/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('tareas/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Tareas.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('tareas/create', 'Add new Tarea', array('class' => 'btn btn-success')); ?>

</p>
