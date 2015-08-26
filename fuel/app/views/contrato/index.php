<h2>Listado de <span class='muted'>contratos</span> registrados en el sistema</h2>
<br>
<?php if ($contratos): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Cliente</th>
			<th>Presupuesto relacionado</th>
			<th>Representante legal</th>
			<th>Fecha firma</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($contratos as $item): ?>
        <tr>
			<td><?php echo Model_Cliente::find($item->idcliente)->get('nombre'); ?></td>
			<td><?php echo Html::anchor('presupuesto/view/'.$item->idpres,'Núm. '.$item->idpres); ?></td>
			<td><?php echo Model_Personal::find($item->idpersonal)->get('nombre'); ?></td>
			<td><?php echo date_conv($item->fecha_firma); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('contrato/view/'.$item->id, '<i class="icon-eye-open"></i> Ver detalles', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('contrato/edit/'.$item->id, '<i class="icon-wrench"></i> Editar datos', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('contrato/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer eliminar el contrato?')")); ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<p>No hay contratos aún registrados en el sistema.</p>

<?php endif; ?>
<p>
	<?php echo Html::anchor('contrato/create', 'Añadir un nuevo contrato', array('class' => 'btn btn-success')); ?>
</p>
