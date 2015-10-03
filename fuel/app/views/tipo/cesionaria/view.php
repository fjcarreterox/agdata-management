<h2>Mostrando detalle de la <span class='muted'>empresa cesionaria</span> seleccionada</h2>
<br/>
<p>
	<strong>Tipo de empresa:</strong>
	<?php echo $tipo_cesionarium->nombre; ?></p>
<br/>
<?php echo Html::anchor('tipo/cesionaria/edit/'.$tipo_cesionarium->id, '<span class="glyphicon glyphicon-pencil"></span> Editar nombre', array('class' => 'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('tipo/cesionaria', '<span class="glyphicon glyphicon-backward"></span> Volver al listado', array('class' => 'btn btn-danger')); ?>