<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Idcliente', 'idcliente', array('class'=>'control-label')); ?>

				<?php echo Form::input('idcliente', Input::post('idcliente', isset($tarea) ? $tarea->idcliente : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Idcliente')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Idtipotarea', 'idtipotarea', array('class'=>'control-label')); ?>

				<?php echo Form::input('idtipotarea', Input::post('idtipotarea', isset($tarea) ? $tarea->idtipotarea : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Idtipotarea')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Fecha', 'fecha', array('class'=>'control-label')); ?>

				<?php echo Form::input('fecha', Input::post('fecha', isset($tarea) ? $tarea->fecha : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Fecha')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Fecha respuesta', 'fecha_respuesta', array('class'=>'control-label')); ?>

				<?php echo Form::input('fecha_respuesta', Input::post('fecha_respuesta', isset($tarea) ? $tarea->fecha_respuesta : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Fecha respuesta')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>