<h2>Registrar un nuevo <span class='muted'>Formulario CAE</span> para <strong><?php echo $nombre?></strong></h2>
<br>
<?php
$data["idcliente"] = $idcliente;
$data["nombre"] = $nombre;
echo render('infocae/_form',$data); ?>
<p><?php echo Html::anchor('infocae', 'Volver',array('class'=>'btn btn-danger')); ?></p>
