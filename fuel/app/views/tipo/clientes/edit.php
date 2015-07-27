<h2>Editing <span class='muted'>Tipo_cliente</span></h2>
<br>

<?php echo render('tipo/clientes/_form'); ?>
<p>
	<?php echo Html::anchor('tipo/clientes/view/'.$tipo_cliente->id, 'View'); ?> |
	<?php echo Html::anchor('tipo/clientes', 'Back'); ?></p>
