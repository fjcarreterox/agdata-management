<h2>Crear un nuevo <span class='muted'>presupuesto</span></h2>
<br/>
<p>Primero rellenaremos los datos genéricos del presupuesto y luego seleccionamos los servicios ofertados junto con sus respectivos precios.</p>
<?php
$data['servicios'] = $servicios;
$data['estados'] = $estados;
$data['clientes'] = $clientes;
$data['num_p'] = $num_presupuesto + 1;

echo render('presupuesto/_form',$data); ?>
<p><?php echo Html::anchor('presupuesto', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?></p>
