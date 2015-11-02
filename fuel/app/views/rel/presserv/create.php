<h2>Servicios a ofertar en el <span class='muted'>presupuesto</span></h2>
<br/>
<?php
$data['servicios'] = $servicios;
$data['idpres'] = $idpres;
echo render('rel/presserv/_form',$data); ?>
<p><?php echo Html::anchor('presupuesto', '<span class="glyphicon glyphicon-backward"></span> Cancelar',array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de no querer asociar más servicios?')")); ?></p>