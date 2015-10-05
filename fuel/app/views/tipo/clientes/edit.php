<h2>Editando datos del <span class='muted'>tipo de cliente</span> seleccionado</h2>
<br/>
<?php echo render('tipo/clientes/_form'); ?>
<p><?php echo Html::anchor('tipo/clientes/view/'.$tipo_cliente->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default')); ?>&nbsp;
	<?php echo Html::anchor('tipo/clientes', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?></p>
