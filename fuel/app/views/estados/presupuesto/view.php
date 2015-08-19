<h2>Mostrando el <span class='muted'>estado de presupuesto</span> solicitado.</h2>
<br/>
<p><strong>Nombre del estado: </strong><?php echo $estados_presupuesto->nombre; ?></p>
<br/>
<?php echo Html::anchor('estados/presupuesto/edit/'.$estados_presupuesto->id, 'Cambiar nombre',array('class'=>'btn btn-success')); ?>&nbsp;&nbsp;<?php echo Html::anchor('estados/presupuesto', 'Volver al listado',array('class'=>'btn btn-danger')); ?>