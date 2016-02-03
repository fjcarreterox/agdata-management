<h2>Viewing <span class='muted'>#<?php echo $tarea->id; ?></span></h2>

<p>
	<strong>Idcliente:</strong>
	<?php echo $tarea->idcliente; ?></p>
<p>
	<strong>Idtipotarea:</strong>
	<?php echo $tarea->idtipotarea; ?></p>
<p>
	<strong>Fecha:</strong>
	<?php echo $tarea->fecha; ?></p>
<p>
	<strong>Fecha respuesta:</strong>
	<?php echo $tarea->fecha_respuesta; ?></p>

<?php echo Html::anchor('tareas/edit/'.$tarea->id, 'Edit'); ?> |
<?php echo Html::anchor('tareas', 'Back'); ?>