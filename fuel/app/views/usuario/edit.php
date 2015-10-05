<h2>Editando datos del <span class='muted'>usuario</span> seleccionado</h2>
<br/>
<?php echo render('usuario/_form'); ?>
<p><?php echo Html::anchor('usuario/view/'.$usuario->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default')); ?>&nbsp;
    <?php echo Html::anchor('usuario', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?></p>
