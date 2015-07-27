<h2>Viewing <span class='muted'>#<?php echo $role->id; ?></span></h2>

<p>
	<strong>Rol:</strong>
	<?php echo $role->rol; ?></p>

<?php echo Html::anchor('roles/edit/'.$role->id, 'Edit'); ?> |
<?php echo Html::anchor('roles', 'Back'); ?>