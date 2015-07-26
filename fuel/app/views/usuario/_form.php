<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Nombre', 'nombre', array('class'=>'control-label')); ?>

				<?php echo Form::input('nombre', Input::post('nombre', isset($usuario) ? $usuario->nombre : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Password', 'password', array('class'=>'control-label')); ?>

				<?php echo Form::input('password', Input::post('password', isset($usuario) ? $usuario->password : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Password')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Email', 'email', array('class'=>'control-label')); ?>

				<?php echo Form::input('email', Input::post('email', isset($usuario) ? $usuario->email : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Email')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Role', 'role', array('class'=>'control-label')); ?>

				<?php echo Form::input('role', Input::post('role', isset($usuario) ? $usuario->role : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Role')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>