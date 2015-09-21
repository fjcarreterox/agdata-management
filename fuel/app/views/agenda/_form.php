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
			<?php echo Form::label('Envío de información comercial por e-mail', 'send_info', array('class'=>'control-label')); ?>
			<?php echo Form::select('send_info', Input::post('send_info', isset($agenda) ? $agenda->send_info : ''),$send_info, array('class' => 'col-md-4 form-control', 'placeholder'=>'Send info')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Observaciones', 'observaciones', array('class'=>'control-label')); ?>
    		<?php echo Form::input('observaciones', Input::post('observaciones', isset($agenda) ? $agenda->observaciones : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Observaciones acerca del cliente')); ?>
		</div>
        <br/>
        <table class="table table-responsive table-striped table-bordered">
            <thead>
            <tr>
                <td>&nbsp;</td>
                <td><strong>Última</strong></td>
                <td><strong>Próxima</strong></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><strong>Llamada</strong></td>
                <td><?php echo Form::input('last_call', Input::post('last_call', isset($agenda) ? $agenda->last_call : ''), array('type'=>'date','class' => 'col-md-4 form-control', 'placeholder'=>'Fecha de la última llamada realizada al cliente')); ?></td>
                <td><?php echo Form::input('next_call', Input::post('next_call', isset($agenda) ? $agenda->next_call : ''), array('type'=>'date','class' => 'col-md-4 form-control', 'placeholder'=>'Próxima llamada en el futuro')); ?></td>
            </tr>
            <tr>
                <td><strong>Visita</strong></td>
                <td><?php echo Form::input('last_visit', Input::post('last_visit', isset($agenda) ? $agenda->last_visit : ''), array('type'=>'date','class' => 'col-md-4 form-control', 'placeholder'=>'Última visita realizada al cliente')); ?></td>
                <td><?php echo Form::input('next_visit', Input::post('next_visit', isset($agenda) ? $agenda->next_visit : ''), array('type'=>'date','class' => 'col-md-4 form-control', 'placeholder'=>'Próxima visita programada')); ?></td>
            </tr>
            </tbody>
        </table>

		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-ok"></span> Crear / Actualizar registro', array('class' => 'btn btn-success','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>