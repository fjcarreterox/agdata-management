<h2>Editando el nombre del <span class='muted'>rol</span> seleccionado</h2>
<br/>
<?php echo render('roles/_form'); ?>
<p><?php echo Html::anchor('roles/view/'.$role->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default')); ?>&nbsp;
    <?php echo Html::anchor('roles', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?></p>
