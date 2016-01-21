<?php
$roles_ops = array();
$roles = Model_Role::find('all');
foreach($roles as $r){
    $roles_ops[$r->get('id')] = $r->get('rol');
}

echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
        <div class="form-group">
            <?php echo Form::label('Nombre de usuario', 'user', array('class'=>'control-label')); ?>
            <?php echo Form::input('user', Input::post('user', isset($usuario) ? $usuario->user : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre de usuario para acceder al sistema')); ?>
        </div>
        <div class="form-group">
			<?php echo Form::label('Nombre completo', 'nombre', array('class'=>'control-label')); ?>
			<?php echo Form::input('nombre', Input::post('nombre', isset($usuario) ? $usuario->nombre : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre completo del usuario')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Email', 'email', array('class'=>'control-label')); ?>
			<?php echo Form::input('email', Input::post('email', isset($usuario) ? $usuario->email : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Dirección de E-mail (para notificaciones)')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Rol en el sistema', 'role', array('class'=>'control-label')); ?>
			<?php echo Form::select('role', Input::post('role', isset($usuario) ? $usuario->role : ''),$roles_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Rol que tiene en el sistema')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar Cambios', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>