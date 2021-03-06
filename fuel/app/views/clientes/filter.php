<h2>Listado de <span class="muted">Clientes</span> en el sistema: <u><?php echo $intro; ?></u></h2>
<br/>
<?php if ($clientes): ?>
    <p>Nº total de clientes: <strong><?php echo count($clientes); ?></strong></p>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre/Razón social</th>
			<th>Tipo</th>
			<th>CIF/NIF</th>
			<th>Situación</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($clientes as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td><?php
				if(Model_Tipo_Cliente::find($item->tipo)!=null){
					echo Model_Tipo_Cliente::find($item->tipo)->get('tipo');
				}
				else{
					echo '<span class="red">N/D</span>';
				}
                ?></td>
			<td><?php echo $item->cif_nif; ?></td>
			<td><?php
				if($item->idsituacion != 0){
					echo Model_Tipo_Situacion::find($item->idsituacion)->get('tipo');
				}
				else{
					echo "-- N/D --";
				}
				?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('clientes/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ficha completa', array('class' => 'btn btn-default')); ?>
						<?php echo Html::anchor('clientes/tareas_mantenimiento/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ficha mantenimiento', array('class' => 'btn btn-info')); ?>
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