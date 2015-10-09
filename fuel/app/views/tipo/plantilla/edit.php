<h2>Editando datos del <span class='muted'>tipo de plantilla</span> seleccionada</h2>
<br/>
<?php echo render('tipo/plantilla/_form'); ?>
<p><?php echo Html::anchor('tipo/plantilla/view/'.$tipo_plantilla->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default')); ?>&nbsp;
    <?php echo Html::anchor('tipo/plantilla', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de tipos',array('class'=>'btn btn-danger')); ?></p>
