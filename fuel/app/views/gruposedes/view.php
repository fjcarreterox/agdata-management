<h2>Mostrando detalle de la <span class='muted'>sede / empresa del grupo</span> seleccionada</h2>
<br/>
<p>
	<strong>Cliente al que está asociada:</strong>
	<?php echo Model_Cliente::find($gruposede->idcliente)->get('nombre'); ?></p>
<p>
	<strong>Tipo:</strong>
	<?php
    $tipo_ops = array("Otra sede","Empresa del grupo");
    echo $tipo_ops[$gruposede->tipo]; ?></p>
<p>
	<strong>Nombre completo:</strong>
	<?php echo $gruposede->nombre; ?></p>
<p>
	<strong>Dirección postal:</strong>
	<?php echo $gruposede->dir; ?></p>
<p>
	<strong>CIF:</strong>
	<?php echo $gruposede->cif; ?></p>
<p>
	<strong>Ficheros compartidos:</strong>
	<?php echo $gruposede->ficheros; ?></p>
<p>
	<strong>Persona de contacto:</strong>
	<?php echo $gruposede->contacto; ?></p>
<?php echo Html::anchor('gruposedes/edit/'.$gruposede->id, '<span class="glyphicon glyphicon-pencil"></span> Editar estos datos',array('class'=>'btn btn-success')); ?>