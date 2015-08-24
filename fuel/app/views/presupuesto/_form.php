<?php
$clientes_ops = array();
$clientes_ops[0] = "--- SELECCIONA UN CLIENTE ---";
foreach($clientes as $c){
    $clientes_ops[$c->id] = $c->nombre;
}

$estados_ops = array();
foreach($estados as $e){
    $estados_ops[$e->id] = $e->nombre;
}

$servicios_ops = array();
foreach($servicios as $s){
    $servicios_ops[$s->id] = $s->nombre;
}
$servicios_ops[count($servicios_ops)+1] = "adaptación y mantenimiento";

echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Núm. de presupuesto (autogenerado)', 'num_p', array('class'=>'control-label')); ?>
			<?php echo Form::input('num_p', Input::post('num_p', isset($presupuesto) ? $presupuesto->num_p : $num_p), array('class' => 'col-md-4 form-control', 'readonly'=>'readonly')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Cliente', 'idcliente', array('class'=>'control-label')); ?>
			<?php echo Form::select('idcliente', Input::post('idcliente', isset($presupuesto) ? $presupuesto->idcliente : ''),$clientes_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Cliente al que se le quiere realizar el presupuesto (debe existir previamente en el sistema)')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Fecha de entrega', 'fecha_entrega', array('class'=>'control-label')); ?>
			<?php echo Form::input('fecha_entrega', Input::post('fecha_entrega', isset($presupuesto) ? $presupuesto->fecha_entrega : ''), array('class' => 'col-md-4 form-control', 'type'=>'date')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Servicios ofertados', 'servicios', array('class'=>'control-label')); ?>
            <?php echo Form::select('servicios', Input::post('servicios', isset($presupuesto) ? $presupuesto->servicios : ''),$servicios_ops, array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Importe total', 'importe', array('class'=>'control-label')); ?>
            <?php echo Form::input('importe', Input::post('importe', isset($presupuesto) ? $presupuesto->importe : ''), array('class' => 'col-md-4 form-control','placeholder'=>'Importe total al que asciende el presupuesto')); ?>
        </div>
		<div class="form-group">
			<?php echo Form::label('Estado', 'idestado', array('class'=>'control-label')); ?>
			<?php echo Form::select('idestado', Input::post('idestado', isset($presupuesto) ? $presupuesto->idestado : ''),$estados_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Idestado')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Observaciones', 'observaciones', array('class'=>'control-label')); ?>
            <?php echo Form::input('observaciones', Input::post('observaciones', isset($presupuesto) ? $presupuesto->observaciones : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Observaciones relevantes sobre el presupuesto realizado')); ?>
        </div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Guardar cambios', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>