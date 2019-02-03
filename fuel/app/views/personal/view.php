<h2>Mostrando datos de la persona seleccionada</h2>
<br/>
<p>
	<strong>Cliente:</strong>
	<?php echo Model_Cliente::find($personal->idcliente)->get('nombre'); ?></p>
<ul>
	<li><strong>Nombre completo:</strong>
	<?php echo $personal->nombre; ?></li>
	<li><strong>DNI:</strong>
	<?php echo $personal->dni; ?></li>
	<li><strong>Teléfono:</strong>
    <?php echo $personal->tlfno; ?></li>
	<li><strong>Correo electrónico:</strong>
    <?php echo $personal->email; ?></li>
	<li><strong>Cargo/función:</strong>
	<?php echo $personal->cargofuncion; ?></li>
	<li><strong>Relación con AGDATA:</strong>
	<?php echo Model_Relacion::find($personal->relacion)->get('nombre'); ?></li>
	<li><strong>Tipo de acceso a los ficheros:</strong>
	<?php
	$access_ops = array(
		"create"=>"Creación",
		"use"=>"Uso",
		"delete"=>"Supresión"
	);
	echo $access_ops[$personal->access]; ?></li>
	<li><strong>Fecha de alta en el cliente:</strong>
    <?php echo date_conv($personal->fecha_alta); ?></li>
	<li><strong>Fecha de baja en el cliente:</strong>
    <?php echo date_conv($personal->fecha_baja); ?></li>
</ul>

<br/>
<?php echo Html::anchor('personal/edit/'.$personal->id, 'Editar datos',array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('personal', 'Volver al listado general',array('class'=>'btn btn-danger')); ?>