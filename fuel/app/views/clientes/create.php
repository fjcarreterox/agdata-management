<h2>Añadir un nuevo <span class='muted'>cliente</span> en el sistema</h2>
<br/>
<p>El estado inicial del cliente será <b>No contactado</b>. El resto de campos no obligatorios se pueden dejar vacíos para rellenarlos más adelante.</p>
<?php echo render('clientes/_form'); ?>
<p><?php echo Html::anchor('welcome', '<span class="glyphicon glyphicon-backward"></span> Volver al menú principal',array('class'=>'btn btn-danger')); ?></p>
