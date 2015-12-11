<h2>Editando los principales datos del <span class='muted'>contrato</span></h2>
<br/>
<?php
$data['clientes'] = $clientes;
echo render('contrato/_form',$data); ?>
<p>
	<?php echo Html::anchor('contrato/view/'.$contrato->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver detalle',array('class'=>'btn btn-default')); ?>&nbsp;&nbsp;
    <?php echo Html::anchor('contrato', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?>
</p>
