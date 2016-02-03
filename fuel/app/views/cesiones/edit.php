<h2>Editando la <span class='muted'>Cesión de fichero</span> seleccionada</h2>
<br/>
<?php
$data['cesionarias'] = $cesionarias;
$data['idcliente'] = $idcliente;
$data['ficheros'] = $ficheros;
echo render('cesiones/_form',$data); ?>
<p><?php echo Html::anchor('cesiones/view/'.$cesione->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver Detalle',array('class'=>'btn btn-default')); ?>&nbsp;
	<?php echo Html::anchor('clientes/view/'.$idcliente, '<span class="glyphicon glyphicon-backward"></span> Volver a la Ficha del cliente',array('class'=>'btn btn-danger')); ?></p>
