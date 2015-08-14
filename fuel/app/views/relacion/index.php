<h2>Tipos de relaciones de personal con <span class='muted'>AGDATA:</span></h2>
<br/>
<?php if ($relacions): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre de la relación</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($relacions as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('relacion/view/'.$item->id, '<i class="icon-eye-open"></i> Ver detalle', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('relacion/edit/'.$item->id, '<i class="icon-wrench"></i> Editar nombre', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('relacion/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Borrar tipo de relación', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>No se han encontrado aún relaciones entre personal y AGDATA para mostrar.</p>
<?php endif; ?>
<p><?php echo Html::anchor('relacion/create', 'Añadir nueva relación relación', array('class' => 'btn btn-success')); ?></p>
