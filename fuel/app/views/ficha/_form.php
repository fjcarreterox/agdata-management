<?php
$rep_ops = array(0=>'NO',1=>'SÍ');

echo Form::open(array("class"=>"form-horizontal")); ?>
    <p>Rellena todos los datos posibles de la siguiente ficha para que se encuentre lo más completa y actualizada posible.</p>
	<fieldset>
		<div class="form-group">
			<?php echo Form::input('idcliente', Input::post('idcliente', isset($ficha) ? $ficha->idcliente : $idcliente), array('class' => 'col-md-4 form-control', 'type'=>'hidden')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Teléfono móvil de la persona de contacto', 'movil_contacto', array('class'=>'control-label')); ?>
			<?php echo Form::input('movil_contacto', Input::post('movil_contacto', isset($ficha) ? $ficha->movil_contacto : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Móvil de contacto')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('E-mail de contacto', 'email_contacto', array('class'=>'control-label')); ?>
			<?php echo Form::input('email_contacto', Input::post('email_contacto', isset($ficha) ? $ficha->email_contacto : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'E-mail principal para estar en contacto con el cliente')); ?>
		</div>
		<div class="form-group">
    		<?php echo Form::label('Código CNAE', 'cnae', array('class'=>'control-label')); ?>
			<?php echo Form::input('cnae', Input::post('cnae', isset($ficha) ? $ficha->cnae : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Código CNAE del cliente')); ?>
            <p><?php echo Html::anchor('http://www.cnae.com.es/obtener-cnae-1.php', 'Consúltalo en la página oficial (se abre en ventana nueva)',array('class'=>'smaller','target'=>'_blank')); ?></p>
		</div>
		<div class="form-group">
			<?php echo Form::label('Convenio colectivo', 'convenio', array('class'=>'control-label')); ?>
			<?php echo Form::input('convenio', Input::post('convenio', isset($ficha) ? $ficha->convenio : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Convenio colectivo por el que se rige el cliente')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Ubicación de otras sedes', 'otras_sedes', array('class'=>'control-label')); ?>
			<?php echo Form::input('otras_sedes', Input::post('otras_sedes', isset($ficha) ? $ficha->otras_sedes : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Si procede, para saber dónde se encuentran')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Núm. aproximado de trabajadores', 'num_trabajadores', array('class'=>'control-label')); ?>
			<?php echo Form::input('num_trabajadores', Input::post('num_trabajadores', isset($ficha) ? $ficha->num_trabajadores : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Número de trabajadores que el cliente tiene contratados (de manera aproximada)','type'=>'number')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Núm. de equipos informáticos', 'num_equipos', array('class'=>'control-label')); ?>
			<?php echo Form::input('num_equipos', Input::post('num_equipos', isset($ficha) ? $ficha->num_equipos : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Número de equipos informáticos que hay en el cliente','type'=>'number')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('¿Poseen los trabajadores representación legal?', 'representacion_legal', array('class'=>'control-label')); ?>
			<?php echo Form::select('representacion_legal', Input::post('representacion_legal', isset($ficha) ? $ficha->representacion_legal : ''),$rep_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Representacion legal')); ?>
		</div>
		<!--<div class="form-group">
			<?php /*echo Form::label('Fecha de envío del correo de bienvenida', 'fecha_bienvenida', array('class'=>'control-label'));*/ ?>
			<?php /*echo Form::input('fecha_bienvenida', Input::post('fecha_bienvenida', isset($ficha) ? $ficha->fecha_bienvenida : ''), array('class' => 'col-md-4 form-control', 'type'=>'date'));*/ ?>
		</div>
		<div class="form-group">
			<?php /*echo Form::label('Fecha de auditoría', 'fecha_auditoria', array('class'=>'control-label'));*/ ?>
			<?php /*echo Form::input('fecha_auditoria', Input::post('fecha_auditoria', isset($ficha) ? $ficha->fecha_auditoria : ''), array('class' => 'col-md-4 form-control', 'type'=>'date'));*/ ?>
		</div>
        <div class="form-group">
            <?php /*echo Form::label('Fecha de firma del contrato', 'fecha_firma', array('class'=>'control-label'));*/ ?>
            <?php /*echo Form::input('fecha_firma', Input::post('fecha_firma', isset($ficha) ? $ficha->fecha_firma : ''), array('class' => 'col-md-4 form-control', 'type'=>'date'));*/ ?>
        </div>-->
        <div class="form-group">
            <?php echo Form::label('Código IBAN (admite espacios y guiones entre números. Debe empezar por ES)', 'iban', array('class'=>'control-label')); ?>
            <?php echo Form::input('iban', Input::post('iban', isset($ficha) ? $ficha->iban : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'IBAN para las transferencias y pagos')); ?>
        </div>
        <p>Datos requeridos de tipo fecha:</p>
        <table class="table table-striped table-bordered table-r">
            <thead>
            <tr>
                <td><?php echo Form::label('Fecha de envío del correo de bienvenida', 'fecha_bienvenida', array('class'=>'control-label')); ?></td>
                <td><?php echo Form::label('Fecha de auditoría', 'fecha_auditoria', array('class'=>'control-label')); ?></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo Form::input('fecha_bienvenida', Input::post('fecha_bienvenida', isset($ficha) ? $ficha->fecha_bienvenida : ''), array('class' => 'col-md-6 form-control', 'type'=>'date')); ?></td>
                <td><?php echo Form::input('fecha_auditoria', Input::post('fecha_auditoria', isset($ficha) ? $ficha->fecha_auditoria : ''), array('class' => 'col-md-6 form-control', 'type'=>'date')); ?></td>
            </tr>
            </tbody>
        </table>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('ficha_submit', 'Guardar cambios', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>