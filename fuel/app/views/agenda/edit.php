<h2>Editando el registro de <span class='muted'>agenda</span> para el cliente seleccionado</h2>
<br/>
<?php echo render('agenda/_form'); ?>
<p><?php echo Html::anchor('agenda/view/'.$agenda->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver registro',array('class'=>'btn btn-default')); ?>
    &nbsp;&nbsp;<?php echo Html::anchor('agenda', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?></p>
