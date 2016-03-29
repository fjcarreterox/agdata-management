<h2>Listado de todos los <span class='muted'>tipos de datos</span> de ficheros</h2>
<br/>
<p><?php echo Html::anchor('tipo/datos/create', '<span class="glyphicon glyphicon-plus"></span> Añadir nuevo Tipo de dato', array('class' => 'btn btn-primary')); ?></p>
<?php if ($tipo_datos):
    $nivel_ops = array("Básico","Medio","Alto");
    $tipo_ops = array("Datos de carácter identificativo","Datos de características personales",
        "Datos de circunstancias sociales","Datos académicos y profesionales","Datos de detalles de empleo",
        "Datos de información comercial","Datos económico-financieros y de seguros","Datos de transacciones",
        "Datos especialmente protegidos");
    ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Tipo</th>
			<th>Nivel</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($tipo_datos as $item): ?>
		<tr>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo $tipo_ops[$item->tipo]; ?></td>
			<td><?php echo $nivel_ops[$item->nivel]; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('tipo/datos/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('tipo/datos/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('tipo/datos/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer eliminarlo?')")); ?>					</div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
	<p>No se han encontrado aún tipo de datos definidos.</p>
<?php endif; ?>
<p><?php echo Html::anchor('tipo/datos/create', '<span class="glyphicon glyphicon-plus"></span> Añadir nuevo Tipo de dato', array('class' => 'btn btn-primary')); ?></p>
