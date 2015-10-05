<h2>Tipos de <span class='muted'>clientes</span> del sistema</h2>
<br/>
<p>Se ha eliminado el botón de borrado al estar estrechamente relacionado con los clientes del sistema. Si deseas borrar algún tipo en concreto, ponte en contacto con el administrador.</p>
<?php if ($tipo_clientes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Tipo de cliente</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($tipo_clientes as $item): ?>
        <tr>
			<td><?php echo $item->tipo; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('tipo/clientes/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('tipo/clientes/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php /*echo Html::anchor('tipo/clientes/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar tipo', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer borrarlo?')"));*/ ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No se han encontrado tipos de clientes.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('tipo/clientes/create', '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo tipo de cliente', array('class' => 'btn btn-success')); ?>

</p>
