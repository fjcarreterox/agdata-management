<h2>Viewing <span class='muted'>#<?php echo $tipo_cliente->id; ?></span></h2>

<p>
	<strong>Tipo:</strong>
	<?php echo $tipo_cliente->tipo; ?></p>

<?php echo Html::anchor('tipo/clientes/edit/'.$tipo_cliente->id, 'Edit'); ?> |
<?php echo Html::anchor('tipo/clientes', 'Back'); ?>