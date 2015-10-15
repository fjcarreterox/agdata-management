<h2>Mostrando detalle del <span class='muted'>tipo de situación</span> seleccionado</h2>
<br/>
<p>
	<strong>Tipo de situación:</strong>
	<?php echo $tipo_situacion->tipo; ?></p>
<br/>
<?php echo Html::anchor('tipo/situacion/edit/'.$tipo_situacion->id, '<span class="glyphicon glyphicon-pencil"></span> Editar',array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('tipo/situacion', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?>