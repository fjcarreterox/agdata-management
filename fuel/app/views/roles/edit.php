<h2>Editing <span class='muted'>Role</span></h2>
<br>

<?php echo render('roles/_form'); ?>
<p>
	<?php echo Html::anchor('roles/view/'.$role->id, 'View'); ?> |
	<?php echo Html::anchor('roles', 'Back'); ?></p>
