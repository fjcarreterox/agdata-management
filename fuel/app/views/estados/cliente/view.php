<h2>Detalle del <span class='muted'>estado</span> de cliente seleccionado:</h2>
<p><strong>Nombre: </strong><?php echo $estados_cliente->nombre; ?></p>
<?php echo Html::anchor('estados/cliente/edit/'.$estados_cliente->id, 'Editar nombre'); ?> |
<?php echo Html::anchor('estados/cliente', 'Volver'); ?>