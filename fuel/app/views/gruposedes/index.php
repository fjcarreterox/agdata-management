<h2>Listing <span class='muted'>Gruposedes</span></h2>
<br>
<?php if ($gruposedes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Idcliente</th>
			<th>Tipo</th>
			<th>Nombre</th>
			<th>Dir</th>
			<th>Cif</th>
			<th>Ficheros</th>
			<th>Contacto</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($gruposedes as $item): ?>		<tr>

			<td><?php echo $item->idcliente; ?></td>
			<td><?php echo $item->tipo; ?></td>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo $item->dir; ?></td>
			<td><?php echo $item->cif; ?></td>
			<td><?php echo $item->ficheros; ?></td>
			<td><?php echo $item->contacto; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('gruposedes/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('gruposedes/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('gruposedes/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Gruposedes.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('gruposedes/create', 'Add new Gruposede', array('class' => 'btn btn-success')); ?>

</p>
