<h2>Listing <span class='muted'>Adaptacions</span></h2>
<br>
<?php if ($adaptacions): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Idcliente</th>
			<th>Num serv</th>
			<th>Num pc</th>
			<th>Num pc online</th>
			<th>Num laptop</th>
			<th>Num laptop online</th>
			<th>Pass freq</th>
			<th>Backup freq</th>
			<th>Management sw</th>
			<th>Access control</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($adaptacions as $item): ?>		<tr>

			<td><?php echo $item->idcliente; ?></td>
			<td><?php echo $item->num_serv; ?></td>
			<td><?php echo $item->num_pc; ?></td>
			<td><?php echo $item->num_pc_online; ?></td>
			<td><?php echo $item->num_laptop; ?></td>
			<td><?php echo $item->num_laptop_online; ?></td>
			<td><?php echo $item->pass_freq; ?></td>
			<td><?php echo $item->backup_freq; ?></td>
			<td><?php echo $item->management_sw; ?></td>
			<td><?php echo $item->access_control; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('adaptacion/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('adaptacion/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('adaptacion/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Adaptacions.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('adaptacion/create', 'Add new Adaptacion', array('class' => 'btn btn-success')); ?>

</p>
