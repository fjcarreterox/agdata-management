<h2>Registrando nueva <span class='muted'>sede o empresa del grupo</span> para el cliente <strong><?php echo $nombre;?></strong></h2>
<br/>
<?php
$data["idcliente"] = $idcliente;
$data["nombre"] = $nombre;
echo render('gruposedes/_form',$data); ?>
<p><?php echo Html::anchor('clientes/view/'.$idcliente, '<span class="glyphicon glyphicon-backward"></span> Volver a la ficha del cliente',array('class'=>'btn btn-danger')); ?></p>
