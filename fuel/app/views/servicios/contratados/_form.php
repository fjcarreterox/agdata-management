<?php
$servicios_ops=array();
$servicios = Model_Servicio::find('all');
foreach($servicios as $s){
    $servicios_ops[$s->get('id')] = $s->get('nombre');
}

$year_ops = array(2013=>"2013",2014=>"2014",2015=>"2015",2016=>"2016",2017=>"2017",2018=>"2018",2019=>"2019",2020=>"2020",2021=>"2021",2022=>"2022",2023=>"2023",2024=>"2024",2025=>"2025");
$months = array("Enero"=>"Enero","Febrero"=>"Febrero","Marzo"=>"Marzo","Abril"=>"Abril","Mayo"=>"Mayo","Junio"=>"Junio","Julio"=>"Julio","Agosto"=>"Agosto","Septiembre"=>"Septiembre","Octubre"=>"Octubre","Noviembre"=>"Noviembre","Diciembre"=>"Diciembre");
$periodo_ops = array(12=>'Mensual',4=>'Trimestral',2=>'Semestral',2=>'Anual',0=>'Bienal');
$forma_ops = array("Transferencia bancaria"=>"Transferencia bancaria","Recibo domiciliado"=>"Recibo domiciliado","Cheque/Pagaré"=>"Cheque/Pagaré","Metálico/Caja"=>"Metálico/Caja");

echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<?php echo Form::input('idcliente', Input::post('idcliente', isset($servicios_contratado) ? $servicios_contratado->idcliente : $idcliente), array('class' => 'col-md-4 form-control', 'type'=>'hidden')); ?>
		<div class="form-group">
			<?php echo Form::label('Servicio a contratar', 'idtipo_servicio', array('class'=>'control-label')); ?>
			<?php echo Form::select('idtipo_servicio', Input::post('idtipo_servicio', isset($servicios_contratado) ? $servicios_contratado->idtipo_servicio : ''), $servicios_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Idtipo servicio')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Importe sin IVA', 'importe', array('class'=>'control-label')); ?>
			<?php echo Form::input('importe', Input::post('importe', isset($servicios_contratado) ? $servicios_contratado->importe : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Importe en &euro; del coste del servicio')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Año de contratación', 'year', array('class'=>'control-label')); ?>
			<?php echo Form::select('year', Input::post('year', isset($servicios_contratado) ? $servicios_contratado->year : ''),$year_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Año en el que el cliente contrata el servicio')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Mes de comienzo de facturación', 'mes_factura', array('class'=>'control-label')); ?>
			<?php echo Form::select('mes_factura', Input::post('mes_factura', isset($servicios_contratado) ? $servicios_contratado->mes_factura : ''), $months ,array('class' => 'col-md-4 form-control', 'placeholder'=>'Mes en el que se comenzará a prestar el servicio.')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Periodicidad de facturación', 'periodicidad', array('class'=>'control-label')); ?>
			<?php echo Form::select('periodicidad', Input::post('periodicidad', isset($servicios_contratado) ? $servicios_contratado->periodicidad : ''), $periodo_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Periodicidad')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Cuota a abonar (TODO: cálculo por JS)', 'cuota', array('class'=>'control-label')); ?>
			<?php echo Form::input('cuota', Input::post('cuota', isset($servicios_contratado) ? $servicios_contratado->cuota : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Cálculo entre el total del servicio y la periodicidad deseada por el cliente.')); ?>
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