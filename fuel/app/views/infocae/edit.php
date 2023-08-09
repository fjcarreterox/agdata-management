<h2>Editando <span class='muted'>Información C.A.E.</span> para <strong><?php echo $nombre;?></strong></h2>
<br>
<?php echo render('infocae/_form'); ?>
<p><?php echo Html::anchor('clientes/view/'.$idcliente, 'Volver a la ficha del cliente',array("class"=>"btn btn-danger")); ?></p>
