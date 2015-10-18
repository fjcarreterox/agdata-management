<h2>Mostrando detalle del tipo de relación de personal con <span class="muted">AGDATA</span></h2>
<br/>
<p><strong>Nombre: </strong><?php echo $relacion->nombre; ?></p>
<br/>
<?php echo Html::anchor('relacion/edit/'.$relacion->id, '<span class="glyphicon glyphicon-pencil"></span> Editar nombre',array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('relacion', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de tipos de relaciones',array('class'=>'btn btn-danger')); ?>