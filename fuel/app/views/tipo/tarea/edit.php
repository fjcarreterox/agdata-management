<h2>Editando datos del <span class='muted'>tipo de tarea</span> seleccionada</h2>
<br/>
<?php
$data["servicios"] = $servicios;
echo render('tipo/tarea/_form',$data); ?>
<p><?php echo Html::anchor('tipo/tarea/view/'.$tipo_tarea->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default')); ?>&nbsp;
	<?php echo Html::anchor('tipo/tarea', '<span class="glyphicon glyphicon-backward"></span> Volver',array('class'=>'btn btn-danger')); ?></p>
