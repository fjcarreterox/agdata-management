<h2>Crear un nuevo <span class='muted'>contrato</span> en el sistema</h2>
<br/>
<p>Antes de crear un nuevo contrato en el sistema para este cliente, asegúrate de que tienes definido un <b>Representante
Legal</b> pues será necesario para la documentación generada.</p>
<?php
$data['clientes'] = $clientes;
echo render('contrato/_form',$data); ?>
<p><?php echo Html::anchor('contrato', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de contratos',array('class'=>'btn btn-danger')); ?></p>
