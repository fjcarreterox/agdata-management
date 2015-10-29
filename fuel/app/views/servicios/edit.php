<h2>Editando datos del <span class='muted'>servicio</span> seleccionado</h2>
<br/>
<?php echo render('servicios/_form'); ?>
<p><?php echo Html::anchor('servicios/view/'.$servicio->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default')); ?>&nbsp;
    <?php echo Html::anchor('servicios', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de servicios',array('class'=>'btn btn-danger')); ?></p>
