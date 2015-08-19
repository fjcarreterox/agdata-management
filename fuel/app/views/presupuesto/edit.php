<h2>Editando detalles del <span class='muted'>presupuesto</span> seleccionado</h2>
<br/>
<?php
$data['estados'] = $estados;
$data['clientes'] = $clientes;
echo render('presupuesto/_form',$data); ?>
<p><?php echo Html::anchor('presupuesto/view/'.$presupuesto->id, 'Ver detalle',array('class'=>'btn btn-success')); ?>&nbsp;&nbsp;
    <?php echo Html::anchor('presupuesto', 'Volver al listado',array('class'=>'btn btn-danger')); ?></p>
