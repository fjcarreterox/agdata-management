<h2>Posibles <span class='muted'>estados de los presupuestos</span> en el sistema.</h2>
<br>
<?php if ($estados_presupuestos): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre del estado</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($estados_presupuestos as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('estados/presupuesto/view/'.$item->id, '<i class="icon-eye-open"></i> Ver', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('estados/presupuesto/edit/'.$item->id, '<i class="icon-wrench"></i> Editar nombre', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('estados/presupuesto/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar estado', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer borrarlo?')")); ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
    <p>No se han encontrado estados definidos para los presupuestos.</p>
<?php endif; ?>
    <p><?php echo Html::anchor('estados/presupuesto/create', 'Añadir nuevo estado', array('class' => 'btn btn-success')); ?></p>
