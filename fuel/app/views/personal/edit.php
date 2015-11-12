<h2>Editando datos de <span class='muted'>Personal</span> de cliente</h2>
<br/>
<?php
$data["clientes"] = $clientes;
$data["relaciones"] = $relaciones;
echo render('personal/_form',$data); ?>
<p><?php echo Html::anchor('personal/view/'.$personal->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver datos',array('class'=>'btn btn-default')); ?>&nbsp;
    <?php echo Html::anchor('personal/listall', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?></p>
