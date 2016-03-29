<?php
$nivel_ops = array("Básico","Medio","Alto");
$tipo_ops = array("Datos de carácter identificativo","Datos de características personales","Datos de circunstancias sociales","Datos académicos y profesionales","Datos de detalles de empleo","Datos de información comercial","Datos económico-financieros y de seguros","Datos de transacciones","Datos especialmente protegidos");
echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Identificación', 'nombre', array('class'=>'control-label')); ?>
			<?php echo Form::input('nombre', Input::post('nombre', isset($tipo_dato) ? $tipo_dato->nombre : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Tipo de dato', 'tipo', array('class'=>'control-label')); ?>
			<?php echo Form::select('tipo', Input::post('tipo', isset($tipo_dato) ? $tipo_dato->tipo : ''), $tipo_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Tipo')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Nivel de seguridad', 'nivel', array('class'=>'control-label')); ?>
			<?php echo Form::select('nivel', Input::post('nivel', isset($tipo_dato) ? $tipo_dato->nivel : ''),$nivel_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Nivel')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar', array('class' => 'btn btn-primary','type'=>'submit')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>