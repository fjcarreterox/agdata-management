<h2>Nueva ficha de cliente con datos específicos para: <span class='muted'>
        <?php echo Model_Cliente::find($idcliente)->get('nombre');?></span></h2>
<br/>
<?php
$data['idcliente'] = $idcliente;
echo render('ficha/_form',$data); ?>
<p><?php echo Html::anchor('ficha', 'Volver al listado de clientes',array('class'=>'btn btn-danger')); ?></p>
