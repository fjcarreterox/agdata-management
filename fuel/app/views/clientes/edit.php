<h2>Editando la ficha completa del <span class='muted'>cliente</span> seleccionado:</h2>
<br/>
<?php echo render('clientes/_form'); ?>
<p><?php echo Html::anchor('clientes/view/'.$cliente->id, 'Ver ficha completa'); ?> | <?php echo Html::anchor('clientes', 'Volver'); ?></p>
