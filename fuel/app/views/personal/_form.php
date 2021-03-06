<?php
$tratamiento_ops = array("D.","Dª");

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

$access_ops = array(
    "create"=>"Creación",
    "use"=>"Uso",
    "delete"=>"Supresión"
);

echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
            <?php echo Form::label('Cliente', 'idcliente', array('class'=>'control-label')); ?><span class="red"> *</span>
			<?php echo Form::select('idcliente', Input::post('idcliente', isset($personal) ? $personal->idcliente : ''),$clientes_opts, array('class' => 'col-md-4 form-control', 'placeholder'=>'Idcliente')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Tratamiento', 'tratamiento', array('class'=>'control-label')); ?><span class="red"> *</span>
            <?php echo Form::select('tratamiento', Input::post('tratamiento', isset($personal) ? $personal->tratamiento : ''),$tratamiento_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Tratamiento que se le da al trabajador')); ?>
        </div>
		<div class="form-group">
			<?php echo Form::label('Nombre completo', 'nombre', array('class'=>'control-label')); ?><span class="red"> *</span>
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
            <?php echo Form::input('email', Input::post('email', isset($personal) ? $personal->email : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Dirección de correo electrónico',"type"=>"email")); ?>
        </div>
		<div class="form-group">
			<?php echo Form::label('Cargo / Función', 'cargofuncion', array('class'=>'control-label')); ?>
			<?php echo Form::input('cargofuncion', Input::post('cargofuncion', isset($personal) ? $personal->cargofuncion : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Cargo o función que desempeña el trabajador en la empresa cliente')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Relación con AGDATA', 'relacion', array('class'=>'control-label')); ?><span class="red"> *</span>
			<?php echo Form::select('relacion', Input::post('relacion', isset($personal) ? $personal->relacion : ''),$relaciones_opts, array('class' => 'col-md-4 form-control', 'placeholder'=>'Tipo de relación con nosotros')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Tipo de acceso a ficheros', 'access', array('class'=>'control-label')); ?><span class="red"> *</span>
            <?php echo Form::select('access', Input::post('access', isset($personal) ? $personal->access : ''),$access_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Tipo de relación con nosotros')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Fecha de alta en el cliente', 'fecha_alta', array('class'=>'control-label')); ?>
            <?php echo Form::input('fecha_alta', Input::post('fecha_alta', isset($personal) ? $personal->fecha_alta : ''), array('class' => 'col-md-4 form-control', 'type'=>'date')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Fecha de baja en el cliente', 'fecha_baja', array('class'=>'control-label')); ?>
            <?php echo Form::input('fecha_baja', Input::post('fecha_baja', isset($personal) ? $personal->fecha_baja : ''), array('class' => 'col-md-4 form-control', 'type'=>'date')); ?>
        </div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar', array('class' => 'btn btn-primary','type'=>'submit','onclick' => "return validateForm($('form'))")); ?>
        </div>
	</fieldset>
<script>
    function validateForm(form){
        var res = true;
        if($("#form_idcliente")[0].value=="0"){
            alert("Por favor, selecciona al cliente donde trabaja la persona que quieres dar de alta.");
            return false;
        }

        if($("#form_relacion")[0].value=="0"){
            alert("Por favor, selecciona un tipo de relación de esta persona con AGDATA.");
            return false;
        }

        form.validate({ // initialize the Plugin
            rules: {
                dni: {
                    nifES: true
                },
                email:{
                    email: true
                }
            },
            messages: {
                dni: {
                    nifES: "[Este DNI no es correcto, por favor, revísalo]"
                },
                email: {
                    email: "[Esta dirección de correo no tiene un formato adecuado]"
                }
            }
        });

        return res;
    }
</script>
<?php echo Form::close(); ?>