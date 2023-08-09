<?php
$servicios = array("Conserjería","Limpieza","Vigilancia","Socorrista","Seguros","Mantenimientos","Otros");
$contratas = Model_Cliente::find('all',array('where'=>array('tipo'=>12)));
$conts_ops = array();
$conts_ops[0] = "--- SELECCIONA UNA EMPRESA CONTRATA ---";
foreach($contratas as $c){
    $conts_ops[$c->get('id')] = $c->get('nombre');
}
echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php /*echo Form::label('Comunidad de Propietarios', 'idcom', array('class'=>'control-label'));*/ ?>
			<?php echo Form::input('idcom', Input::post('idcom', isset($rel_comcont) ? $rel_comcont->idcom : $idc), array('class' => 'col-md-4 form-control', 'readonly'=>'yes')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Empresa contrata', 'idcontrata', array('class'=>'control-label')); ?>
			<?php echo Form::select('idcontrata', Input::post('idcontrata', isset($rel_comcont) ? $rel_comcont->idcontrata : ''), $conts_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Idcontrata')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Servicio externo ofrecido', 'servicio', array('class'=>'control-label')); ?>
			<?php echo Form::select('servicio', Input::post('servicio', isset($rel_comcont) ? $rel_comcont->servicio : ''), $servicios, array('class' => 'col-md-4 form-control', 'placeholder'=>'Selecciona el servicio que presta la contrata.')); ?>
        </div>
		<div class="form-group">
			<?php echo Form::label('Fecha Envío Informe (aaaa-mm-dd)', 'fechaenvio', array('class'=>'control-label')); ?>
			<?php echo Form::input('fechaenvio', Input::post('fechaenvio', isset($rel_comcont) ? $rel_comcont->fechaenvio : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Fechaenvio')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Guardar información', array('class' => 'btn btn-primary')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>