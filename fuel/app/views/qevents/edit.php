<h2>Editando datos del <span class='muted'>evento</span> seleccionado</h2>
<br/>
<?php echo render('qevents/_form'); ?>
<p>
	<?php echo Html::anchor('qevents/view/'.$qevent->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver detalle',array("class"=>"btn btn-default")); ?>
	<?php echo Html::anchor('clientes/view/'.$qevent->idcustomer, '<span class="glyphicon glyphicon-backward"></span> Volver a la ficha del cliente',array("class"=>"btn btn-danger")); ?>
</p>
