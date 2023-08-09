<h2>Listing <span class='muted'>Rel_comconts</span></h2>
<br>
<?php if ($rel_comconts): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Idcom</th>
			<th>Idcontrata</th>
			<th>Servicio</th>
			<th>Fechaenvio</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($rel_comconts as $item): ?>		<tr>

			<td><?php echo $item->idcom; ?></td>
			<td><?php echo $item->idcontrata; ?></td>
			<td><?php echo $item->servicio; ?></td>
			<td><?php echo $item->fechaenvio; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('rel/comconts/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('rel/comconts/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('rel/comconts/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Rel_comconts.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('rel/comconts/create', 'Add new Rel comcont', array('class' => 'btn btn-success')); ?>

</p>
