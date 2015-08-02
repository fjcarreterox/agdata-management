<h2>Ficha completa del <span class='muted'>cliente</span> seleccionado:</h2>

<p>
	<strong>Nombre:</strong>
	<?php echo $cliente->nombre; ?></p>
<p>
	<strong>Tipo de cliente:</strong>
	<?php echo Model_Tipo_Cliente::find($cliente->tipo)->get('tipo'); ?></p>
<p>
	<strong>CIF/NIF:</strong>
	<?php echo $cliente->cif_nif; ?></p>
<p>
	<strong>Dirección:</strong>
	<?php echo $cliente->direccion; ?></p>
<p>
	<strong>Código postal:</strong>
	<?php echo $cliente->cpostal; ?></p>
<p>
	<strong>Localidad:</strong>
	<?php echo $cliente->loc; ?></p>
<p>
	<strong>Provincia:</strong>
	<?php echo $cliente->prov; ?></p>
<p>
	<strong>Teléfono:</strong>
	<?php echo $cliente->tel; ?></p>
<p>
	<strong>Página web:</strong>
	<?php echo $cliente->pweb; ?></p>
<p>
	<strong>Actividad:</strong>
	<?php echo $cliente->actividad; ?></p>
<p>
	<strong>Observaciones:</strong>
	<?php echo $cliente->observ; ?></p>
<p>
	<strong>Estado:</strong>
	<?php echo Model_Estados_Cliente::find($cliente->estado)->get('nombre'); ?></p>

<?php echo Html::anchor('clientes/edit/'.$cliente->id, 'Editar'); ?> |
<?php echo Html::anchor('clientes', 'Volver'); ?>