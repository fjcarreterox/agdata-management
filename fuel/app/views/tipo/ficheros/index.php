<h2>Tipos de <span class='muted'>ficheros</span> dados de alta en el sistema</h2>
<p>Por seguridad hemos eliminado la acción de borrar cualquier tipo de fichero aquí definido pues tendría consecuencias
    en el listado de ficheros cedidos entre clientes. Si deseas borrar alguno, contacta con el <b>administrador</b>.</p>
<br/>
<?php if ($tipo_ficheros): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Tipo</th>
			<th>Finalidad</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($tipo_ficheros as $item): ?>		<tr>

			<td><?php echo $item->tipo; ?></td>
			<td><?php echo $item->finalidad; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('tipo/ficheros/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('tipo/ficheros/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php /*echo Html::anchor('tipo/ficheros/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar tipo', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer eliminarlo de forma permanente?')"));*/ ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No se han encontrado aún tipos de ficheros definidos.</p>
<?php endif; ?>
<p><?php echo Html::anchor('tipo/ficheros/create', '<span class="glyphicon glyphicon-plus"></span> Añadir nuevo tipo de fichero', array('class' => 'btn btn-success')); ?></p>