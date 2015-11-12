<h2><span class='muted'>Clientes presupuestados</span> existentes en el sistema</h2>
<br>
<?php if ($clientes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre/Razón social</th>
			<th>Tipo</th>
			<th>Persona de contacto</th>
			<th>Teléfono de contacto</th>
			<th>Estado del presupuesto</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($clientes as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo Model_Tipo_Cliente::find($item->tipo)->get('tipo'); ?></td>
            <td></td>
            <td></td>
            <td></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('clientes/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ficha completa', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('clientes/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php //TODO: switch between view budget if created or create if doesn't exist ?>
                        <?php echo Html::anchor('presupuesto/view/'.$item->id, '<span class="glyphicon glyphicon-file"></span> Ver presupuesto', array('class' => 'btn btn-info')); ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<p>No se han encontrado clientes aún.</p>

<?php endif; ?>
<p><?php echo Html::anchor('clientes/create', '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo cliente', array('class' => 'btn btn-success')); ?></p>