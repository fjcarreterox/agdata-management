<?php
$coms = Model_Cliente::find('all',array('where'=>array('tipo'=>6)));
$coms_ops = array();
$coms_ops[0] = "--- SELECCIONA UN COMUNIDAD DE PROPIETARIOS ---";
foreach($coms as $c){
    $coms_ops[$c->get('id')] = $c->get('nombre');
}
echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
        <p>Selecciona la comunidad de propietarios que deseas asociar a este administrador de fincas.</p>
		<?php echo Form::input('idaaff', Input::post('idaaff', isset($rel_comaaff) ? $rel_comaaff->idaaff : $idaaff), array('class' => 'col-md-4 form-control', 'type'=>'hidden')); ?>
		<div class="form-group">
			<?php echo Form::label('Comunidad de propietarios', 'idcom', array('class'=>'control-label')); ?>
			<?php echo Form::select('idcom', Input::post('idcom', isset($rel_comaaff) ? $rel_comaaff->idcom : ''), $coms_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Seleccione la comunidad de propietarios.')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar asociación', array('class' => 'btn btn-primary','type'=>'submit')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>