<h2>Editando detalle del <span class='muted'>servicio</span> seleccionado</h2>
<h3><font color="red"><u>ATENCIÓN</u>: Editar el <strong>nombre del servicio</strong> puede acarrear efectos no deseados en los contratos de los clientes,
    tanto en su generación en PDF, como en la base de datos.</font></h3>
<br/>
<?php echo render('servicios/_form'); ?>
<p><?php echo Html::anchor('servicios/view/'.$servicio->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default')); ?>&nbsp;
    <?php echo Html::anchor('servicios', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de servicios',array('class'=>'btn btn-danger')); ?></p>
