<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Nombre del servicio', 'nombre', array('class'=>'control-label')); ?>
			<?php echo Form::input('nombre', Input::post('nombre', isset($servicio) ? $servicio->nombre : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre del nuevo servicio a ofrecer a los clientes')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar cambios', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>