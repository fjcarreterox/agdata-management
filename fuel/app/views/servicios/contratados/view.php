<h2>Viewing <span class='muted'>#<?php echo $servicios_contratado->id; ?></span></h2>

<p>
	<strong>Idcliente:</strong>
	<?php echo $servicios_contratado->idcliente; ?></p>
<p>
	<strong>Idtipo servicio:</strong>
	<?php echo $servicios_contratado->idtipo_servicio; ?></p>
<p>
	<strong>Importe:</strong>
	<?php echo $servicios_contratado->importe; ?></p>
<p>
	<strong>Year:</strong>
	<?php echo $servicios_contratado->year; ?></p>
<p>
	<strong>Mes factura:</strong>
	<?php echo $servicios_contratado->mes_factura; ?></p>
<p>
	<strong>Periodicidad:</strong>
	<?php echo $servicios_contratado->periodicidad; ?></p>
<p>
	<strong>Cuota:</strong>
	<?php echo $servicios_contratado->cuota; ?></p>
<p>
	<strong>Forma pago:</strong>
	<?php echo $servicios_contratado->forma_pago; ?></p>

<?php echo Html::anchor('servicios/contratados/edit/'.$servicios_contratado->id, 'Edit'); ?> |
<?php echo Html::anchor('servicios/contratados', 'Back'); ?>