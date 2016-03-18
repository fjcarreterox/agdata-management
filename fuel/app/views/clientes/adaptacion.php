<h2><span class="muted">Clientes</span> en el sistema: <u><?php echo $intro; ?></u></h2>
<?php if ($clientes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre/Razón social</th>
			<th>CIF</th>
			<th>Situación actual</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($clientes as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
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
						<?php
                            $t = Model_Tarea::forge();
                            if($t->existsAdapTasks($item->id)) {
                                echo Html::anchor('tareas/list/' . $item->id . '/1', '<span class="glyphicon glyphicon-check"></span> Ver tareas', array('class' => 'btn btn-warning'));
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