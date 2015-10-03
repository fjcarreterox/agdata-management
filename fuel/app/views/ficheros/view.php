<h2>Mostrando detalle del <span class='muted'>fichero de datos</span> seleccionado</h2>
<br/>
<p>
	<strong>Tipo de fichero:</strong>
	<?php echo Model_Tipo_Fichero::find($fichero->idtipo)->get('tipo'); ?></p>
<p>
	<strong>Ubicación del fichero:</strong>
	<?php echo $fichero->ubicacion; ?></p>
<p>
    <strong>Finalidad del fichero:</strong>
    <?php echo Model_Tipo_Fichero::find($fichero->idtipo)->get('finalidad'); ?></p>
<p>
	<strong>Soporte en el que se almacena:</strong>
	<?php echo $fichero->soporte; ?></p>
<p>
	<strong>Inscrito en la AEPD:</strong>
	<?php if($fichero->inscrito){echo "SÍ";}else{echo "NO";}; ?></p>
<p>
	<strong>Fecha de inscripción:</strong>
	<?php echo date_conv($fichero->fecha); ?></p>
<p>
	<strong>Cesión a terceros:</strong>
	<?php if($fichero->cesion){echo "SÍ";}else{echo "NO";}; ?></p>
<br/>
<?php echo Html::anchor('ficheros/edit/'.$fichero->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('clientes/view/'.$fichero->idcliente, '<span class="glyphicon glyphicon-backward"></span> Volver a la ficha del cliente', array('class'=>'btn btn-danger')); ?>