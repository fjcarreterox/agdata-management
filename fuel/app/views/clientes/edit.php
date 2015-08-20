<h2>Editando la ficha completa del <span class='muted'>cliente</span> seleccionado</h2>
<br/>
<?php echo render('clientes/_form'); ?>
<p><?php echo Html::anchor('clientes/view/'.$cliente->id, 'Ver ficha completa', array('class'=>'btn btn-success')); ?>&nbsp;&nbsp;<?php echo Html::anchor('clientes', 'Volver', array('class'=>'btn btn-danger')); ?></p>
