<h2>Viewing <span class='muted'>#<?php echo $tipo_dato->id; ?></span></h2>

<p>
	<strong>Nombre:</strong>
	<?php echo $tipo_dato->nombre; ?></p>
<p>
	<strong>Tipo:</strong>
	<?php echo $tipo_dato->tipo; ?></p>
<p>
	<strong>Nivel:</strong>
	<?php echo $tipo_dato->nivel; ?></p>

<?php echo Html::anchor('tipo/datos/edit/'.$tipo_dato->id, 'Edit'); ?> |
<?php echo Html::anchor('tipo/datos', 'Back'); ?>