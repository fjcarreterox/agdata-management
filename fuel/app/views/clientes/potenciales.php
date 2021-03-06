<h2><span class="muted">Posibles clientes</span> en el sistema</h2>
<p>Listado de posibles clientes: <strong>no contactados</strong> (pendientes de llamar) y los
	<strong>ya contactados</strong> (llamados y/o visitados).</p>
<?php if ($clientes): ?>
	<p>Nº total: <strong><?php echo count($clientes); ?></strong></p>
	<table class="table table-striped">
		<thead>
		<tr>
			<th>Nombre/Razón social</th>
			<th>Tipo</th>
			<th>Estado</th>
			<th>Observaciones</th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($clientes as $item): ?>
			<tr>
				<td><?php echo $item->nombre; ?></td>
				<td><?php echo Model_Tipo_Cliente::find($item->tipo)->get('tipo'); ?></td>
				<td><?php echo Model_Estados_Cliente::find($item->estado)->get('nombre'); ?></td>
				<td><?php echo $item->observ; ?></td>
				<td>
					<div class="btn-toolbar">
						<div class="btn-group">
							<?php echo Html::anchor('clientes/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ficha completa', array('class' => 'btn btn-default')); ?>
							<?php echo Html::anchor('clientes/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success'));
							if(\Fuel\Core\Session::get('idrol')==1){
								echo Html::anchor('clientes/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer borrar este cliente? Esto conlleva que se borrarán todos sus datos asociados: presupuestos, contratos, servicios contratados, etc.')"));
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
	<p>No se han encontrado clientes que cumplan los criterios de búsqueda establecidos.</p>
<?php endif; ?>
<br/>
<p><?php echo Html::anchor('clientes/create', '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo cliente', array('class' => 'btn btn-success')); ?>&nbsp;<?php echo Html::anchor('clientes/index', '<span class="glyphicon glyphicon-eye-open"></span> Ver listado completo de clientes', array('class' => 'btn btn-default')); ?></p>