<h2>Dar de alta en el sistema a un nuevo <span class='muted'>trabajador</span> de cliente</h2>
<br/>
<?php
$data["clientes"] = $clientes;
$data["relaciones"] = $relaciones;
echo render('personal/_form',$data); ?>
<p><?php echo Html::anchor('personal', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de personal',array('class'=>'btn btn-danger')); ?></p>
