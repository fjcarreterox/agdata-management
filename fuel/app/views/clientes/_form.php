<?php
$estados_sel=array();
$estados = Model_Estados_Cliente::find('all');
foreach($estados as $e){
    $estados_sel[$e->get('id')]=$e->get('nombre');
}

$situacion_sel=array();
$situacion_sel[0]="-- NO ESPECIFICADO --";
$situaciones = Model_Tipo_Situacion::find('all');
foreach($situaciones as $s){
    $situacion_sel[$s->get('id')]=$s->get('tipo');
}

$tipos_sel=array();
$tipos = Model_Tipo_Cliente::find('all');
foreach($tipos as $t){
    $tipos_sel[$t->get('id')]=$t->get('tipo');
}

echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Nombre / Razón social', 'nombre', array('class'=>'control-label')); ?><span class="red"> *</span>
			<?php echo Form::input('nombre', Input::post('nombre', isset($cliente) ? $cliente->nombre : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Nombre del cliente')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Tipo de cliente', 'tipo', array('class'=>'control-label')); ?><span class="red"> *</span>
			<?php echo Form::select('tipo', Input::post('tipo', isset($cliente) ? $cliente->tipo : ''), $tipos_sel ,array('class' => 'col-md-4 form-control', 'placeholder'=>'Tipo de cliente')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Número de Colegiado', 'password', array('class'=>'control-label')); ?>
            <?php echo Form::input('password', Input::post('password', isset($cliente) ? $cliente->password : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Núm. Colegiado')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Provincia', 'prov', array('class'=>'control-label')); ?><span class="red"> *</span>
            <?php echo Form::input('prov', Input::post('prov', isset($cliente) ? $cliente->prov : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Provincia')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Actividad', 'actividad', array('class'=>'control-label')); ?><span class="red"> *</span>
            <?php echo Form::input('actividad', Input::post('actividad', isset($cliente) ? $cliente->actividad : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Actividad profesional')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Teléfono', 'tel', array('class'=>'control-label')); ?>
            <?php echo Form::input('tel', Input::post('tel', isset($cliente) ? $cliente->tel : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Teléfono de contacto')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Teléfono adicional', 'tel2', array('class'=>'control-label')); ?>
            <?php echo Form::input('tel2', Input::post('tel2', isset($cliente) ? $cliente->tel2 : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Otro teléfono de contacto')); ?>
        </div>
		<div class="form-group">
			<?php echo Form::label('CIF/NIF', 'cif_nif', array('class'=>'control-label')); ?>
			<?php echo Form::input('cif_nif', Input::post('cif_nif', isset($cliente) ? $cliente->cif_nif : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'CIF ó NIF del cliente')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Código IBAN (admite espacios y guiones entre números. Debe empezar por ES)', 'iban', array('class'=>'control-label')); ?>
            <?php echo Form::input('iban', Input::post('iban', isset($cliente) ? $cliente->iban : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'IBAN para las transferencias y pagos')); ?>
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
			<?php echo Form::label('Página web', 'pweb', array('class'=>'control-label')); ?>
			<?php echo Form::input('pweb', Input::post('pweb', isset($cliente) ? $cliente->pweb : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Página web')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Núm. aproximado de trabajadores', 'num_trab', array('class'=>'control-label')); ?>
            <?php echo Form::input('num_trab', Input::post('num_trab', isset($cliente) ? $cliente->num_trab : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Número de trabajadores que el cliente tiene contratados (de manera aproximada)','type'=>'number')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Correo electrónico', 'email', array('class'=>'control-label')); ?>
            <?php echo Form::input('email', Input::post('email', isset($cliente) ? $cliente->email : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'E-mail de contacto')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Estado', 'estado', array('class'=>'control-label')); ?>
            <?php echo Form::select('estado', Input::post('estado', isset($cliente) ? $cliente->estado : ''), $estados_sel,array('class' => 'col-md-4 form-control', 'placeholder'=>'Estado en el que se encuentra en nuestro sistema')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Situación del cliente', 'idsituacion', array('class'=>'control-label')); ?>
            <?php echo Form::select('idsituacion', Input::post('idsituacion', isset($cliente) ? $cliente->idsituacion : ''), $situacion_sel,array('class' => 'col-md-4 form-control')); ?>
        </div>
		<div class="form-group">
			<?php echo Form::label('Observaciones', 'observ', array('class'=>'control-label')); ?>
			<?php echo Form::textarea('observ', Input::post('observ', isset($cliente) ? $cliente->observ : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Observaciones de relavancia','rows' => 8)); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Tareas pendientes', 'pending', array('class'=>'control-label')); ?>
            <?php echo Form::textarea('pending', Input::post('pending', isset($cliente) ? $cliente->pending : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Tareas pendientes para comunicar al cliente','rows' => 8)); ?>
        </div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar', array('class' => 'btn btn-primary','type'=>'submit','onclick' => "return validateForm($('form'))")); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>
<script>
    function validateForm(form){
        return true;
        var res = true;

        form.validate({ // initialize the Plugin
            rules: {
                cif_nif: {
                    checkAll: true
                }
            },
            messages: {
                cif_nif: {
                    checkAll: "[Este CIF / NIF no es correcto, por favor, revísalo]"
                }
            }
        });

        return res;
    }
</script>