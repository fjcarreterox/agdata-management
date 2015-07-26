<h2>Listing <span class='muted'>Usuarios</span></h2>
<br>
<?php if ($usuarios): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Password</th>
			<th>Email</th>
			<th>Role</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($usuarios as $item): ?>		<tr>

			<td><?php echo $item->nombre; ?></td>
			<td><?php echo $item->password; ?></td>
			<td><?php echo $item->email; ?></td>
			<td><?php echo $item->role; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('usuario/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('usuario/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('usuario/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Usuarios.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('usuario/create', 'Add new Usuario', array('class' => 'btn btn-success')); ?>

</p>
