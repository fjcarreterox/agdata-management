<h2>Editing <span class='muted'>Fichero</span></h2>
<br>

<?php echo render('ficheros/_form'); ?>
<p>
	<?php echo Html::anchor('ficheros/view/'.$fichero->id, 'View'); ?> |
	<?php echo Html::anchor('ficheros', 'Back'); ?></p>
