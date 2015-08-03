<?php

$send_info = array();
$send_info[0] = "NO";
$send_info[1] = "SÍ";

$clientes_sel = array();
$clientes = Model_Cliente::find('all',array('order_by'=>'nombre'));
$clientes_sel[0] = "-- SELECCIONE UN CLIENTE --";
foreach($clientes as $c){
    $clientes_sel[$c->get('id')] = $c->get('nombre');
}

echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Cliente', 'idcliente', array('class'=>'control-label')); ?>
			<?php echo Form::select('idcliente', Input::post('idcliente', isset($agenda) ? $agenda->idcliente : ''),$clientes_sel, array('class' => 'col-md-4 form-control', 'placeholder'=>'Cliente al que llamar/visitar')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Última llamada', 'last_call', array('class'=>'control-label')); ?>
			<?php echo Form::input('last_call', Input::post('last_call', isset($agenda) ? $agenda->last_call : ''), array('type'=>'date','class' => 'col-md-4 form-control', 'placeholder'=>'Fecha de la última llamada realizada al cliente')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Próxima llamada', 'next_call', array('class'=>'control-label')); ?>
			<?php echo Form::input('next_call', Input::post('next_call', isset($agenda) ? $agenda->next_call : ''), array('type'=>'date','class' => 'col-md-4 form-control', 'placeholder'=>'Next call')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Última visita', 'last_visit', array('class'=>'control-label')); ?>
			<?php echo Form::input('last_visit', Input::post('last_visit', isset($agenda) ? $agenda->last_visit : ''), array('type'=>'date','class' => 'col-md-4 form-control', 'placeholder'=>'Last visit')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Próxima visita', 'next_visit', array('class'=>'control-label')); ?>
			<?php echo Form::input('next_visit', Input::post('next_visit', isset($agenda) ? $agenda->next_visit : ''), array('type'=>'date','class' => 'col-md-4 form-control', 'placeholder'=>'Next visit')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Envío de información comercial por e-mail', 'send_info', array('class'=>'control-label')); ?>
			<?php echo Form::select('send_info', Input::post('send_info', isset($agenda) ? $agenda->send_info : ''),$send_info, array('class' => 'col-md-4 form-control', 'placeholder'=>'Send info')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Observaciones', 'observaciones', array('class'=>'control-label')); ?>
    		<?php echo Form::input('observaciones', Input::post('observaciones', isset($agenda) ? $agenda->observaciones : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Observaciones acerca del cliente')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Crear/Actualizar registro', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>