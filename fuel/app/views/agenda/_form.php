<?php
$tipo_ops = array("-- NO ESPECIFICADO --","visita","llamada","auditoría");
$send_info = array("NO","SÍ");

$clientes_sel = array();
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
            <?php echo Form::label('Tipo de evento', 'tipo', array('class'=>'control-label')); ?>
            <?php echo Form::select('tipo', Input::post('tipo', isset($agenda) ? $agenda->tipo : ''),$tipo_ops, array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Fecha del evento', 'fecha', array('class'=>'control-label')); ?>
            <?php echo Form::input('fecha', Input::post('fecha', isset($agenda) ? $agenda->fecha : ''), array('type'=>'date','class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Hora del evento', 'hora', array('class'=>'control-label')); ?>
            <?php echo Form::input('hora', Input::post('hora', isset($agenda) ? $agenda->hora : ''), array('type'=>'time','class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="form-group">
			<?php echo Form::label('Envío de información comercial por e-mail', 'send_info', array('class'=>'control-label')); ?>
			<?php echo Form::select('send_info', Input::post('send_info', isset($agenda) ? $agenda->send_info : ''),$send_info, array('class' => 'col-md-4 form-control', 'placeholder'=>'Send info')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Observaciones', 'observaciones', array('class'=>'control-label')); ?>
    		<?php echo Form::input('observaciones', Input::post('observaciones', isset($agenda) ? $agenda->observaciones : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Observaciones acerca del cliente')); ?>
		</div>
        <br/>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-ok"></span> Crear / Actualizar evento', array('class' => 'btn btn-success','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>