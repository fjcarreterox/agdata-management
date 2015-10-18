<h2>Tipos de relaciones de personal con <span class='muted'>AGDATA</span></h2>
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
						<?php echo Html::anchor('relacion/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('relacion/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar nombre', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('relacion/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar tipo de relación', array('class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>
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
<p><?php echo Html::anchor('relacion/create', '<span class="glyphicon glyphicon-plus"></span> Añadir nueva relación de personal', array('class' => 'btn btn-success')); ?></p>
