<?php
$user_ops = array();
$user_ops[0] = "-- SIN ASIGNAR --";
foreach($users as $u){
    $user_ops[$u->id] = $u->user;
}

echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
        <div class="form-group">
            <?php echo Form::label('Fecha del evento', 'fecha', array('class'=>'control-label')); ?>
            <?php echo Form::input('fecha', Input::post('fecha', isset($agenda) ? $agenda->fecha : ''), array('type'=>'date','class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Hora del evento', 'hora', array('class'=>'control-label')); ?>
            <?php echo Form::input('hora', Input::post('hora', isset($agenda) ? $agenda->hora : ''), array('type'=>'time','class' => 'col-md-4 form-control')); ?>
        </div>
		<div class="form-group">
			<?php echo Form::label('Observaciones', 'observaciones', array('class'=>'control-label')); ?>
    		<?php echo Form::input('observaciones', Input::post('observaciones', isset($agenda) ? $agenda->observaciones : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Observaciones acerca del asunto particular')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Asignado a', 'iduser', array('class'=>'control-label')); ?>
            <?php echo Form::select('iduser', Input::post('iduser', isset($agenda) ? $agenda->iduser : ''),$user_ops, array('class' => 'col-md-4 form-control')); ?>
        </div>
        <br/>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-ok"></span> Crear / Actualizar asunto particular', array('class' => 'btn btn-success','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>