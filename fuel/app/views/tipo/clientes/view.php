<h2>Mostrando detalle del <span class='muted'>tipo de cliente seleccionado</span></h2>
<br/>
<p><strong>Tipo de cliente:</strong>
	<?php echo $tipo_cliente->tipo; ?></p>
<br/>
<?php echo Html::anchor('tipo/clientes/edit/'.$tipo_cliente->id, '<span class="glyphicon glyphicon-pencil"></span> Editar nombre',array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('tipo/clientes', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?>