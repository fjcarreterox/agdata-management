<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Tipo de empresa', 'nombre', array('class'=>'control-label')); ?>
			<?php echo Form::input('nombre', Input::post('nombre', isset($tipo_cesionarium) ? $tipo_cesionarium->nombre : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Tipo de empresa cesionaria de los datos de clientes')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>