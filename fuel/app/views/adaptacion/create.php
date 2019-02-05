<h2><strong>Cuestionario informático</strong> para <?php echo $nombre;?></h2>
<br/>
<?php
$data['idcliente'] = $idcliente;
echo render('adaptacion/_form',$data); ?>
<p><?php echo Html::anchor('clientes/view/'.$idcliente, '<span class="glyphicon glyphicon-backward"></span> Volver a la ficha de cliente',array('class'=>'btn btn-danger')); ?></p>
