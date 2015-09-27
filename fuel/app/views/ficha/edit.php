<h2>Editando los <span class='muted'>datos específicos</span> del cliente</h2>
<br/>
<?php echo render('ficha/_form'); ?>
<p><?php echo Html::anchor('ficha/view/'.$ficha->idcliente, '<span class="glyphicon glyphicon-eye-open"></span>  Ver detalles', array('class'=>'btn btn-default')); ?>&nbsp;<?php echo Html::anchor('clientes', '<span class="glyphicon glyphicon-backward"></span>  Volver al listado de clientes', array('class'=>'btn btn-danger')); ?></p>
