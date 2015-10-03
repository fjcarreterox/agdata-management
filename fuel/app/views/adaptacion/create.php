<h2>Auditoría de <span class='muted'>adaptacion</span> para <?php echo $nombre;?></h2>
<br/>
<?php
$data['idcliente'] = $idcliente;
echo render('adaptacion/_form',$data); ?>
<p><?php echo Html::anchor('cliente/view/'.$idcliente, 'Volver a la ficha de cliente'); ?></p>
