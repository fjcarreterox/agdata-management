<h2>Crear un nuevo <span class='muted'>presupuesto</span>.</h2>
<br/>
<?php
$data['estados'] = $estados;
$data['clientes'] = $clientes;
$data['num_p'] = $num_presupuesto + 1;
echo render('presupuesto/_form',$data); ?>
<p><?php echo Html::anchor('presupuesto', 'Volver al listado'); ?></p>
