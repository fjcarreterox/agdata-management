<h2>Editing <span class='muted'>Tarea</span></h2>
<br>

<?php echo render('tareas/_form'); ?>
<p>
	<?php echo Html::anchor('tareas/view/'.$tarea->id, 'View'); ?> |
	<?php echo Html::anchor('tareas', 'Back'); ?></p>
