<h2>Viewing <span class='muted'>#<?php echo $tipo_tarea->id; ?></span></h2>

<p>
	<strong>Nombre:</strong>
	<?php echo $tipo_tarea->nombre; ?></p>
<p>
	<strong>Descripcion:</strong>
	<?php echo $tipo_tarea->descripcion; ?></p>
<p>
	<strong>Tipo:</strong>
	<?php echo $tipo_tarea->tipo; ?></p>

<?php echo Html::anchor('tipo/tarea/edit/'.$tipo_tarea->id, 'Edit'); ?> |
<?php echo Html::anchor('tipo/tarea', 'Back'); ?>