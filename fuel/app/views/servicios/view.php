<h2>Detalle del <span class='muted'>servicio</span> ofrecido:</h2>
<p>
	<strong>Nombre:</strong>
	<?php echo $servicio->nombre; ?></p>
<?php echo Html::anchor('servicios/edit/'.$servicio->id, 'Editar nombre'); ?> |
<?php echo Html::anchor('servicios', 'Volver'); ?>