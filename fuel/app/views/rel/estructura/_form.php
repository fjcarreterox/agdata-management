<?php
$datos_ops = array();
$datos_ops[0] = "-- SELECCIONE UN TIPO DE DATO --";
$nivel_ops = array("Básico","Medio","Alto");
$tipo_ops = array("Datos de carácter identificativo","Datos de características personales","Datos de circunstancias sociales","Datos académicos y profesionales","Datos de detalles de empleo","Datos de información comercial","Datos económico-financieros y de seguros","Datos de transacciones","Datos especialmente protegidos");
foreach($datos as $d){
    $datos_ops[$d->id] = $d->nombre." (".$tipo_ops[$d->tipo]." / Nivel ".$nivel_ops[$d->nivel].")";
}
echo Form::open(array("class"=>"form-horizontal")); ?>
    <p>Seleccione el dato que desea asociar al fichero elegido del cliente:</p>
    <fieldset>
		<?php echo Form::input('idfichero', Input::post('idfichero', isset($rel_estructura) ? $rel_estructura->idfichero : $idfichero), array('class' => 'col-md-4 form-control', 'type'=>'hidden')); ?>
		<div class="form-group">
			<?php echo Form::label('Dato estructural', 'idtipodato', array('class'=>'control-label')); ?>
			<?php echo Form::select('idtipodato', Input::post('idtipodato', isset($rel_estructura) ? $rel_estructura->idtipodato : ''), $datos_ops, array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', 'Guardar asociación', array('class' => 'btn btn-primary','type'=>'submit')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>