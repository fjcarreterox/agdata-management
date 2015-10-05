<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Nombre del rol', 'rol', array('class'=>'control-label')); ?>
			<?php echo Form::input('rol', Input::post('rol', isset($role) ? $role->rol : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Rol del sistema')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>