<h2>Listing <span class='muted'>Rel_presservs</span></h2>
<br>
<?php if ($rel_presservs): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Idpres</th>
			<th>Idserv</th>
			<th>Precio</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($rel_presservs as $item): ?>		<tr>

			<td><?php echo $item->idpres; ?></td>
			<td><?php echo $item->idserv; ?></td>
			<td><?php echo $item->precio; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('rel/presserv/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('rel/presserv/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('rel/presserv/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Rel_presservs.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('rel/presserv/create', 'Add new Rel presserv', array('class' => 'btn btn-success')); ?>

</p>
