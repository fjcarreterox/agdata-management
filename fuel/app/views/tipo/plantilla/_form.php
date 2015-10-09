<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Nombre identificativo', 'nombre', array('class'=>'control-label')); ?>
			<?php echo Form::input('nombre', Input::post('nombre', isset($tipo_plantilla) ? $tipo_plantilla->nombre : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Por ejemplo, "Plantilla de email de bienvenida"')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Cuerpo del mensaje', 'cuerpo', array('class'=>'control-label')); ?>
			<?php echo Form::textarea('cuerpo', Input::post('cuerpo', isset($tipo_plantilla) ? $tipo_plantilla->cuerpo : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Todos aquellos valores que luego se quieran sustituir por datos concretos del cliente, tendrán que tener el formato siguiente: ###NOMBRE### ó ###CIF###, etc.','rows'=>15)); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>