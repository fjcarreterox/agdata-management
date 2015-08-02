<h2><span class='muted'>Clientes</span> existentes en el sistema:</h2>
<br>
<?php if ($clientes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre/Razón social</th>
			<th>Tipo</th>
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
<?php foreach ($clientes as $item): ?>		<tr>

			<td><?php echo $item->nombre; ?></td>
			<td><?php echo Model_Tipo_Cliente::find($item->tipo)->get('tipo'); ?></td>
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
						<?php echo Html::anchor('clientes/view/'.$item->id, '<i class="icon-eye-open"></i> Ver ficha completa', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('clientes/edit/'.$item->id, '<i class="icon-wrench"></i> Editar', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('clientes/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<p>No se han encontrado clientes aún.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('clientes/create', 'Añadir un nuevo cliente', array('class' => 'btn btn-success')); ?>
</p>
