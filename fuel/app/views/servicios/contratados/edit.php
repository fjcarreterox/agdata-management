<h2>Editando <span class='muted'>servicios contratado</span> por <?php echo $nombre;?></h2>
<br/>
<?php
$data['idcliente'] = $idcliente;
echo render('servicios/contratados/_form',$data); ?>
<p><?php echo Html::anchor('servicios/contratados/view/'.$servicios_contratado->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default')); ?>&nbsp;
	<?php echo Html::anchor('clientes/view/'.$idcliente, '<span class="glyphicon glyphicon-backward"></span> Volver a la ficha del cliente',array('class'=>'btn btn-danger')); ?></p>
