<h2>Mostrando detalle de la  <span class='muted'>cesión de fichero de datos</span> seleccionada</h2>
<br/>
<p>
	<strong>Cliente que cede el fichero:</strong>
	<?php echo Model_Cliente::find($cesione->idcliente)->get('nombre'); ?></p>
<p>
    <strong>Nombre de la empresa a la que le cede el fichero:</strong>
    <?php echo $cesione->nombre; ?></p>
<p>
	<strong>Tipo de empresa:</strong>
	<?php echo $cesione->idtipo_empresa; ?></p>
<p>
	<strong>CIF / NIF:</strong>
	<?php echo $cesione->cifnif; ?></p>
<p>
	<strong>Servicio al que se dedica:</strong>
	<?php echo $cesione->servicio; ?></p>
<p>
	<strong>Nombre del rep. legal:</strong>
	<?php echo $cesione->rep_legal_name; ?></p>
<p>
	<strong>DNI del rep. legal:</strong>
	<?php echo $cesione->rep_legal_dni; ?></p>
<p>
	<strong>Cargo del rep. legal:</strong>
	<?php echo $cesione->rep_legal_cargo; ?></p>
<p>
	<strong>Teléfono:</strong>
	<?php echo $cesione->tel; ?></p>
<p>
	<strong>Dirección:</strong>
	<?php echo $cesione->domicilio; ?></p>
<p>
    <strong>Código postal:</strong>
    <?php echo $cesione->cp; ?></p>
<p>
	<strong>Localidad:</strong>
	<?php echo $cesione->localidad; ?></p>
<p>
	<strong>Fecha de firma del contrato de cesión:</strong>
	<?php echo $cesione->fecha_contrato; ?></p>

<?php echo Html::anchor('cesiones/edit/'.$cesione->id, 'Editar'); ?> |
<?php echo Html::anchor('cesiones', 'Volver'); ?>