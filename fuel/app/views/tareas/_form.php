<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<?php echo Form::hidden('idcliente', Input::post('idcliente', isset($tarea) ? $tarea->idcliente : ''), array('class' => 'col-md-4 form-control')); ?>
		<?php echo Form::hidden('idtipotarea', Input::post('idtipotarea', isset($tarea) ? $tarea->idtipotarea : ''), array('class' => 'col-md-4 form-control')); ?>
		<div class="form-group">
			<?php echo Form::label('Fecha', 'fecha', array('class'=>'control-label')); ?>
			<?php echo Form::input('fecha', Input::post('fecha', isset($tarea) ? $tarea->fecha : ''), array('class' => 'col-md-4 form-control', 'type'=>'date')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Fecha respuesta', 'fecha_respuesta', array('class'=>'control-label')); ?>
			<?php echo Form::input('fecha_respuesta', Input::post('fecha_respuesta', isset($tarea) ? $tarea->fecha_respuesta : ''), array('class' => 'col-md-4 form-control', 'type'=>'date')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar cambios', array('class' => 'btn btn-primary','type'=>'submit')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>