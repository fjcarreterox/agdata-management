<?php
$estados_sel=array();
$estados = Model_Estados_Cliente::find('all');
foreach($estados as $e){
    $estados_sel[$e->get('id')]=$e->get('nombre');
}

$tipos_sel=array();
$tipos = Model_Tipo_Cliente::find('all');
foreach($tipos as $t){
    $tipos_sel[$t->get('id')]=$t->get('tipo');
}

echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Nombre / Razón social', 'nombre', array('class'=>'control-label')); ?>
			<?php echo Form::input('nombre', Input::post('nombre', isset($cliente) ? $cliente->nombre : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre del cliente')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Tipo', 'tipo', array('class'=>'control-label')); ?>
			<?php echo Form::select('tipo', Input::post('tipo', isset($cliente) ? $cliente->tipo : ''), $tipos_sel ,array('class' => 'col-md-4 form-control', 'placeholder'=>'Tipo de cliente')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('CIF/NIF', 'cif_nif', array('class'=>'control-label')); ?>
			<?php echo Form::input('cif_nif', Input::post('cif_nif', isset($cliente) ? $cliente->cif_nif : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'CIF ó NIF del cliente')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Dirección', 'direccion', array('class'=>'control-label')); ?>
			<?php echo Form::input('direccion', Input::post('direccion', isset($cliente) ? $cliente->direccion : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Dirección postal')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Código postal', 'cpostal', array('class'=>'control-label')); ?>
			<?php echo Form::input('cpostal', Input::post('cpostal', isset($cliente) ? $cliente->cpostal : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Código postal')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Localidad', 'loc', array('class'=>'control-label')); ?>
			<?php echo Form::input('loc', Input::post('loc', isset($cliente) ? $cliente->loc : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Localidad')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Provincia', 'prov', array('class'=>'control-label')); ?>
			<?php echo Form::input('prov', Input::post('prov', isset($cliente) ? $cliente->prov : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Provincia')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Teléfono', 'tel', array('class'=>'control-label')); ?>
			<?php echo Form::input('tel', Input::post('tel', isset($cliente) ? $cliente->tel : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Teléfono de contacto')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Página web', 'pweb', array('class'=>'control-label')); ?>
			<?php echo Form::input('pweb', Input::post('pweb', isset($cliente) ? $cliente->pweb : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Página web')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Actividad', 'actividad', array('class'=>'control-label')); ?>
			<?php echo Form::input('actividad', Input::post('actividad', isset($cliente) ? $cliente->actividad : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Actividad profesional')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Observaciones', 'observ', array('class'=>'control-label')); ?>
			<?php echo Form::input('observ', Input::post('observ', isset($cliente) ? $cliente->observ : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Observaciones de relavancia')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Estado', 'estado', array('class'=>'control-label')); ?>
			<?php echo Form::select('estado', Input::post('estado', isset($cliente) ? $cliente->estado : ''), $estados_sel,array('class' => 'col-md-4 form-control', 'placeholder'=>'Estado en el que se encuentra en nuestro sistema')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Guardar', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>