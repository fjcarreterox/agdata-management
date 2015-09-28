<h2>Mostrando detalle del <span class='muted'>tipo de fichero</span> seleccionado</h2>
<br/>
<p>
	<strong>Tipo de fichero:</strong>
	<?php echo $tipo_fichero->tipo; ?></p>
<p>
	<strong>Finalidad:</strong>
	<?php echo $tipo_fichero->finalidad; ?></p>
<br/>
<?php echo Html::anchor('tipo/ficheros/edit/'.$tipo_fichero->id, '<span class="glyphicon glyphicon-pencil"></span>  Editar', array('class' => 'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('tipo/ficheros', '<span class="glyphicon glyphicon-backward"></span> Volver al listado', array('class' => 'btn btn-danger')); ?>