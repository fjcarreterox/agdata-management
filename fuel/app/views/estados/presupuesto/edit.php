<h2>Editando el nombre del <span class='muted'>estados de presupuesto</span> solicitado.</h2>
<br/>
<?php echo render('estados/presupuesto/_form'); ?>
<p><?php echo Html::anchor('estados/presupuesto/view/'.$estados_presupuesto->id, 'Ver',array('class'=>'btn btn-success')); ?>&nbsp;&nbsp;<?php echo Html::anchor('estados/presupuesto', 'Volver al listado',array('class'=>'btn btn-danger')); ?></p>
