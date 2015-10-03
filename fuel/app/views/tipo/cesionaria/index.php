<h2>Listado de todos los <span class='muted'>tipos de empresas cesionarias</span></h2>
<br>
<?php if ($tipo_cesionaria): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Tipo de empresa cesionaria</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($tipo_cesionaria as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('tipo/cesionaria/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('tipo/cesionaria/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar nombre', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('tipo/cesionaria/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>
<br/>
<?php else: ?>
    <p>No se han encontrado aún tipos de empresas cesionarias.</p>
<?php endif; ?>
    <p><?php echo Html::anchor('tipo/cesionaria/create', '<span class="glyphicon glyphicon-plus"></span> Añadir nuevo tipo de empresa', array('class' => 'btn btn-success')); ?></p>
