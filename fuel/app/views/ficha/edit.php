<h2>Editando los <span class='muted'>datos específicos</span> del cliente</h2>
<br/>
<?php echo render('ficha/_form'); ?>
<p><?php echo Html::anchor('ficha/view/'.$ficha->idcliente, 'Ver detalles', array('class'=>'btn btn-success')); ?>&nbsp;&nbsp;<?php echo Html::anchor('ficha', 'Volver', array('class'=>'btn btn-danger')); ?></p>
