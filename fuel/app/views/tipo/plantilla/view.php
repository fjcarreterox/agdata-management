<h2>Mostrando detalle del <span class='muted'>tipo de plantilla</span> seleccionado</h2>
<br/>
<p>
	<strong>Nombre identificativo:</strong>
	<?php echo $tipo_plantilla->nombre; ?></p>
<p>
	<strong>Cuerpo del mensaje (sin formato):</strong></p>
	<div><?php echo $tipo_plantilla->cuerpo; ?></div>
<br/>
<?php echo Html::anchor('tipo/plantilla/edit/'.$tipo_plantilla->id, '<span class="glyphicon glyphicon-pencil"></span> Editar',array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('tipo/plantilla', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de tipos',array('class'=>'btn btn-danger')); ?>