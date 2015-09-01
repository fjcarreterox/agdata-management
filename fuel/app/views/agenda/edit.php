<h2>Editando el registro de <span class='muted'>agenda</span> para el cliente seleccionado</h2>
<br/>
<?php echo render('agenda/_form'); ?>
<p><?php echo Html::anchor('agenda/view/'.$agenda->id, 'Ver registro',array('class'=>'btn btn-default')); ?>
    &nbsp;&nbsp;<?php echo Html::anchor('agenda', 'Volver al listado',array('class'=>'btn btn-danger')); ?></p>
