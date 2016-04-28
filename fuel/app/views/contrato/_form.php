<?php
$clientes_ops = array();
$clientes_ops[0] = "-- SELECCIONA UN CLIENTE --";
foreach($clientes as $c){
    $clientes_ops[$c->id] = $c->nombre;
}

$periodo_ops = array(1=>'mensual',2=>'trimestral',3=>'anual',4=>'pago único');

$rep_ops = array(0=>"-- NO DEFINIDO --");

$path="../";
if(isset($contrato) || count($clientes)==1){
    $path="../../";
}

echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Cliente', 'idcliente', array('class'=>'control-label')); ?>
			<?php echo Form::select('idcliente', Input::post('idcliente', isset($contrato) ? $contrato->idcliente : ''), $clientes_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Idcliente')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Presupuesto relacionado', 'idpres', array('class'=>'control-label')); ?>
			<?php echo Form::input('idpres', Input::post('idpres', isset($contrato) ? $contrato->idpres : '0'), array('class' => 'col-md-4 form-control', 'readonly'=>'readonly')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Representante legal', 'idpersonal', array('class'=>'control-label')); ?>
			<?php echo Form::select('idpersonal', Input::post('idpersonal', isset($contrato) ? $contrato->idpersonal : 'NO DEFINIDO'), $rep_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Idpersonal')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Fecha de firma', 'fecha_firma', array('class'=>'control-label')); ?>
			<?php echo Form::input('fecha_firma', Input::post('fecha_firma', isset($contrato) ? $contrato->fecha_firma : ''), array('class' => 'col-md-4 form-control', 'type'=>'date')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', 'Añadir Servicios Contratados <span class="glyphicon glyphicon-arrow-right"></span>', array('class' => 'btn btn-primary','type'=>'submit','id'=>'end')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>
<script type="application/javascript">
    $("select#form_idcliente").change(function(){
        var idc = $(this.selectedOptions).attr('value');
        var values = {"idcliente":idc};
        var rep_legal = "-- NO DEFINIDO --";
        $.ajax({
            type: "POST",
            url: <?php echo '"'.$path.'personal/getRepLegal"'; ?>,
            data: values,
            dataType: "json",
            cache: false
        }).done(function(data) {
            $('select#form_idpersonal').find('option').remove().end();
            if(Object.keys(data).length > 0) {
                var index;
                for (index = 0; index < 3; ++index) {
                    if (typeof data[index] != 'undefined') {
                        rep_legal = data[index].nombre + " (" + data[index].cargo + ")";
                        $('select#form_idpersonal').append("<option value='" + data[index].id + "'>" + rep_legal + "</option>");
                    }
                }
            }
            else{
                $('select#form_idpersonal').append("<option value='0'>NO DEFINIDO</option>");
            }
        }).fail(function(data) {
            alert("ERROR al intentar buscar al Representante Legal de este cliente. Por favor, revise si ya está " +
            "definido en el sistema.");
        });
    });

    $("button#end").click(function( event ) {
        if($("#form_idcliente")[0].value=="0") {
            alert("Por favor, selecciona el cliente que deseas incluir en el contrato.");
            return false;
        }
        return true;
    });
</script>