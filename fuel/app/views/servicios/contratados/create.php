<h2>Crear un nuevo <span class='muted'>servicios contratado</span> para <strong><?php echo $nombre;?></strong></h2>
<br/>
<?php
$data['idcontrato'] = $idcontrato;
echo render('servicios/contratados/_form',$data); ?>
<p><?php echo Html::anchor('servicios/contratados', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?></p>
