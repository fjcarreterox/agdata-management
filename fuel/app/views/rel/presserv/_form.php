<?php
$servicios_ops = array();
foreach($servicios as $s){
    $servicios_ops[$s->id] = $s->nombre;
}

echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<?php echo Form::input('idpres', Input::post('idpres', isset($rel_presserv) ? $rel_presserv->idpres : $idpres), array('class' => 'col-md-4 form-control', 'type'=>'hidden')); ?>

		<div class="form-group">
			<?php echo Form::label('Servicio a asociar', 'idserv', array('class'=>'control-label')); ?>
			<?php echo Form::select('idserv', Input::post('idserv', isset($rel_presserv) ? $rel_presserv->idserv : ''),$servicios_ops, array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Precio del servicio (sólo la cifra, no incluir &euro;)', 'precio', array('class'=>'control-label')); ?>
			<?php echo Form::input('precio', Input::post('precio', isset($rel_presserv) ? $rel_presserv->precio : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Precio a establecer para este cliente (no incluir símbolo &euro;)')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', 'Incluir en el presupuesto <span class="glyphicon glyphicon-plus-sign"></span>', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>