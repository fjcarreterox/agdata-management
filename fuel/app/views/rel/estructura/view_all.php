<h2>Mostrando estructura del <span class='muted'>fichero</span> seleccionado</h2>
<br/>
<p>Cliente: <strong><?php echo Model_Cliente::find($idcliente)->get('nombre'); ?></strong></p>
<p>Fichero: <strong><?php echo Model_Tipo_Fichero::find($tipofichero)->get('tipo');?></strong></p>
<?php
$nivel_ops = array("Básico","Medio","Alto");
$tipo_ops = array("Datos de carácter identificativo","Datos de características personales","Datos de circunstancias sociales","Datos académicos y profesionales","Datos de detalles de empleo","Datos de información comercial","Datos económico-financieros y de seguros","Datos de transacciones","Datos especialmente protegidos");
?>
<br/>
<h3>Datos que conforman actualmente la estructura del fichero</h3>
<?php if(count($estructura)>0): ?>
<table class="table table-striped table-bordered table-hover table-responsive">
	<thead>
	<tr class="text-center">
		<td><strong>Nombre</strong></td>
		<td><strong>Tipo</strong></td>
		<td><strong>Nivel de seguridad</strong></td>
		<td>&nbsp;</td>
	</tr>
	</thead>
	<tbody>
	<?php foreach($estructura as $e): ?>
		<tr>
			<td><?php echo Model_Tipo_Dato::find($e->idtipodato)->get('nombre'); ?></td>
			<td><?php echo $tipo_ops[Model_Tipo_Dato::find($e->idtipodato)->get('tipo')]; ?></td>
			<td><?php echo $nivel_ops[Model_Tipo_Dato::find($e->idtipodato)->get('nivel')]; ?></td>
			<td><?php echo Html::anchor('rel/estructura/view/'.$e->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle',array('class'=>'btn btn-default')); ?>
				<?php echo Html::anchor('rel/estructura/delete/'.$e->id, '<span class="glyphicon glyphicon-trash"></span> Borrar dato',array('class'=>'btn btn-danger','onclick'=>"return confirm('¿Estás seguro de querer eliminarla del sistema?')")); ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
<p>Aún no se han encontrado asociaciones para conformar la estructura del fichero declarado.</p>
<?php endif; ?>
<br/>
<p><?php echo Html::anchor('rel/estructura/create/'.$idfichero, '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo tipo de dato',array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('clientes/view/'.$idcliente, '<span class="glyphicon glyphicon-backward"></span> Volver a la ficha del cliente',array('class'=>'btn btn-danger')); ?></p>