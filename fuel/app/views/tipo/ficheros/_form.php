<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Tipo de fichero', 'tipo', array('class'=>'control-label')); ?>
			<?php echo Form::input('tipo', Input::post('tipo', isset($tipo_fichero) ? $tipo_fichero->tipo : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Tipo de fichero a crear')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Finalidad que tiene', 'finalidad', array('class'=>'control-label')); ?>
			<?php echo Form::input('finalidad', Input::post('finalidad', isset($tipo_fichero) ? $tipo_fichero->finalidad : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Descripción breve de la finalidad del mismo')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar cambios', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>