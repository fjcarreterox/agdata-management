<h2><span class='muted'>Usuarios</span> existentes en el sistema</h2>
<br>
<?php if ($usuarios): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Correo electrónico</th>
			<th>Rol asociado</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($usuarios as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo $item->email; ?></td>
			<td><?php echo Model_Role::find($item->role)->get('rol'); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('usuario/view/'.$item->id, '<i class="icon-eye-open"></i> Ver ficha', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('usuario/view/'.$item->id, '<i class="icon-eye-open"></i> Cambiar contraseña', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('usuario/edit/'.$item->id, '<i class="icon-wrench"></i> Editar', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('usuario/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Usuarios.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('usuario/create', 'Añadir un nuevo usuario', array('class' => 'btn btn-success')); ?>

</p>
