<?php
$estados_fact=array(
    "no emitida" => "No emitida",
    "emitida" => "Emitida",
    "pdte. de envío" => "Pendiente de Envío",
    "pdte. de cobro" => "Pendiente de Cobro",
    "cobrada" => "Cobrada",
    "anulada" => "Anulada",
);

echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<?php echo Form::input('num_fact', Input::post('num_fact', isset($factura) ? $factura->num_fact : ''), array('class' => 'col-md-4 form-control hidden')); ?>
		<?php echo Form::input('num_cuota', Input::post('num_cuota', isset($factura) ? $factura->num_cuota : ''), array('class' => 'col-md-4 form-control hidden')); ?>
		<?php echo Form::input('idsc', Input::post('idsc', isset($factura) ? $factura->idsc : ''), array('class' => 'col-md-4 form-control hidden')); ?>
		<?php echo Form::input('mes_cobro', Input::post('mes_cobro', isset($factura) ? $factura->mes_cobro : ''), array('class' => 'col-md-4 form-control hidden')); ?>
		<?php echo Form::input('anyo_cobro', Input::post('anyo_cobro', isset($factura) ? $factura->anyo_cobro : ''), array('class' => 'col-md-4 form-control hidden')); ?>
		<div class="form-group">
			<?php echo Form::label('Estado', 'estado', array('class'=>'control-label')); ?>
			<?php echo Form::select('estado', Input::post('estado', isset($factura) ? $factura->estado : ''),$estados_fact, array('class' => 'col-md-4 form-control', 'placeholder'=>'Estado')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Guardar', array('class' => 'btn btn-primary')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>