<h2>Editando <span class='muted'>servicio</span> incluido en el presupuesto</h2>
<br/>
<?php
$data['servicios'] = $servicios;
$data['idpres'] = $idpres;
echo render('rel/presserv/_form',$data); ?>
<p><?php echo Html::anchor('presupuesto/view/'.$idpres, '<span class="glyphicon glyphicon-backward"></span> Volver al presupuesto',array('class'=>'btn btn-danger')); ?></p>
