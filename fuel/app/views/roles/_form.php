<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Rol', 'rol', array('class'=>'control-label')); ?>

				<?php echo Form::input('rol', Input::post('rol', isset($role) ? $role->rol : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Rol')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>