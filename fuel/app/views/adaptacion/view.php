<h2>Viewing <span class='muted'>#<?php echo $adaptacion->id; ?></span></h2>

<p>
	<strong>Idcliente:</strong>
	<?php echo $adaptacion->idcliente; ?></p>
<p>
	<strong>Num serv:</strong>
	<?php echo $adaptacion->num_serv; ?></p>
<p>
	<strong>Num pc:</strong>
	<?php echo $adaptacion->num_pc; ?></p>
<p>
	<strong>Num pc online:</strong>
	<?php echo $adaptacion->num_pc_online; ?></p>
<p>
	<strong>Num laptop:</strong>
	<?php echo $adaptacion->num_laptop; ?></p>
<p>
	<strong>Num laptop online:</strong>
	<?php echo $adaptacion->num_laptop_online; ?></p>
<p>
	<strong>Pass freq:</strong>
	<?php echo $adaptacion->pass_freq; ?></p>
<p>
	<strong>Backup freq:</strong>
	<?php echo $adaptacion->backup_freq; ?></p>
<p>
	<strong>Management sw:</strong>
	<?php echo $adaptacion->management_sw; ?></p>
<p>
	<strong>Access control:</strong>
	<?php echo $adaptacion->access_control; ?></p>

<?php echo Html::anchor('adaptacion/edit/'.$adaptacion->id, 'Edit'); ?> |
<?php echo Html::anchor('adaptacion', 'Back'); ?>