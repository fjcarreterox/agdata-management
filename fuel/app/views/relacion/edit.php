<h2>Editando el nombre del <span class='muted'>tipo de relación</span> entre personal del cliente y <span class="muted">AGDATA</span></h2>
<br/>
<?php echo render('relacion/_form'); ?>
<p>	<?php echo Html::anchor('relacion/view/'.$relacion->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default')); ?>&nbsp;
    <?php echo Html::anchor('relacion', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de tipos',array('class'=>'btn btn-danger')); ?></p>
