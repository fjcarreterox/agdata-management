<h2>Listado de <span class='muted'>situaciones</span> en las que se puede encontrar un cliente en adaptación</h2>
<br/>
<?php if ($tipo_situacions): ?>
    <p>Este tipo de <span class="muted">situaciones</span> (que no se han de confundir con los <strong>estados del cliente</strong>) nos sirven para indicar
    cada una de las fases por las que pasa el <strong>cliente activo en adaptación</strong> hasta llegar al servicio de mantenimiento.</p>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Tipo de situación</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($tipo_situacions as $item): ?>
        <tr>
			<td><?php echo $item->tipo; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('tipo/situacion/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('tipo/situacion/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar nombre', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('tipo/situacion/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
    <p>No se han encontrado situaciones aún registradas en el sistema para los clientes activos en adaptación.</p>
<?php endif; ?>
<br/>
<p><?php echo Html::anchor('tipo/situacion/create', '<span class="glyphicon glyphicon-plus"></span> Añadir nuevo tipo de situación', array('class' => 'btn btn-success')); ?></p>
