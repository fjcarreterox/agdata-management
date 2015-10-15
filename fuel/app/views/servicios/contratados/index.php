<h2>Listing <span class='muted'>Servicios_contratados</span></h2>
<br>
<?php if ($servicios_contratados): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Idcliente</th>
			<th>Idtipo servicio</th>
			<th>Importe</th>
			<th>Year</th>
			<th>Mes factura</th>
			<th>Periodicidad</th>
			<th>Cuota</th>
			<th>Forma pago</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($servicios_contratados as $item): ?>		<tr>

			<td><?php echo $item->idcliente; ?></td>
			<td><?php echo $item->idtipo_servicio; ?></td>
			<td><?php echo $item->importe; ?></td>
			<td><?php echo $item->year; ?></td>
			<td><?php echo $item->mes_factura; ?></td>
			<td><?php echo $item->periodicidad; ?></td>
			<td><?php echo $item->cuota; ?></td>
			<td><?php echo $item->forma_pago; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('servicios/contratados/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('servicios/contratados/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('servicios/contratados/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Servicios_contratados.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('servicios/contratados/create', 'Add new Servicios contratado', array('class' => 'btn btn-success')); ?>

</p>
