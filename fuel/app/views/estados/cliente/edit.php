<h2>Editando el <span class='muted'>estado de cliente</span> seleccionado:</h2>
<br/>
<?php echo render('estados/cliente/_form'); ?>
<p>
	<?php echo Html::anchor('estados/cliente/view/'.$estados_cliente->id, 'Ver'); ?> |
	<?php echo Html::anchor('estados/cliente', 'Volver'); ?></p>
