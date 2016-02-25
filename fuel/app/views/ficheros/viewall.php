<h2>Listado de de ficheros de <span class='muted'><?php echo $cliente; ?></span></h2>
<br/>
<?php if ($ficheros): ?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th>Tipo de fichero</th>
			<th>Inscrito en la AEPD</th>
			<th>Fecha de inscripción</th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($ficheros as $item): ?>
			<tr>
				<td><?php echo Model_Tipo_Fichero::find($item->idtipo)->get('tipo'); ?></td>
				<td><?php if($item->inscrito){echo "SÍ";}else{echo "NO";}; ?></td>
				<td><?php echo date_conv($item->fecha); ?></td>
				<td>
					<div class="btn-toolbar">
						<div class="btn-group">
							<?php echo Html::anchor('ficheros/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
							<?php echo Html::anchor('ficheros/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
							<?php echo Html::anchor('ficheros/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer eliminarlo?')")); ?>
						</div>
					</div>

				</td>
			</tr>
		<?php endforeach; ?>	</tbody>
	</table>
<?php else: ?>
	<p>No se han encontrado aún ficheros registrados en el sistema.</p>
<?php endif; ?>
