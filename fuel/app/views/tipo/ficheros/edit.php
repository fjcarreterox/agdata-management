<h2>Editando datos del <span class='muted'>tipo de fichero</span> seleccionado</h2>
<br/>
<?php echo render('tipo/ficheros/_form'); ?>
<p><?php echo Html::anchor('tipo/ficheros/view/'.$tipo_fichero->id, '<span class="glyphicon glyphicon-eye-open"></span>  Ver detalle', array('class' => 'btn btn-default')); ?>&nbsp;
    <?php echo Html::anchor('tipo/ficheros', '<span class="glyphicon glyphicon-backward"></span>  Volver al listado', array('class' => 'btn btn-danger')); ?></p>
