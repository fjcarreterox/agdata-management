<h2><span class="muted">Clientes</span> en el sistema: <u><?php echo $intro; ?></u></h2>
<br/>
<?php if ($clientes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre/Razón social</th>
			<th>Tipo</th>
            <!--<th>Fecha de entrega</th>
			<th>Tipo de entrega</th>
			<th>Situación</th>-->
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($clientes as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo Model_Tipo_Cliente::find($item->tipo)->get('tipo'); ?></td>
			<td><?php /*echo Model_Ficha::find($item->id)->get('fecha_entrega');*/ ?></td>
			<td><?php /*echo Model_Tipo_Situacion::find(Model_Ficha::find($item->id)->get('idsituacion'))->get('tipo');*/ ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('clientes/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ficha completa', array('class' => 'btn btn-default')); ?>
						<?php echo Html::anchor('clientes/doc_cesion/'.$item->id, '<span class="glyphicon glyphicon-file"></span> Vista previa cesión', array('class' => 'btn btn-info')); ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<p>No se han encontrado clientes que cumplan los criterios de búsqueda establecidos.</p>
<?php endif; ?>
<br/>
<p><?php echo Html::anchor('clientes/create', '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo cliente', array('class' => 'btn btn-success')); ?>&nbsp;<?php echo Html::anchor('clientes/index', '<span class="glyphicon glyphicon-eye-open"></span> Ver listado completo de clientes', array('class' => 'btn btn-default')); ?></p>