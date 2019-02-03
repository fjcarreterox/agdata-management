<h2>Editando el <span class='muted'>fichero de datos</span> seleccionado</h2>
<br/>
<?php
$data['tipos'] = $tipos;
$data['idcliente'] = $idcliente;
$data['datos'] = $datos;
echo render('ficheros/_form',$data); ?>
<p><?php echo Html::anchor('ficheros/view/'.$fichero->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default')); ?>&nbsp;
    <?php echo Html::anchor('clientes/view/'.$idcliente, '<span class="glyphicon glyphicon-backward"></span> Volver a la ficha de cliente',array('class'=>'btn btn-danger')); ?></p>
