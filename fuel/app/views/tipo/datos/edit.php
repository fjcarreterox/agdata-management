<h2>Editing <span class='muted'>Tipo_dato</span></h2>
<br>

<?php echo render('tipo/datos/_form'); ?>
<p>
	<?php echo Html::anchor('tipo/datos/view/'.$tipo_dato->id, 'View'); ?> |
	<?php echo Html::anchor('tipo/datos', 'Back'); ?></p>
