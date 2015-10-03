<h2>Editando el nombre del <span class='muted'>tipo de empresa cesionaria</span> seleccionada</h2>
<br/>
<?php echo render('tipo/cesionaria/_form'); ?>
<p><?php echo Html::anchor('tipo/cesionaria/view/'.$tipo_cesionarium->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>&nbsp;
	<?php echo Html::anchor('tipo/cesionaria', '<span class="glyphicon glyphicon-backward"></span> Volver al listado', array('class' => 'btn btn-danger')); ?></p>
