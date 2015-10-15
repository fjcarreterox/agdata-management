<h2>Editando el nombre del <span class='muted'>tipo de situación</span> seleccionado</h2>
<br/>
<?php echo render('tipo/situacion/_form'); ?>
<p><?php echo Html::anchor('tipo/situacion/view/'.$tipo_situacion->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default')); ?>&nbsp;
	<?php echo Html::anchor('tipo/situacion', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?></p>
