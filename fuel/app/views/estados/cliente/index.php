<h2>Posibles <span class='muted'>estados</span> que pueden tener los clientes en el sistema:</h2>
<br>
<?php if ($estados_clientes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre del estado</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($estados_clientes as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('estados/cliente/view/'.$item->id, '<i class="icon-eye-open"></i> Ver', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('estados/cliente/edit/'.$item->id, '<i class="icon-wrench"></i> Editar nombre', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('estados/cliente/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar estado', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer borrar este estado?')")); ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<p>No se han encontrado aún estados definidos.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('estados/cliente/create', 'Añadir nuevo estados para clientes', array('class' => 'btn btn-success')); ?>

</p>
