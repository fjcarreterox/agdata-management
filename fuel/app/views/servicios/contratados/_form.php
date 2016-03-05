<?php
$servicios_ops=array();
$servicios = Model_Servicio::find('all');
foreach($servicios as $s){
    $servicios_ops[$s->get('id')] = $s->get('nombre');
}

$year_ops = array(2013=>"2013",2014=>"2014",2015=>"2015",2016=>"2016",2017=>"2017",2018=>"2018",2019=>"2019",2020=>"2020",2021=>"2021",2022=>"2022",2023=>"2023",2024=>"2024",2025=>"2025");
$months = array("-- N/D --","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$periodo_ops = array(-1=>'-- N/D --',12=>'Mensual',4=>'Trimestral',2=>'Semestral',1=>'Anual',0=>'Pago único');
$forma_ops = array("transferencia bancaria"=>"transferencia bancaria","recibo domiciliado"=>"recibo domiciliado","cheque/pagaré"=>"cheque/pagaré","en metálico/caja"=>"en metálico/caja");

echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<?php echo Form::input('idcontrato', Input::post('idcontrato', isset($servicios_contratado) ? $servicios_contratado->idcontrato : $idcontrato), array('class' => 'col-md-4 form-control', 'type'=>'hidden')); ?>
		<div class="form-group">
			<?php echo Form::label('Servicio a contratar', 'idtipo_servicio', array('class'=>'control-label')); ?>
			<?php echo Form::select('idtipo_servicio', Input::post('idtipo_servicio', isset($servicios_contratado) ? $servicios_contratado->idtipo_servicio : ''), $servicios_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Idtipo servicio')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Importe sin IVA (&euro;)', 'importe', array('class'=>'control-label')); ?>
			<?php echo Form::input('importe', Input::post('importe', isset($servicios_contratado) ? $servicios_contratado->importe : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Importe en &euro; del coste del servicio')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Mes de comienzo de facturación', 'mes_factura', array('class'=>'control-label')); ?>
            <?php echo Form::select('mes_factura', Input::post('mes_factura', isset($servicios_contratado) ? $servicios_contratado->mes_factura : ''), $months ,array('class' => 'col-md-4 form-control', 'placeholder'=>'Mes en el que se comenzará a prestar el servicio.')); ?>
        </div>
		<div class="form-group">
			<?php echo Form::label('Año de facturación', 'year', array('class'=>'control-label')); ?>
			<?php echo Form::select('year', Input::post('year', isset($servicios_contratado) ? $servicios_contratado->year : ''),$year_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Año en el que el cliente contrata el servicio')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Periodicidad de facturación', 'periodicidad', array('class'=>'control-label')); ?>
			<?php echo Form::select('periodicidad', Input::post('periodicidad', isset($servicios_contratado) ? $servicios_contratado->periodicidad : ''), $periodo_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Periodicidad')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Cuota a abonar (&euro;)', 'cuota', array('class'=>'control-label')); ?>
			<?php echo Form::input('cuota', Input::post('cuota', isset($servicios_contratado) ? $servicios_contratado->cuota : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Cálculo entre el total del servicio y la periodicidad deseada por el cliente.','readonly'=>'readonly')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Forma de pago elegida', 'forma_pago', array('class'=>'control-label')); ?>
			<?php echo Form::select('forma_pago', Input::post('forma_pago', isset($servicios_contratado) ? $servicios_contratado->forma_pago : ''), $forma_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Forma de pago establecida')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar datos', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>
<script type="application/javascript">
    $("select#form_idtipo_servicio").change(function(){
        var ids = $(this.selectedOptions).attr('value');
        var periodo = $("select#form_periodicidad").val();
        var importe = $("input#form_importe").val();

        var res = fee(ids,importe,periodo);
        $("input#form_cuota").val(roundNumber(res,2));
    });

    $("select#form_periodicidad").change(function(){
        var periodo = $(this.selectedOptions).attr('value');
        var ids = $("select#form_idtipo_servicio").val();
        var importe = $("input#form_importe").val();

        var res = fee(ids,importe,periodo);
        $("input#form_cuota").val(roundNumber(res,2));
    });

    $("select#form_importe").blur(function(){
        var ids = $("select#form_idtipo_servicio").val();
        var periodo = $("select#form_periodicidad").val();
        var importe = $(this).val();

        var res = fee(ids,importe,periodo);
        $("input#form_cuota").val(roundNumber(res,2));
    });

    function fee(s,i,p){
        var cuota=0;

        //pago unico
        if(p==0){
            return i;
        }
        else{
            //adaptacion: anual
            if(s==1){
                cuota = parseFloat(i/p);
            }
            //mantenimiento: bienal
            else if(s==2){
                cuota = parseFloat(i/2);
                return parseFloat(cuota/p);
            }
        }
        return cuota;
    }

    function roundNumber(number,decimals) {
        var newString;// The new rounded number
        decimals = Number(decimals);
        if (decimals < 1) {
            newString = (Math.round(number)).toString();
        } else {
            var numString = number.toString();
            if (numString.lastIndexOf(".") == -1) {// If there is no decimal point
                numString += ".";// give it one at the end
            }
            var cutoff = numString.lastIndexOf(".") + decimals;// The point at which to truncate the number
            var d1 = Number(numString.substring(cutoff,cutoff+1));// The value of the last decimal place that we'll end up with
            var d2 = Number(numString.substring(cutoff+1,cutoff+2));// The next decimal, after the last one we want
            if (d2 >= 5) {// Do we need to round up at all? If not, the string will just be truncated
                if (d1 == 9 && cutoff > 0) {// If the last digit is 9, find a new cutoff point
                    while (cutoff > 0 && (d1 == 9 || isNaN(d1))) {
                        if (d1 != ".") {
                            cutoff -= 1;
                            d1 = Number(numString.substring(cutoff,cutoff+1));
                        } else {
                            cutoff -= 1;
                        }
                    }
                }
                d1 += 1;
            }
            if (d1 == 10) {
                numString = numString.substring(0, numString.lastIndexOf("."));
                var roundedNum = Number(numString) + 1;
                newString = roundedNum.toString() + '.';
            } else {
                newString = numString.substring(0,cutoff) + d1.toString();
            }
        }
        if (newString.lastIndexOf(".") == -1) {// Do this again, to the new string
            newString += ".";
        }
        var decs = (newString.substring(newString.lastIndexOf(".")+1)).length;
        for(var i=0;i<decimals-decs;i++) newString += "0";
        //var newNumber = Number(newString);// make it a number if you like
        return newString; // Output the result to the form field (change for your purposes)
    }
</script>