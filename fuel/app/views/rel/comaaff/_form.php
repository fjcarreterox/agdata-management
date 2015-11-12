<?php
$aaffs = Model_Cliente::find('all',array('where'=>array('tipo'=>1)));
$aaff_ops = array();
$aaff_ops[0] = "--- SELECCIONA UN ADMINISTRADOR ---";
foreach($aaffs as $af){
    $aaff_ops[$af->get('id')] = $af->get('nombre');
}
echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
        <p>Selecciona un administrador de fincas de los listados a continuación.</p>
		<?php echo Form::input('idcom', Input::post('idcom', isset($rel_comaaff) ? $rel_comaaff->idcom : $idcom), array('class' => 'col-md-4 form-control', 'type'=>'hidden')); ?>
		<div class="form-group">
			<?php echo Form::label('Administrador de fincas', 'idaaff', array('class'=>'control-label')); ?>
			<?php echo Form::select('idaaff', Input::post('idaaff', isset($rel_comaaff) ? $rel_comaaff->idaaff : ''), $aaff_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Seleccione la empresa que gestionará las actividades de esta comunidad.')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar asociación', array('class' => 'btn btn-primary','type'=>'submit','onclick' => "return validateForm($('form'))")); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>
<script>
    function validateForm(form) {
        var res = true;
        if ($("#form_idaaff")[0].value == "0") {
            alert("Por favor, selecciona a un administrador de fincas.");
            return false;
        }
    }
</script>