<h2>Mostrando datos de la persona seleccionada</h2>
<br/>
<p>
	<strong>Cliente:</strong>
	<?php echo Model_Cliente::find($personal->idcliente)->get('nombre'); ?></p>
<p>
	<strong>Nombre completo:</strong>
	<?php echo $personal->nombre; ?></p>
<p>
	<strong>DNI:</strong>
	<?php echo $personal->dni; ?></p>
<p>
	<strong>Cargo/función:</strong>
	<?php echo $personal->cargofuncion; ?></p>
<p>
	<strong>Relación con AGDATA:</strong>
	<?php echo Model_Relacion::find($personal->relacion)->get('nombre'); ?></p>
<?php echo Html::anchor('personal/edit/'.$personal->id, 'Editar datos'); ?> |
<?php echo Html::anchor('personal', 'Volver al listado general'); ?>