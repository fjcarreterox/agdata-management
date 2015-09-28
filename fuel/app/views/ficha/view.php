<h2>Mostrando <span class='muted'>datos específicos</span> del cliente seleccionado:</h2>

<p>
	<strong>Idcliente:</strong>
	<?php echo $ficha->idcliente; ?></p>
<p>
	<strong>Movil contacto:</strong>
	<?php echo $ficha->movil_contacto; ?></p>
<p>
	<strong>Email contacto:</strong>
	<?php echo $ficha->email_contacto; ?></p>
<p>
	<strong>Otras sedes:</strong>
	<?php echo $ficha->otras_sedes; ?></p>
<p>
	<strong>Num trabajadores:</strong>
	<?php echo $ficha->num_trabajadores; ?></p>
<p>
	<strong>Num equipos:</strong>
	<?php echo $ficha->num_equipos; ?></p>
<p>
	<strong>Fecha bienvenida:</strong>
	<?php echo $ficha->fecha_bienvenida; ?></p>
<p>
	<strong>Fecha auditoria:</strong>
	<?php echo $ficha->fecha_auditoria; ?></p>
<p>
	<strong>Iban:</strong>
	<?php echo $ficha->iban; ?></p>

<?php echo Html::anchor('ficha/edit/'.$ficha->id, 'Editar'); ?> |
<?php echo Html::anchor('ficha', 'Volver'); ?>