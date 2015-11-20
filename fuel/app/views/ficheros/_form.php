<?php
    $tipos_array = array();
    foreach($tipos as $t){
        $tipos_array[$t->get('id')] = $t->get('tipo')." (".$t->get('finalidad').")";
    }
    $ubicacion_ops = array(
                        "no"=>"No conectado",
                        "sobremesa"=>"En un equipo de sobremesa",
                        "laptop"=>"En un equipo portátil",
                        "servidor"=>"En un servidor"
                        );
    $soporte_ops = array(
                        "digital"=>"En formato digital",
                        "papel"=>"En papel",
                        "mixto"=>"Mixto"
                    );
    $boolean_ops = array( "0"=>"NO","1"=>"SÍ");

    $niveles_ops = array("NO ESPECIFICADO","Básico","Medio","Alto");

echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Tipo de fichero (finalidad)', 'idtipo', array('class'=>'control-label')); ?>
			<?php echo Form::select('idtipo', Input::post('idtipo', isset($fichero) ? $fichero->idtipo : ''),$tipos_array, array('class' => 'col-md-4 form-control')); ?>
		</div>
        <?php echo Form::input('idcliente', Input::post('idcliente', isset($fichero) ? $fichero->idcliente : $idcliente), array('class' => 'col-md-4 form-control', 'type'=>'hidden')); ?>
		<div class="form-group">
			<?php echo Form::label('Ubicación del fichero', 'ubicacion', array('class'=>'control-label')); ?>
			<?php echo Form::select('ubicacion', Input::post('ubicacion', isset($fichero) ? $fichero->ubicacion : ''),$ubicacion_ops, array('class' => 'col-md-4 form-control', 'placeholder'=>'Ubicacion')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Soporte en el que se almacena', 'soporte', array('class'=>'control-label')); ?>
			<?php echo Form::select('soporte', Input::post('soporte', isset($fichero) ? $fichero->soporte : ''),$soporte_ops, array('class' => 'col-md-4 form-control')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Nivel de seguridad', 'nivel', array('class'=>'control-label')); ?>
            <?php echo Form::select('nivel', Input::post('nivel', isset($fichero) ? $fichero->nivel : ''),$niveles_ops, array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="form-group">
			<?php echo Form::label('Inscrito en la AEPD', 'inscrito', array('class'=>'control-label')); ?>
			<?php echo Form::select('inscrito', Input::post('inscrito', isset($fichero) ? $fichero->inscrito : ''),$boolean_ops, array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Fecha de inscripción', 'fecha', array('class'=>'control-label')); ?>
			<?php echo Form::input('fecha', Input::post('fecha', isset($fichero) ? $fichero->fecha : ''), array('class' => 'col-md-4 form-control', 'type'=>'date')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Cesión del fichero a terceros', 'cesion', array('class'=>'control-label')); ?>
			<?php echo Form::select('cesion', Input::post('cesion', isset($fichero) ? $fichero->cesion : ''),$boolean_ops, array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar cambios', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>