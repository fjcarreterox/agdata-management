<h2>Listing <span class='muted'>Fichas</span></h2>
<br>
<?php if ($fichas): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Idcliente</th>
			<th>Movil contacto</th>
			<th>Email contacto</th>
			<th>Otras sedes</th>
			<th>Num trabajadores</th>
			<th>Num equipos</th>
			<th>Fecha bienvenida</th>
			<th>Fecha auditoria</th>
			<th>Iban</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($fichas as $item): ?>		<tr>

			<td><?php echo $item->idcliente; ?></td>
			<td><?php echo $item->movil_contacto; ?></td>
			<td><?php echo $item->email_contacto; ?></td>
			<td><?php echo $item->otras_sedes; ?></td>
			<td><?php echo $item->num_trabajadores; ?></td>
			<td><?php echo $item->num_equipos; ?></td>
			<td><?php echo $item->fecha_bienvenida; ?></td>
			<td><?php echo $item->fecha_auditoria; ?></td>
			<td><?php echo $item->iban; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('ficha/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('ficha/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('ficha/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>
<?php else: ?>
<p>No Fichas.</p>
<?php endif; ?><p>
	<?php echo Html::anchor('ficha/create', 'Add new Ficha', array('class' => 'btn btn-success')); ?>
</p>