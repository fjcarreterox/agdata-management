<h2>Editing <span class='muted'>Cesione</span></h2>
<br>

<?php echo render('cesiones/_form'); ?>
<p>
	<?php echo Html::anchor('cesiones/view/'.$cesione->id, 'View'); ?> |
	<?php echo Html::anchor('cesiones', 'Back'); ?></p>
