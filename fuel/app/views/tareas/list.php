<h2>Listado de <span class='muted'>tareas</span> del cliente
    <span class='muted'><?php echo Model_Cliente::find($idcliente)->get('nombre'); ?></span></h2>
<br/>
<p><?php echo Html::anchor('tareas/create/'.$idcliente, '<span class="glyphicon glyphicon-plus"></span> Nueva tarea para este cliente', array('class' => 'btn btn-primary')); ?></p>
<br/>
<?php if (count($tareas_adapt)>0): ?>
    <h3 class="muted">Tareas de adaptación</h3>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Fecha</th>
			<th>Fecha respuesta</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($tareas_adapt as $item): ?>
        <tr>
			<td><?php $nombre_tarea = Model_Tipo_Tarea::find($item->idtipotarea)->get('nombre');echo $nombre_tarea; ?></td>
			<td><?php echo date_conv($item->fecha); ?></td>
			<td><?php echo date_conv($item->fecha_respuesta); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('tareas/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('tareas/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer borrarla?')")); ?>
                        <?php
                            if(strpos($nombre_tarea,'Correo') !== false){
                                echo Html::mail_to('pepe@pepe', '<span class="glyphicon glyphicon-envelope"></span> Enviar Correo', 'Asunto', array('class' => 'btn btn-warning'));
                            }
                        ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p>No se han encontrado aún <u>tareas de adaptación</u> definidas para este cliente.</p>
<?php endif; ?>
<?php if (count($tareas_supp)>0): ?>
    <h3 class="muted">Tareas de mantenimiento</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Fecha respuesta</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tareas_supp as $item): ?>
            <tr>
                <td><?php echo Model_Tipo_Tarea::find($item->idtipotarea)->get('nombre'); ?></td>
                <td><?php echo date_conv($item->fecha); ?></td>
                <td><?php echo date_conv($item->fecha_respuesta); ?></td>
                <td>
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <?php echo Html::anchor('tareas/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                            <?php echo Html::anchor('tareas/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer borrarla?')")); ?>
                            <?php echo Html::mail_to('pepe@pepe', '<span class="glyphicon glyphicon-envelope"></span> Enviar Correo', 'Asunto',array('class' => 'btn btn-warning')); ?>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No se han encontrado aún <u>tareas de mantenimiento</u> definidas para este cliente.</p>
<?php endif; ?>
<br/>
<p><?php echo Html::anchor('tareas/create/'.$idcliente, '<span class="glyphicon glyphicon-plus"></span> Nueva tarea para este cliente', array('class' => 'btn btn-primary')); ?>&nbsp;
    <?php echo Html::anchor('clientes/view/'.$idcliente, '<span class="glyphicon glyphicon-eye-open"></span> Ir a la Ficha del cliente', array('class' => 'btn btn-default','target'=>'_blank')); ?></p>