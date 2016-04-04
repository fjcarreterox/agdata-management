<h2>Mostrando detalle de la <span class='muted'>asociación</span> estructural entre fichero y datos</h2>
<br/>
<p>
	<strong>Tipo de fichero:</strong>
	<?php echo Model_Tipo_Fichero::find(Model_Fichero::find($rel_estructura->idfichero)->get('idtipo'))->get('tipo'); ?></p>
<p>
	<strong>Dato asociado a su estructura:</strong>
	<?php
	$tipo_ops = array("Datos de carácter identificativo","Datos de características personales","Datos de circunstancias sociales","Datos académicos y profesionales","Datos de detalles de empleo","Datos de información comercial","Datos económico-financieros y de seguros","Datos de transacciones","Datos especialmente protegidos");
	echo $tipo_ops[$rel_estructura->idtipodato]; ?></p>
<br/>
<?php echo Html::anchor('rel/estructura/data/'.$rel_estructura->idfichero, '<span class="glyphicon glyphicon-backward"></span> Volver al listado de la estructura',array('class'=>'btn btn-danger')); ?>