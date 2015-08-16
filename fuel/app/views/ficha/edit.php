<h2>Editing <span class='muted'>Ficha</span></h2>
<br>

<?php echo render('ficha/_form'); ?>
<p>
	<?php echo Html::anchor('ficha/view/'.$ficha->id, 'View'); ?> |
	<?php echo Html::anchor('ficha', 'Back'); ?></p>
