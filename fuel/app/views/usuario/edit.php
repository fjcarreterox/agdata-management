<h2>Editing <span class='muted'>Usuario</span></h2>
<br>

<?php echo render('usuario/_form'); ?>
<p>
	<?php echo Html::anchor('usuario/view/'.$usuario->id, 'View'); ?> |
	<?php echo Html::anchor('usuario', 'Back'); ?></p>
