<h2>Listado de <span class='muted'>personal</span> de <b>todos los clientes</b></h2>
<br/>
<?php if ($personals): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>DNI</th>
			<th>Cargo/función</th>
            <th>Cliente</th>
			<th>Relación con AGDATA</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($personals as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo $item->dni; ?></td>
			<td><?php echo $item->cargofuncion; ?></td>
            <td><?php echo Model_Cliente::find($item->idcliente)->get('nombre'); ?></td>
			<td><?php echo Model_Relacion::find($item->relacion)->get('nombre'); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('personal/view/'.$item->id, '<i class="icon-eye-open"></i> Ver detalle', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('personal/edit/'.$item->id, '<i class="icon-wrench"></i> Editar', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('personal/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>No se ha encontrado Personal de cliente.</p>
<?php endif; ?>
<p><?php echo Html::anchor('personal/create', 'Añadir más Personal', array('class' => 'btn btn-success')); ?></p>
