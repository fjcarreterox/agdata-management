<h2>Comunidades de propietarios gestionadas por <span class='muted'><?php echo $nombre; ?></span></h2>
<br>
<?php if ($clientes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre/Razón social</th>
			<th>CIF/NIF</th>
			<!--<th>Dirección</th>
			<th>Código postal</th>
			<th>Localidad</th>
			<th>Provincia</th>-->
			<th>Teléfono</th>
			<!--<th>Página web</th>
			<th>Actividad</th>
			<th>Observaciones</th>-->
			<th>Estado</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($clientes as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo $item->cif_nif; ?></td>
			<!--<td><?php /*echo $item->direccion;*/ ?></td>
			<td><?php /*echo $item->cpostal;*/ ?></td>
			<td><?php /*echo $item->loc;*/ ?></td>
			<td><?php /*echo $item->prov;*/ ?></td>-->
			<td><?php echo $item->tel; ?></td>
			<!--<td><?php /*echo $item->pweb;*/ ?></td>
			<td><?php /*echo $item->actividad;*/ ?></td>
			<td><?php /*echo $item->observ;*/ ?></td>-->
			<td><?php echo Model_Estados_Cliente::find($item->estado)->get('nombre'); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('clientes/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ficha completa', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('clientes/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('clientes/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
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