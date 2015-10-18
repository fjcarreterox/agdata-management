<h2>Listing <span class='muted'>Rel_comaaffs</span></h2>
<br>
<?php if ($rel_comaaffs): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Idcom</th>
			<th>Idaaff</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($rel_comaaffs as $item): ?>		<tr>

			<td><?php echo $item->idcom; ?></td>
			<td><?php echo $item->idaaff; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('rel/comaaff/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('rel/comaaff/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('rel/comaaff/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Rel_comaaffs.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('rel/comaaff/create', 'Add new Rel comaaff', array('class' => 'btn btn-success')); ?>

</p>
