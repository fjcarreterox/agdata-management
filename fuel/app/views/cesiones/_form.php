<?php
$ficheros_ops = array();
foreach($ficheros as $f){
    $ficheros_ops[$f->id] = Model_Tipo_Fichero::find($f->idtipo)->get('tipo');
}

$cesionarias_ops = array();
$cesionarias_ops[0] = "-- NO DEFINIDA --";
foreach($cesionarias as $c){
    $cesionarias_ops[$c->id] = Model_Cliente::find($c->id)->get('nombre');
}

$reps_ops = array();
/*foreach($reps as $r){
    $reps_ops[$r->id] = Model_Cliente::find($r->id)->get('nombre');
}*/

echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<?php echo Form::input('idcliente', Input::post('idcliente', isset($cesione) ? $cesione->idcliente : $idcliente), array('class' => 'col-md-4 form-control', 'type'=>'hidden')); ?>
        <div class="form-group">
            <?php echo Form::label('Fichero de datos cesionado', 'idfichero', array('class'=>'control-label')); ?>
            <?php echo Form::select('idfichero', Input::post('idfichero', isset($cesione) ? $cesione->idfichero : ''),$ficheros_ops, array('class' => 'col-md-4 form-control')); ?>
        </div>
		<div class="form-group">
			<?php echo Form::label('Empresa cesionaria', 'idcesionaria', array('class'=>'control-label')); ?>
			<?php echo Form::select('idcesionaria', Input::post('idcesionaria', isset($cesione) ? $cesione->idcesionaria : ''),$cesionarias_ops, array('class' => 'col-md-4 form-control')); ?>
    	</div>
		<div class="form-group">
			<?php echo Form::label('Representante legal', 'idrep', array('class'=>'control-label')); ?>
			<?php echo Form::select('idrep', Input::post('idrep', isset($cesione) ? $cesione->idrep : ''),$reps_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Representante legal')); ?>
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
<script type="application/javascript">
    $("select#form_idcesionaria").change(function(){
        var idc = $(this.selectedOptions).attr('value');
        var values = {"idcliente":idc};
        var rep_legal = "-- NO DEFINIDO --";
        $.ajax({
            type: "POST",
            url: "../../personal/getRepLegal",
            data: values,
            dataType: "json",
            cache: false
        }).done(function(data) {
            $('select#form_idrep').find('option').remove().end();
            if(Object.keys(data).length > 0) {
                var index;
                $('select#form_idrep').append("<option value='0'> -- N/D -- </option>");
                for (index = 0; index < 3; ++index) {
                    if (typeof data[index] != 'undefined') {
                        rep_legal = data[index].nombre + " (" + data[index].cargo + ")";
                        $('select#form_idrep').append("<option value='" + data[index].id + "'>" + rep_legal + "</option>");
                    }
                }
            }
            /*if(data.id != undefined) {
                rep_legal = data.nombre + " (" + data.cargo + ")";
                //$("select#form_idpersonal option[value=0]").remove();
                $('select#form_idrep').append("<option value='"+data.id+"'>"+rep_legal+"</option>");
            }*/
            else{
                $('select#form_idrep').append("<option value='0'>-- NO DEFINIDO --</option>");
            }
        }).fail(function(data) {
            $('select#form_idrep').find('option').remove().end();
            $('select#form_idrep').append("<option value='0'>-- NO DEFINIDO --</option>");
            alert("ERROR al intentar buscar al Representante Legal de esta empresa cesionaria. Por favor, revisa si ya está " +
            "creado como persona de contacto de dicha empresa.");
        });
    });

    $( document ).ready(function() {
        var idc = $("select#form_idcesionaria option:selected").val();
        var values = {"idcliente":idc};
        var rep_legal = "-- NO DEFINIDO --";
        $.ajax({
            type: "POST",
            url: "../../personal/getRepLegal",
            data: values,
            dataType: "json",
            cache: false
        }).done(function(data) {
            $('select#form_idrep').find('option').remove().end();
            if(data.id != undefined) {
                rep_legal = data.nombre + " (" + data.cargo + ")";
                $('select#form_idrep').append("<option value='"+data.id+"'>"+rep_legal+"</option>");
            }
            else{
                $('select#form_idrep').append("<option value='0'>-- NO DEFINIDO --</option>");
            }
        }).fail(function(data) {
            $('select#form_idrep').append("<option value='0'>-- NO DEFINIDO --</option>");
            alert("ERROR al intentar buscar al Representante Legal de esta empresa cesionaria. Por favor, revisa si ya está " +
            "creado como persona de contacto de dicha empresa.");
        });
    });

    /*$("button#end").click(function( event ) {
        if($("#form_idcliente")[0].value=="0") {
            alert("Por favor, selecciona el cliente que deseas incluir en el contrato.");
            return false;
        }
        return true;
    });*/
</script>