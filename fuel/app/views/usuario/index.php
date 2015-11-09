<h2><span class='muted'>Usuarios</span> existentes en el sistema</h2>
<br>
<?php if ($usuarios): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre de usuario</th>
			<th>Nombre completo</th>
			<th>Correo electrónico</th>
			<th>Rol asociado</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($usuarios as $item): ?>
        <tr>
			<td><?php echo $item->user; ?></td>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo $item->email; ?></td>
			<td><?php echo Model_Role::find($item->role)->get('rol'); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
                        <?php echo Html::anchor('usuario/new_pass/'.$item->id, '<span class="glyphicon glyphicon-lock"></span> Cambiar contraseña', array('class' => 'btn btn-info right-separator')); ?>
                        <?php echo Html::anchor('usuario/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('usuario/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
    <p>No se han encontrado Usuarios en el sistema.</p>
<?php endif; ?>
    <p><?php echo Html::anchor('usuario/create', '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo usuario', array('class' => 'btn btn-success')); ?></p>