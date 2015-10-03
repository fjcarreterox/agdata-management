<h2>Viewing <span class='muted'>#<?php echo $cesione->id; ?></span></h2>

<p>
	<strong>Idcliente:</strong>
	<?php echo $cesione->idcliente; ?></p>
<p>
	<strong>Idtipo empresa:</strong>
	<?php echo $cesione->idtipo_empresa; ?></p>
<p>
	<strong>Nombre:</strong>
	<?php echo $cesione->nombre; ?></p>
<p>
	<strong>Cifnif:</strong>
	<?php echo $cesione->cifnif; ?></p>
<p>
	<strong>Servicio:</strong>
	<?php echo $cesione->servicio; ?></p>
<p>
	<strong>Rep legal name:</strong>
	<?php echo $cesione->rep_legal_name; ?></p>
<p>
	<strong>Rep legal dni:</strong>
	<?php echo $cesione->rep_legal_dni; ?></p>
<p>
	<strong>Rep legal cargo:</strong>
	<?php echo $cesione->rep_legal_cargo; ?></p>
<p>
	<strong>Tel:</strong>
	<?php echo $cesione->tel; ?></p>
<p>
	<strong>Domicilio:</strong>
	<?php echo $cesione->domicilio; ?></p>
<p>
	<strong>Localidad:</strong>
	<?php echo $cesione->localidad; ?></p>
<p>
	<strong>Cp:</strong>
	<?php echo $cesione->cp; ?></p>
<p>
	<strong>Fecha contrato:</strong>
	<?php echo $cesione->fecha_contrato; ?></p>

<?php echo Html::anchor('cesiones/edit/'.$cesione->id, 'Edit'); ?> |
<?php echo Html::anchor('cesiones', 'Back'); ?>