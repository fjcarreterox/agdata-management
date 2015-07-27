<h2>Mostrando detalle del <span class='muted'>usuario</span> seleccionado.</h2>

<p>
	<strong>Nombre:</strong>
	<?php echo $usuario->nombre; ?></p>
<p>
	<strong>Email:</strong>
	<?php echo $usuario->email; ?></p>
<p>
	<strong>Rol asociado:</strong>
	<?php echo Model_Role::find($usuario->role)->get('rol'); ?></p>

<?php echo Html::anchor('usuario/edit/'.$usuario->id, 'Editar'); ?> |
<?php echo Html::anchor('usuario', 'Volver'); ?>