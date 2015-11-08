<h2>Asociar persona de contacto a <span class='muted'><?php echo $nombre; ?></span></h2>
<br/>
<?php
$data["idcliente"] = $idcliente;
$data["personal"] = $personal;
/*echo render('personal/_form',$data);*/ ?>
<p>¿No ecuentras a la persona que deseas asociar al cliente? Entonces tendrás que <?php echo Html::anchor('personal/create_in_costumer/', 'darla de alta'); ?> en el sistema.</p>
<p><?php echo Html::anchor('personal', '<span class="glyphicon glyphicon-backward"></span> Volver',array('class'=>'btn btn-danger')); ?></p>
