<h2>Listado de todos los <span class='muted'>presupuestos</span> existentes en el sistema</h2>
<br/>
<?php if ($presupuestos): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Núm. presupuesto</th>
			<th>Cliente</th>
			<th>Fecha</th>
			<th>Fecha de entrega</th>
			<th>Estado</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($presupuestos as $item): ?>
        <tr>
			<td><?php echo $item->num_p; ?></td>
			<td><?php echo Model_Cliente::find($item->idcliente)->get('nombre'); ?></td>
			<td><?php echo date_conv($item->fecha); ?></td>
			<td><?php echo date_conv($item->fecha_entrega); ?></td>
			<td><?php echo Model_Estados_Presupuesto::find($item->idestado)->get('nombre'); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('presupuesto/view/'.$item->id, '<i class="icon-eye-open"></i> Ver detalle', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('presupuesto/edit/'.$item->id, '<i class="icon-wrench"></i> Editar', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('presupuesto/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar del sistema', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer borrarlo?')")); ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p>No se han encontrado aún presupuestos registrados en el sistema.</p>
<?php endif; ?>
    <p><?php echo Html::anchor('presupuesto/create', 'Crear nuevo presupuesto', array('class' => 'btn btn-success')); ?></p>
