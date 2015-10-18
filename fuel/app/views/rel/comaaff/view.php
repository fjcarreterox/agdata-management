<h2>Viewing <span class='muted'>#<?php echo $rel_comaaff->id; ?></span></h2>

<p>
	<strong>Idcom:</strong>
	<?php echo $rel_comaaff->idcom; ?></p>
<p>
	<strong>Idaaff:</strong>
	<?php echo $rel_comaaff->idaaff; ?></p>

<?php echo Html::anchor('rel/comaaff/edit/'.$rel_comaaff->id, 'Edit'); ?> |
<?php echo Html::anchor('rel/comaaff', 'Back'); ?>