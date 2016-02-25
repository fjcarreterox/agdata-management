<h2>Listado con todos los <span class='muted'>ficheros no inscritos</span></h2>
<br/>
<?php if ($ficheros): ?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th>Cliente</th>
			<th>CIF/NIF</th>
			<th>Tipo de fichero</th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($ficheros as $item): ?>
			<tr>
				<td><?php echo Model_Cliente::find($item->idcliente)->get('nombre'); ?></td>
				<td><?php echo Model_Cliente::find($item->idcliente)->get('cif_nif'); ?></td>
				<td><?php echo Model_Tipo_Fichero::find($item->idtipo)->get('tipo'); ?></td>

				<td>
					<div class="btn-toolbar">
						<div class="btn-group">
							<?php echo Html::anchor('ficheros/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
							<?php echo Html::anchor('ficheros/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
							<?php echo Html::anchor('ficheros/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer eliminarlo?')")); ?>
							<?php echo Html::anchor('clientes/view/'.$item->idcliente, '<span class="glyphicon glyphicon-eye-open"></span> Ficha cliente', array('class' => 'btn btn-default')); ?>
						</div>
					</div>

				</td>
			</tr>
		<?php endforeach; ?>	</tbody>
	</table>
<?php else: ?>
	<p>No se han encontrado aún ficheros registrados en el sistema.</p>
<?php endif; ?>
