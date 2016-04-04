<h2>Listing <span class='muted'>Rel_estructuras</span></h2>
<br>
<?php if ($rel_estructuras): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Idfichero</th>
			<th>Idtipodato</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($rel_estructuras as $item): ?>		<tr>

			<td><?php echo $item->idfichero; ?></td>
			<td><?php echo $item->idtipodato; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('rel/estructura/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('rel/estructura/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('rel/estructura/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Rel_estructuras.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('rel/estructura/create', 'Add new Rel estructura', array('class' => 'btn btn-success')); ?>

</p>
