<h2>Mostrando detalle del <span class='muted'>rol</span> seleccionado</h2>
<br/>
<p>
	<strong>Rol:</strong>
	<?php echo $role->rol; ?></p>
<br/>
<?php echo Html::anchor('roles/edit/'.$role->id, '<span class="glyphicon glyphicon-pencil"></span> Editar',array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('roles', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?>