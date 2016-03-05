<h2>Auditoría de <span class='muted'>adaptacion</span> para <?php echo $nombre;?></h2>
<br/>
<?php
$data['idcliente'] = $idcliente;
echo render('adaptacion/_form',$data); ?>
<p><?php echo Html::anchor('cliente/view/'.$idcliente, '<span class="glyphicon glyphicon-backward"></span> Volver a la ficha de cliente',array('class'=>'btn btn-danger')); ?></p>