<h2>Editando los <span class='muted'>datos de contacto</span> del cliente seleccionado</h2>
<br/>
<?php echo render('clientes/_form'); ?>
<p><?php echo Html::anchor('clientes/view/'.$cliente->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver ficha completa', array('class'=>'btn btn-default')); ?>&nbsp;<?php echo Html::anchor('clientes', '<span class="glyphicon glyphicon-backward"></span> Volver', array('class'=>'btn btn-danger')); ?></p>
