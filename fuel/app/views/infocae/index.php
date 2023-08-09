<h2>Listado de <span class='muted'>Información C.A.E.</span></h2>
<br>
<?php if ($infocaes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Idcliente</th>
			<th>Portal</th>
			<th>Azotea</th>
			<th>Escaleras</th>
			<th>Sotano</th>
			<th>Contadoresluz</th>
			<th>Bajatension</th>
			<th>Equipospresion</th>
			<th>Contadoresagua</th>
			<th>Incendios</th>
			<th>Garaje</th>
			<th>Ascensores</th>
			<th>Calderas</th>
			<th>Pistas</th>
			<th>Piscina</th>
			<th>Aseopiscina</th>
			<th>Jardines</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($infocaes as $item): ?>		<tr>

			<td><?php echo $item->idcliente; ?></td>
			<td><?php echo $item->portal; ?></td>
			<td><?php echo $item->azotea; ?></td>
			<td><?php echo $item->escaleras; ?></td>
			<td><?php echo $item->sotano; ?></td>
			<td><?php echo $item->contadoresluz; ?></td>
			<td><?php echo $item->bajatension; ?></td>
			<td><?php echo $item->equipospresion; ?></td>
			<td><?php echo $item->contadoresagua; ?></td>
			<td><?php echo $item->incendios; ?></td>
			<td><?php echo $item->garaje; ?></td>
			<td><?php echo $item->ascensores; ?></td>
			<td><?php echo $item->calderas; ?></td>
			<td><?php echo $item->pistas; ?></td>
			<td><?php echo $item->piscina; ?></td>
			<td><?php echo $item->aseopiscina; ?></td>
			<td><?php echo $item->jardines; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('infocae/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('infocae/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('infocae/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No se han encontrado datos relacionados con C.A.E. para ser mostrados.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('/', 'Volver al menú principal', array('class' => 'btn btn-success')); ?>
</p>
