<h2>Registrar una nueva <span class='muted'>cesión de datos</span> en el sistema</h2>
<br/>
<?php
$data['tipos_empresas'] = $tipos_empresas;
$data['idcliente'] = $idcliente;
$data['ficheros'] = $ficheros;

echo render('cesiones/_form',$data); ?>
<p><?php echo Html::anchor('clientes/view/'.$idcliente, '<span class="glyphicon glyphicon-backward"></span> Volver a la ficha del cliente',array('class'=>'btn btn-danger')); ?></p>
