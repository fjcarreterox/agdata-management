<h2>Editando datos del <span class='muted'>usuario</span> seleccionado</h2>
<br/>
<?php echo render('usuario/_form'); ?>
<p><?php echo Html::anchor('usuario/view/'.$usuario->id, 'Ver datos',array('class'=>'btn btn-success')); ?>&nbsp;&nbsp;
    <?php echo Html::anchor('usuario', 'Volver al listado',array('class'=>'btn btn-danger')); ?></p>
