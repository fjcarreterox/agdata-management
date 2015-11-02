<h2>Viewing <span class='muted'>#<?php echo $rel_presserv->id; ?></span></h2>

<p>
	<strong>Idpres:</strong>
	<?php echo $rel_presserv->idpres; ?></p>
<p>
	<strong>Idserv:</strong>
	<?php echo $rel_presserv->idserv; ?></p>
<p>
	<strong>Precio:</strong>
	<?php echo $rel_presserv->precio; ?></p>

<?php echo Html::anchor('rel/presserv/edit/'.$rel_presserv->id, 'Edit'); ?> |
<?php echo Html::anchor('rel/presserv', 'Back'); ?>