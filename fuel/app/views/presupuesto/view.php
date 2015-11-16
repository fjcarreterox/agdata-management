<h2>Mostrando detalle del <span class='muted'>presupuesto</span> seleccionado</h2>
<br/>
<p>
	<strong>Núm. presupuesto:</strong>
	<?php echo str_pad($presupuesto->num_p,5,0, STR_PAD_LEFT); ?></p>
<p>
    <strong>Fecha de creación:</strong>
    <?php echo date('\a\ \l\a\s H:i \d\e\l d-m-Y',$presupuesto->created_at); ?></p>
<p>
    <strong>Fecha de última modificación:</strong>
    <?php echo date('\a\ \l\a\s H:i \d\e\l d-m-Y',$presupuesto->updated_at); ?></p>
<p>
    <strong>Último en editarlo:</strong>
    <?php echo Model_Usuario::find($presupuesto->iduser)->get('nombre'); ?></p>
<br/>
<p>
	<strong>Cliente:</strong>
	<?php echo Model_Cliente::find($presupuesto->idcliente)->get('nombre'); ?></p>
<p>
	<strong>Fecha de entrega al cliente:</strong>
	<?php echo date_conv($presupuesto->fecha_entrega); ?></p>
<p>
	<strong>Estado:</strong>
	<?php echo Model_Estados_Presupuesto::find($presupuesto->idestado)->get('nombre'); ?></p>
<p>
    <strong>Observaciones:</strong>
    <?php echo $presupuesto->observaciones; ?></p>
<?php echo Html::anchor('presupuesto/edit/'.$presupuesto->id, '<span class="glyphicon glyphicon-pencil"></span> Editar presupuesto',array('class'=>'btn btn-success')); ?>&nbsp;
<?php
    if($presupuesto->idestado == 5) {
        echo Html::anchor('contrato/view/' . Model_Contrato::find('first',array('where'=>array('idpres'=>$presupuesto->id)))->get('id'), '<span class="glyphicon glyphicon-inbox"></span> Ver contrato', array('class' => 'btn btn-warning'))."&nbsp;&nbsp;";
    }?>
<?php echo Html::anchor('presupuesto/doc/'.$presupuesto->id, '<span class="glyphicon glyphicon-file"></span> Generar PDF', array('class' => 'btn btn-info')); ?>&nbsp;
<?php echo Html::anchor('presupuesto', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?>
<br/>
<br/>
<h3>Servicios ofertados en este presupuesto</h3>
    <?php if(empty($rel_servicios)): ?>
        <p>Aún no se han asociado servicios a este presupuesto. Es necesario asociar al menos uno para que la documentación tenga sentido.</p>
    <?php else: ?>
        <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td><b>Tipo de servicio</b></td>
            <td><b>Precio</b></td>
            <td>&nbsp;</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach($rel_servicios as $rs): ?>
            <tr>
                <td><?php echo Model_Servicio::find($rs->idserv)->get('nombre'); ?></td>
                <td><?php echo $rs->precio; ?> &euro;</td>
                <td><?php echo Html::anchor('rel/presserv/edit/'.$rs->id, '<span class="glyphicon glyphicon-pencil"></span> Cambiar precio',array('class'=>'btn btn-success')); ?>
                <?php echo Html::anchor('rel/presserv/delete/'.$rs->id, '<span class="glyphicon glyphicon-trash"></span> Borrar asociación',array('class'=>'btn btn-danger')); ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php endif; ?>
<?php echo Html::anchor('rel/presserv/create/'.$presupuesto->id, 'Asociar más servicios <span class="glyphicon glyphicon-plus-sign"></span>',array('class'=>'btn btn-primary')); ?>