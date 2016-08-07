<h2>Viewing <span class='muted'>#<?php echo $factura->id; ?></span></h2>

<p>
	<strong>Num fact:</strong>
	<?php echo $factura->num_fact; ?></p>
<p>
	<strong>Idsc:</strong>
	<?php echo $factura->idsc; ?></p>
<p>
	<strong>Mes cobro:</strong>
	<?php echo $factura->mes_cobro; ?></p>
<p>
	<strong>Anyo cobro:</strong>
	<?php echo $factura->anyo_cobro; ?></p>
<p>
	<strong>Estado:</strong>
	<?php echo $factura->estado; ?></p>

<?php echo Html::anchor('facturas/edit/'.$factura->id, 'Edit'); ?> |
<?php echo Html::anchor('facturas', 'Back'); ?>