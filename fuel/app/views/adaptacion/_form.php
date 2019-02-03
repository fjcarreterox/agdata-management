<?php
$pass_ops = array(
    "No especificado"=>"No especificado",
    "Diario"=>"Diario",
    "Semanal"=>"Semanal",
    "Mensual"=>"Mensual",
    "Trimestral"=>"Trimestral",
    "Semestral"=>"Semestral",
    "Anual"=>"Anual",
    "Nunca"=>"Nunca"
);
$store_ops = array(
    "pendrive"=>"Pendrive",
    "disco"=>"Disco duro externo",
    "nube"=>"Servicios en la nube",
    "otros"=>"Otros"
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
			<?php echo Form::select('pass_freq', Input::post('pass_freq', isset($adaptacion) ? $adaptacion->pass_freq : ''), $pass_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Frecuencia de cambio de contraseñas')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('¿Con qué frecuencia se realizan copias de seguridad de los equipos?', 'backup_freq', array('class'=>'control-label')); ?>
			<?php echo Form::select('backup_freq', Input::post('backup_freq', isset($adaptacion) ? $adaptacion->backup_freq : ''),$pass_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Frecuencia de creación de copias de seguridad')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('¿Dónde se almacenan las copias de seguridad?', 'storage', array('class'=>'control-label')); ?>
			<?php echo Form::select('storage', Input::post('storage', isset($adaptacion) ? $adaptacion->storage : ''), $store_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Indique el medio donde se almacenan las copias de seguridad')); ?>
    	</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar datos de auditoría', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>