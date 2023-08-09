<h2>Viewing <span class='muted'>#<?php echo $rel_comcont->id; ?></span></h2>

<p>
	<strong>Idcom:</strong>
	<?php echo $rel_comcont->idcom; ?></p>
<p>
	<strong>Idcontrata:</strong>
	<?php echo $rel_comcont->idcontrata; ?></p>
<p>
	<strong>Servicio:</strong>
	<?php echo $rel_comcont->servicio; ?></p>
<p>
	<strong>Fechaenvio:</strong>
	<?php echo $rel_comcont->fechaenvio; ?></p>

<?php echo Html::anchor('rel/comconts/edit/'.$rel_comcont->id, 'Edit'); ?> |
<?php echo Html::anchor('rel/comconts', 'Back'); ?>