<h2>Datos requeridos para presupuestación: <span class='muted'>
        <?php echo Model_Cliente::find($idcliente)->get('nombre');?></span></h2>
<br/>
<?php
$data['idcliente'] = $idcliente;
echo render('ficha/_form',$data); ?>
<p><?php echo Html::anchor('ficha', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de clientes',array('class'=>'btn btn-danger')); ?></p>
