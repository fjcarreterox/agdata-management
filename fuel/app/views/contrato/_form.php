<?php
$periodo_ops = array(1=>'mensual',2=>'trimestral',3=>'anual');


echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Cliente', 'idcliente', array('class'=>'control-label')); ?>
			<?php echo Form::input('idcliente', Input::post('idcliente', isset($contrato) ? $contrato->idcliente : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Idcliente')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Presupuesto relacionado', 'idpres', array('class'=>'control-label')); ?>
			<?php echo Form::input('idpres', Input::post('idpres', isset($contrato) ? $contrato->idpres : ''), array('class' => 'col-md-4 form-control', 'readonly'=>'readonly')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Representante legal', 'idpersonal', array('class'=>'control-label')); ?>
			<?php echo Form::input('idpersonal', Input::post('idpersonal', isset($contrato) ? $contrato->idpersonal : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Idpersonal')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Fecha de firma', 'fecha_firma', array('class'=>'control-label')); ?>
			<?php echo Form::input('fecha_firma', Input::post('fecha_firma', isset($contrato) ? $contrato->fecha_firma : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Fecha firma')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Periodo de facturación', 'periodicidad', array('class'=>'control-label')); ?>
            <?php echo Form::select('periodicidad', Input::post('periodicidad', isset($contrato) ? $contrato->periodicidad : ''),$periodo_ops, array('class' => 'col-md-4 form-control')); ?>
        </div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Guardar cambios', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>