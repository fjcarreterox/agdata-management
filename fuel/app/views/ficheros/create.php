<h2>Registrar un nuevo <span class='muted'>fichero de datos</span> para <?php echo $nombre;?></h2>
<br/>
<?php
$data['tipos'] = $tipos;
$data['idcliente'] = $idcliente;
echo render('ficheros/_form',$data); ?>
<p><?php echo Html::anchor('ficheros', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de ficheros',array('class'=>'btn btn-danger')); ?></p>
