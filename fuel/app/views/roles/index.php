<h2>Listado de <span class='muted'>roles</span> del sistema</h2>
<br/>
<p>Dado que eliminar el rol de <b>administrador</b> puede provocar que la aplicación no se comporte de la manera esperada,
    se ha deshabilitado la acción de borrado de roles.</p>
<?php if ($roles): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre del rol en el sistema</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($roles as $item): ?>
        <tr>
			<td><?php echo $item->rol; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('roles/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span>  Detalle', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('roles/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span>  Editar', array('class' => 'btn btn-success')); ?>
                        <?php /*echo Html::anchor('roles/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span>  Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')"));*/ ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p>No se han definido aún roles en el sistema.</p>
<?php endif; ?>
    <p><?php echo Html::anchor('roles/create', '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo rol', array('class' => 'btn btn-success')); ?></p>