<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Tipo de situación', 'tipo', array('class'=>'control-label')); ?>
			<?php echo Form::input('tipo', Input::post('tipo', isset($tipo_situacion) ? $tipo_situacion->tipo : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre representativo de la situación en la que se encuentra el cliente activo en adaptación')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>