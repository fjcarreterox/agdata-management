<?php
$ficheros_ops = array();
foreach($ficheros as $f){
    $ficheros_ops[$f->id] = Model_Tipo_Fichero::find($f->idtipo)->get('tipo');
}

$tipos_ops = array();
foreach($tipos_empresas as $t){
    $tipos_ops[$t->id] = $t->nombre;
}

echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<?php echo Form::input('idcliente', Input::post('idcliente', isset($cesione) ? $cesione->idcliente : $idcliente), array('class' => 'col-md-4 form-control', 'type'=>'hidden')); ?>
        <div class="form-group">
            <?php echo Form::label('Fichero de datos cesionado', 'idfichero', array('class'=>'control-label')); ?>
            <?php echo Form::select('idfichero', Input::post('idfichero', isset($cesione) ? $cesione->idfichero : ''),$ficheros_ops, array('class' => 'col-md-4 form-control')); ?>
        </div>
		<div class="form-group">
			<?php echo Form::label('Tipo de empresa cesionaria', 'idtipo_empresa', array('class'=>'control-label')); ?>
			<?php echo Form::select('idtipo_empresa', Input::post('idtipo_empresa', isset($cesione) ? $cesione->idtipo_empresa : ''),$tipos_ops, array('class' => 'col-md-4 form-control')); ?>
    	</div>
		<div class="form-group">
			<?php echo Form::label('Nombre de la empresa cesionaria', 'nombre', array('class'=>'control-label')); ?>
			<?php echo Form::input('nombre', Input::post('nombre', isset($cesione) ? $cesione->nombre : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre o razón social')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('CIF/NIF', 'cifnif', array('class'=>'control-label')); ?>
			<?php echo Form::input('cifnif', Input::post('cifnif', isset($cesione) ? $cesione->cifnif : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'CIF ó NIF de la empresa cesionaria')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Servicio', 'servicio', array('class'=>'control-label')); ?>
			<?php echo Form::input('servicio', Input::post('servicio', isset($cesione) ? $cesione->servicio : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Servicio que realiza dicha empresa')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Nombre del Representante legal', 'rep_legal_name', array('class'=>'control-label')); ?>
			<?php echo Form::input('rep_legal_name', Input::post('rep_legal_name', isset($cesione) ? $cesione->rep_legal_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre completo del representante legal')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('DNI del Representante legal', 'rep_legal_dni', array('class'=>'control-label')); ?>
			<?php echo Form::input('rep_legal_dni', Input::post('rep_legal_dni', isset($cesione) ? $cesione->rep_legal_dni : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'DNI del representante legal')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Cargo del Representante legal', 'rep_legal_cargo', array('class'=>'control-label')); ?>
			<?php echo Form::input('rep_legal_cargo', Input::post('rep_legal_cargo', isset($cesione) ? $cesione->rep_legal_cargo : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Cargo que ocupa el representante legal en la empresa cesionaria')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Teléfono', 'tel', array('class'=>'control-label')); ?>
			<?php echo Form::input('tel', Input::post('tel', isset($cesione) ? $cesione->tel : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Teléfono de contacto')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Domicilio', 'domicilio', array('class'=>'control-label')); ?>
			<?php echo Form::input('domicilio', Input::post('domicilio', isset($cesione) ? $cesione->domicilio : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Domicilio de la empresa cesionaria')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Localidad', 'localidad', array('class'=>'control-label')); ?>
			<?php echo Form::input('localidad', Input::post('localidad', isset($cesione) ? $cesione->localidad : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Localidad de la empresa cesionaria')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Código postal', 'cp', array('class'=>'control-label')); ?>
			<?php echo Form::input('cp', Input::post('cp', isset($cesione) ? $cesione->cp : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Código postal de la empresa cesionaria')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Fecha de firma del contrato de cesión', 'fecha_contrato', array('class'=>'control-label')); ?>
			<?php echo Form::input('fecha_contrato', Input::post('fecha_contrato', isset($cesione) ? $cesione->fecha_contrato : ''), array('class' => 'col-md-4 form-control', 'type'=>'date')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>