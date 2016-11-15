<h2>Listing <span class='muted'>Qevents</span></h2>
<br>
<?php if ($qevents): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Type</th>
			<th>Target audience</th>
			<th>Date time</th>
			<th>Location</th>
			<th>Broadcast</th>
			<th>Resources</th>
			<th>Complementary services</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($qevents as $item): ?>		<tr>

			<td><?php echo $item->type; ?></td>
			<td><?php echo $item->target_audience; ?></td>
			<td><?php echo $item->date_time; ?></td>
			<td><?php echo $item->location; ?></td>
			<td><?php echo $item->broadcast; ?></td>
			<td><?php echo $item->resources; ?></td>
			<td><?php echo $item->complementary_services; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('qevents/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('qevents/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('qevents/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Qevents.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('qevents/create', 'Add new Qevent', array('class' => 'btn btn-success')); ?>

</p>
