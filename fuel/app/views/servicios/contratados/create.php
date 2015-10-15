<h2>Crear un nuevo <span class='muted'>servicios contratado</span> para <?php echo $nombre;?></h2>
<br/>
<?php
$data['idcliente'] = $idcliente;
echo render('servicios/contratados/_form',$data); ?>
<p><?php echo Html::anchor('servicios/contratados', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?></p>
