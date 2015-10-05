<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Tipo de cliente', 'tipo', array('class'=>'control-label')); ?>
			<?php echo Form::input('tipo', Input::post('tipo', isset($tipo_cliente) ? $tipo_cliente->tipo : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Tipo de cliente a registrar en el sistema')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar cambios', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>