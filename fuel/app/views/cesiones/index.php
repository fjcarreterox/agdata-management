<h2>Listing <span class='muted'>Cesiones</span></h2>
<br>
<?php if ($cesiones): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Idcliente</th>
			<th>Idtipo empresa</th>
			<th>Nombre</th>
			<th>Cifnif</th>
			<th>Servicio</th>
			<th>Rep legal name</th>
			<th>Rep legal dni</th>
			<th>Rep legal cargo</th>
			<th>Tel</th>
			<th>Domicilio</th>
			<th>Localidad</th>
			<th>Cp</th>
			<th>Fecha contrato</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($cesiones as $item): ?>		<tr>

			<td><?php echo $item->idcliente; ?></td>
			<td><?php echo $item->idtipo_empresa; ?></td>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo $item->cifnif; ?></td>
			<td><?php echo $item->servicio; ?></td>
			<td><?php echo $item->rep_legal_name; ?></td>
			<td><?php echo $item->rep_legal_dni; ?></td>
			<td><?php echo $item->rep_legal_cargo; ?></td>
			<td><?php echo $item->tel; ?></td>
			<td><?php echo $item->domicilio; ?></td>
			<td><?php echo $item->localidad; ?></td>
			<td><?php echo $item->cp; ?></td>
			<td><?php echo $item->fecha_contrato; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('cesiones/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('cesiones/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('cesiones/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Cesiones.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('cesiones/create', 'Add new Cesione', array('class' => 'btn btn-success')); ?>

</p>
