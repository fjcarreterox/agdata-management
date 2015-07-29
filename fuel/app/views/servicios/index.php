<h2>Listado de <span class='muted'>servicios</span> que ofrecemos actualmente:</h2>
<br>
<?php if ($servicios): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($servicios as $item): ?>		<tr>

			<td><?php echo $item->nombre; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php /*echo Html::anchor('servicios/view/'.$item->id, '<i class="icon-eye-open"></i> Ver ', array('class' => 'btn btn-default btn-sm'));*/ ?>
                        <?php echo Html::anchor('servicios/edit/'.$item->id, '<i class="icon-wrench"></i> Editar nombre', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('servicios/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar servicio', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('¿Estás seguro?')")); ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No se han encontrado servicios.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('servicios/create', 'Añadir un nuevo servicio', array('class' => 'btn btn-success')); ?>

</p>
