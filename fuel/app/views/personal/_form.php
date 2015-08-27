<?php

if(isset($clientes)) {
    $clientes_opts = array();
    $clientes_opts[0] = "--- SELECCIONA UN CLIENTE ---";
    foreach ($clientes as $c) {
        $clientes_opts[$c->id] = $c->nombre;
    }
}

if(isset($relaciones)) {
    $relaciones_opts = array();
    $relaciones_opts[0] = "--- SELECCIONA UN TIPO DE RELACIÓN ---";
    foreach ($relaciones as $r) {
        $relaciones_opts[$r->id] = $r->nombre;
    }
}
echo Form::open(array("class"=>"form-horizontal")); ?>
<p>Los campos <strong>DNI</strong>, <strong>cargo / función</strong>, <strong>teléfono</strong> y <strong>e-mail</strong> pueden dejarse vacíos si no se conocen en el momento de dar de alta a una persona en el sistema.</p>
	<fieldset>
		<div class="form-group">
            <?php echo Form::label('Cliente', 'idcliente', array('class'=>'control-label')); ?>
			<?php echo Form::select('idcliente', Input::post('idcliente', isset($personal) ? $personal->idcliente : ''),$clientes_opts, array('class' => 'col-md-4 form-control', 'placeholder'=>'Idcliente')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Nombre completo', 'nombre', array('class'=>'control-label')); ?>
			<?php echo Form::input('nombre', Input::post('nombre', isset($personal) ? $personal->nombre : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre completo del trabajador')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('DNI', 'dni', array('class'=>'control-label')); ?>
			<?php echo Form::input('dni', Input::post('dni', isset($personal) ? $personal->dni : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'DNI con letra del trabajador')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Teléfono de contacto', 'tlfno', array('class'=>'control-label')); ?>
            <?php echo Form::input('tlfno', Input::post('tlfno', isset($personal) ? $personal->tlfno : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Teléfono donde podremos contactar con él')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('E-mail ', 'email', array('class'=>'control-label')); ?>
            <?php echo Form::input('email', Input::post('email', isset($personal) ? $personal->email : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Dirección de correo electrónico')); ?>
        </div>
		<div class="form-group">
			<?php echo Form::label('Cargo / Función', 'cargofuncion', array('class'=>'control-label')); ?>
			<?php echo Form::input('cargofuncion', Input::post('cargofuncion', isset($personal) ? $personal->cargofuncion : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Cargo o función que desempeña el trabajador en la empresa cliente')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Relación con AGDATA', 'relacion', array('class'=>'control-label')); ?>
			<?php echo Form::select('relacion', Input::post('relacion', isset($personal) ? $personal->relacion : ''),$relaciones_opts, array('class' => 'col-md-4 form-control', 'placeholder'=>'Tipo de relación con nosotros')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Guardar', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>