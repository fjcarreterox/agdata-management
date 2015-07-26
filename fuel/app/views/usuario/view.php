<h2>Viewing <span class='muted'>#<?php echo $usuario->id; ?></span></h2>

<p>
	<strong>Nombre:</strong>
	<?php echo $usuario->nombre; ?></p>
<p>
	<strong>Password:</strong>
	<?php echo $usuario->password; ?></p>
<p>
	<strong>Email:</strong>
	<?php echo $usuario->email; ?></p>
<p>
	<strong>Role:</strong>
	<?php echo $usuario->role; ?></p>

<?php echo Html::anchor('usuario/edit/'.$usuario->id, 'Edit'); ?> |
<?php echo Html::anchor('usuario', 'Back'); ?>