<h2>Añadir un nuevo <span class='muted'>tipo de tarea</span></h2>
<br/>
<?php
$data["servicios"] = $servicios;
echo render('tipo/tarea/_form',$data); ?>
<p><?php echo Html::anchor('tipo/tarea', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?></p>