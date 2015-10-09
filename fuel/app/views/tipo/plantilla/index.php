<h2>Listado de todas las <span class='muted'>plantillas de mailing</span> almacenadas en el sistema</h2>
<br/>
<?php if ($tipo_plantillas): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre de la plantilla</th>
			<th>Cuerpo de la plantilla (contiene patrones)</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($tipo_plantillas as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo $item->cuerpo; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('tipo/plantilla/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('tipo/plantilla/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('tipo/plantilla/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p>No se han registrado aún tipos de plantillas para mailing.</p>
<?php endif; ?>
<br/>
<p><?php echo Html::anchor('tipo/plantilla/create', '<span class="glyphicon glyphicon-plus"></span> Añadir una nueva plantilla', array('class' => 'btn btn-success')); ?></p>
