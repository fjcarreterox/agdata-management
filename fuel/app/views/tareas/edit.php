<h2>Editando datos de la <span class='muted'>tarea</span> seleccionada</h2>
<br/>
<?php echo render('tareas/_form'); ?>
<p><?php echo Html::anchor('tareas/view/'.$tarea->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver Detalle',array('class'=>'btn btn-default')); ?>&nbsp;
	<?php echo Html::anchor('tareas', '<span class="glyphicon glyphicon-backward"></span> Volver',array('class'=>'btn btn-danger')); ?></p>
