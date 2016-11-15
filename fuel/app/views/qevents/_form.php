<?php
$type_ops = array(
    "N/D" => "-- SELECCIONA TIPO --",
    "comida" => "Comida/Cena de empresa",
    "marca" => "Evento corporativo para conocer la marca",
    "producto" => "Evento corporativo para presentar un producto",
    "premios" => "Evento de entrega de premios para personal",
    "diplomas" => "Evento de entrega de diplomas formativos",
    "obsequios" => "Evento de obsequios a clientes",
    "sorteo" => "Evento de sorteos o promociones",
    "colaborativo" => "Evento colaborativo con otra empresa",
    "formacion" => "Jornada de formación",
    "abiertas" => "Jornada de puertas abiertas",
    "ocio" => "Actividades de ocio para el personal",
    "prensa" => "Ruedas de prensa",
    "otro" => "Otro",
);
$loc_ops = array(
    "N/D" => "-- SELECCIONA LOCALIZACIÓN --",
    "hotel" => "Hotel",
    "emblema" => "Lugar emblemático de la ciudad",
    "propias" => "Estancias propias",
    "sala" => "Sala de reunión",
    "restaurante" => "Restaurante / Club",
    "finca" => "Finca rústica",
    "otro" => "Otro",
);
$media_ops = array(
    "N/D" => "-- SELECCIONA MEDIO --",
    "invitaciones" => "Invitaciones personalizadas on-line",
    "carteleria" => "Cartelería",
    "buzoneo" => "Buzoneo",
    "correo" => "Invitación por correo ordinario",
    "social" => "Redes Sociales",
    "medios" => "Medios de comunicación",
    "otro" => "Otro",
);
$material_ops = array(
    "N/D" => "-- SELECCIONA MATERIAL --",
    "enara" => "Enaras",
    "carteleria" => "Cartelería",
    "propio" => "Material corporativo propio (tarjetas, carpetas,...)",
    "merchandising" => "Merchandising",
    "photo" => "Photocall",
    "otro" => "Otro",
);
$services_ops = array(
    "N/D" => "-- SELECCIONA SERVICIO COMPLEMENTARIO --",
    "azafatas" => "Azafatas",
    "ponentes" => "Ponentes",
    "transporte" => "Transporte",
    "catering" => "Catering",
    "foto" => "Fotografía",
    "otro" => "Otro",
);
echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
        <?php echo Form::input('idcustomer', Input::post('idcustomer', isset($qevent) ? $qevent->idcustomer : $idc),array('type'=>'hidden')); ?>
        <div class="form-group">
			<?php echo Form::label('¿Qué tipo de evento sería?', 'type', array('class'=>'control-label')); ?>
			<?php echo Form::select('type', Input::post('type', isset($qevent) ? $qevent->type : ''),$type_ops, array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('¿Cuál es el público objetivo que debe asistir (ocupación, edad, colectivo…)?', 'target_audience', array('class'=>'control-label')); ?>
			<?php echo Form::textarea('target_audience', Input::post('target_audience', isset($qevent) ? $qevent->target_audience : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Público al que irá dirigido principalmente el evento','rows'=> 4)); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Fecha y horario deseados', 'date_time', array('class'=>'control-label')); ?>
			<?php echo Form::textarea('date_time', Input::post('date_time', isset($qevent) ? $qevent->date_time : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Anota aquí la hora y la fecha en la que se desea realizar el evento','rows' => 4)); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('¿Dónde se desea realizar?', 'location', array('class'=>'control-label')); ?>
			<?php echo Form::select('location', Input::post('location', isset($qevent) ? $qevent->location : ''),$loc_ops, array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('¿Qué medios de difusión se precisan?', 'broadcast', array('class'=>'control-label')); ?>
			<?php echo Form::select('broadcast', Input::post('broadcast', isset($qevent) ? $qevent->broadcast : ''), $media_ops, array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Material necesario para evento', 'resources', array('class'=>'control-label')); ?>
			<?php echo Form::select('resources', Input::post('resources', isset($qevent) ? $qevent->resources : ''), $material_ops, array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Servicios complementarios a gestionar por ComunicaG con colaboradores propios (si no son aportados por el cliente):', 'complementary_services', array('class'=>'control-label')); ?>
			<?php echo Form::select('complementary_services', Input::post('complementary_services', isset($qevent) ? $qevent->complementary_services : ''), $services_ops, array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Observaciones / Comentarios', 'observ', array('class'=>'control-label')); ?>
            <?php echo Form::textarea('observ', Input::post('observ', isset($qevent) ? $qevent->observ : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Observaciones / Comentarios','rows' => 8)); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-disk"></span> Guardar datos', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>