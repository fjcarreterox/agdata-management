<h2>Tipos de <span class='muted'>clientes</span> en el sistema</h2>
<br>
<?php if ($tipo_clientes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Tipo</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($tipo_clientes as $item): ?>		<tr>

			<td><?php echo $item->tipo; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('tipo/clientes/view/'.$item->id, '<i class="icon-eye-open"></i> Ver', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('tipo/clientes/edit/'.$item->id, '<i class="icon-wrench"></i> Editar', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('tipo/clientes/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No se han encontrado tipos de clientes.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('tipo/clientes/create', 'Añadir un nuevo tipo de cliente', array('class' => 'btn btn-success')); ?>

</p>
