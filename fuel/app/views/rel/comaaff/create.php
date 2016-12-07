<h2>Asignar un administrador de fincas al cliente <span class='muted'><?php echo $nombre?></span></h2>
<br/>
<?php
$data['idcom'] = $idcom;
echo render('rel/comaaff/_form',$data); ?>
<p><?php echo Html::anchor('clientes/view/'.$idcom, '<span class="glyphicon glyphicon-backward"></span> Volver a la ficha del cliente',array('class'=>'btn btn-danger')); ?></p>
