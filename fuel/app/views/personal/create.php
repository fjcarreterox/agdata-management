<h2>Dar de alta en el sistema nuevo <span class='muted'>personal</span> <?php echo $title;?></h2>
<br/>
<?php
$data["clientes"] = $clientes;
$data["relaciones"] = $relaciones;
echo render('personal/_form',$data); ?>
<p><?php echo Html::anchor('personal', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de personal',array('class'=>'btn btn-danger')); ?></p>
