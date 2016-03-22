<?php
$tipo_ops = array("Otra sede","Empresa del grupo");
echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
	    	<?php echo Form::input('idcliente', Input::post('idcliente', isset($gruposede) ? $gruposede->idcliente : $idcliente), array('class' => 'col-md-4 form-control', 'type'=>'hidden')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Tipo de registro', 'tipo', array('class'=>'control-label')); ?>
			<?php echo Form::select('tipo', Input::post('tipo', isset($gruposede) ? $gruposede->tipo : ''),$tipo_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Tipo')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Nombre de la sede / empresa del grupo', 'nombre', array('class'=>'control-label')); ?>
			<?php echo Form::input('nombre', Input::post('nombre', isset($gruposede) ? $gruposede->nombre : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre completo...')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Dirección completa', 'dir', array('class'=>'control-label')); ?>
			<?php echo Form::input('dir', Input::post('dir', isset($gruposede) ? $gruposede->dir : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Dirección de la sede / empresa')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('CIF (si aplica)', 'cif', array('class'=>'control-label')); ?>
			<?php echo Form::input('cif', Input::post('cif', isset($gruposede) ? $gruposede->cif : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'CIF')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Ficheros compartidos', 'ficheros', array('class'=>'control-label')); ?>
			<?php echo Form::input('ficheros', Input::post('ficheros', isset($gruposede) ? $gruposede->ficheros : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Listado de ficheros que comparten con el cliente...')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Persona de contacto', 'contacto', array('class'=>'control-label')); ?>
			<?php echo Form::input('contacto', Input::post('contacto', isset($gruposede) ? $gruposede->contacto : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre, e-mail, cargo y teléfono como mínimo...')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Registrar', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>