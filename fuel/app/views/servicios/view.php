<h2>Detalle del <span class='muted'>servicio</span> ofrecido</h2>
<br/>
<p>
    <strong>Nombre:</strong>
    <?php echo $servicio->nombre; ?></p>
<p>
    <strong>Precio base:</strong>
    <?php echo $servicio->precio_base; ?> &euro;</p>
<br/>
<?php echo Html::anchor('servicios/edit/'.$servicio->id, '<span class="glyphicon glyphicon-pencil"></span>  Editar datos',array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('servicios', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de servicios',array('class'=>'btn btn-danger')); ?>