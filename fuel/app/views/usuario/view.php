<h2>Mostrando detalle del <span class='muted'>usuario</span> seleccionado.</h2>
<br/>
<p>
    <strong>Nombre de usuario:</strong>
    <?php echo $usuario->user; ?></p>
<p>
	<strong>Nombre:</strong>
	<?php echo $usuario->nombre; ?></p>
<p>
	<strong>Email:</strong>
	<?php echo $usuario->email; ?></p>
<p>
	<strong>Rol asociado:</strong>
	<?php echo Model_Role::find($usuario->role)->get('rol'); ?></p>
<br/>
<?php echo Html::anchor('usuario/edit/'.$usuario->id, 'Editar datos',array('class'=>'btn btn-success')); ?>&nbsp;&nbsp;
<?php echo Html::anchor('usuario', 'Volver al listado',array('class'=>'btn btn-danger')); ?>