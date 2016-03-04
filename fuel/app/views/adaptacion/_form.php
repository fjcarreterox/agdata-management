<?php
$pass_ops = array(
    "No especificado"=>"No especificado",
    "Semanal"=>"Semanal",
    "Mensual"=>"Mensual",
    "Trimestral"=>"Trimestral",
    "Semestral"=>"Semestral",
    "Anual"=>"Anual",
    "Nunca"=>"Nunca"
                );

$bool_ops = array("NO","SÍ");

echo Form::open(array("class"=>"form-horizontal")); ?>
    <table class="table table-striped table-bordered table-hover table-responsive">
        <tbody>
            <tr class="text-left">
                <td><?php echo Form::label('Núm. de servidores de datos', 'num_serv', array('class'=>'control-label')); ?></td>
                <td><?php echo Form::input('num_serv', Input::post('num_serv', isset($adaptacion) ? $adaptacion->num_serv : 0), array('class' => 'col-md-4 form-control', 'type'=>'number')); ?></td>
            </tr>
            <tr class="text-left">
                <td><?php echo Form::label('Núm. de equipos de sobremesa', 'num_pc', array('class'=>'control-label')); ?></td>
                <td><?php echo Form::input('num_pc', Input::post('num_pc', isset($adaptacion) ? $adaptacion->num_pc : 0), array('class' => 'col-md-4 form-control', 'type'=>'number')); ?></td>
            </tr>
            <tr class="text-left">
                <td><?php echo Form::label('Núm. de equipos de sobremesa conectados a un servidor', 'num_pc_online', array('class'=>'control-label')); ?></td>
                <td><?php echo Form::input('num_pc_online', Input::post('num_pc_online', isset($adaptacion) ? $adaptacion->num_pc_online : 0), array('class' => 'col-md-4 form-control', 'type'=>'number')); ?></td>
            </tr>
            <tr class="text-left">
                <td><?php echo Form::label('Núm. de equipos portátiles', 'num_laptop', array('class'=>'control-label')); ?></td>
                <td><?php echo Form::input('num_laptop', Input::post('num_laptop', isset($adaptacion) ? $adaptacion->num_laptop : 0), array('class' => 'col-md-4 form-control', 'type'=>'number')); ?></td>
            </tr>
            <tr class="text-left">
                <td><?php echo Form::label('Núm. de equipos portátiles conectados a un servidor', 'num_laptop_online', array('class'=>'control-label')); ?></td>
                <td><?php echo Form::input('num_laptop_online', Input::post('num_laptop_online', isset($adaptacion) ? $adaptacion->num_laptop_online : 0), array('class' => 'col-md-4 form-control', 'type'=>'number')); ?></td>
            </tr>
        </tbody>
    </table>

	<fieldset>
        <?php echo Form::input('idcliente', Input::post('idcliente', isset($adaptacion) ? $adaptacion->idcliente : $idcliente), array('class' => 'col-md-4 form-control', 'type'=>'hidden')); ?>
		<div class="form-group">
			<?php echo Form::label('¿Con qué frecuencia se realizan cambios de constraseñas en los equipos?', 'pass_freq', array('class'=>'control-label')); ?>
			<?php echo Form::select('pass_freq', Input::post('pass_freq', isset($adaptacion) ? $adaptacion->pass_freq : ''), $pass_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Pass freq')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('¿Con qué frecuencia se realizan copias de seguridad de los equipos?', 'backup_freq', array('class'=>'control-label')); ?>
			<?php echo Form::select('backup_freq', Input::post('backup_freq', isset($adaptacion) ? $adaptacion->backup_freq : ''),$pass_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Backup freq')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('¿Se emplea algún software de gestión para almacenar datos de carárter personal? (Vacío si no aplica)', 'management_sw', array('class'=>'control-label')); ?>
			<?php echo Form::input('management_sw', Input::post('management_sw', isset($adaptacion) ? $adaptacion->management_sw : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Indique el nombre de software de gestión')); ?>
    	</div>
		<div class="form-group">
			<?php echo Form::label('¿Hay algún tipo de control de acceso a los ficheros de datos?', 'access_control', array('class'=>'control-label')); ?>
			<?php echo Form::input('access_control', Input::post('access_control', isset($adaptacion) ? $adaptacion->access_control : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Indique el tipo de control de acceso utilizado')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('¿Se almacenan datos de afiliación sindical para realizar los pagos de las cuotas?', 'afiliacion', array('class'=>'control-label')); ?>
            <?php echo Form::select('afiliacion', Input::post('afiliacion', isset($adaptacion) ? $adaptacion->afiliacion : ''), $bool_ops, array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('¿Se recaban datos de salud de los empleados?', 'salud', array('class'=>'control-label')); ?>
            <?php echo Form::select('salud', Input::post('salud', isset($adaptacion) ? $adaptacion->salud : ''), $bool_ops, array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('¿Existe para ello consentimiento por escrito del empleado?', 'consentimiento', array('class'=>'control-label')); ?>
            <?php echo Form::select('consentimiento', Input::post('consentimiento', isset($adaptacion) ? $adaptacion->consentimiento : ''), $bool_ops, array('class' => 'col-md-4 form-control')); ?>
        </div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar datos de auditoría', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>