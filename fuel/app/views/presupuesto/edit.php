<h2>Editando detalles del <span class='muted'>presupuesto</span> seleccionado</h2>
<br/>
<?php
$data['servicios'] = $servicios;
$data['estados'] = $estados;
$data['clientes'] = $clientes;
echo render('presupuesto/_form',$data); ?>
<p><?php echo Html::anchor('presupuesto/view/'.$presupuesto->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver detalle',array('class'=>'btn btn-default')); ?>&nbsp;&nbsp;
    <?php echo Html::anchor('presupuesto', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?></p>
