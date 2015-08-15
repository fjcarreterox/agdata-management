<h2>Listado del <span class='muted'>Personal</span> asociado al cliente <?php echo $nombre_cliente; ?></h2>
<br/>
<?php if ($personal): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre completo</th>
			<th>DNI</th>
			<th>Cargo / Función</th>
			<th>Relación con nosotros</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($personal as $item): ?>
    <tr>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo $item->dni; ?></td>
			<td><?php echo $item->cargofuncion; ?></td>
			<td><?php echo Model_Relacion::find($item->relacion)->get('nombre'); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('personal/view/'.$item->id, '<i class="icon-eye-open"></i> Ver datos', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('personal/edit/'.$item->id, '<i class="icon-wrench"></i> Editar', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('personal/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer borrarlo?')")); ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<p>No se han encontrado aún trabajadores registrados de ningún tipo.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('personal/create', 'Añadir nuevo trabajador para este cliente', array('class' => 'btn btn-success')); ?>

</p>
