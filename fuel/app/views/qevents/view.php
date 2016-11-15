<h2>Mostrando detalle del evento seleccionado</h2>
<br/>
<?php
$type_ops = array(
    "N/D" => "-- NO DEFINIDO --",
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
    "N/D" => "-- NO DEFINIDO --",
    "hotel" => "Hotel",
    "emblema" => "Lugar emblemático de la ciudad",
    "propias" => "Estancias propias",
    "sala" => "Sala de reunión",
    "restaurante" => "Restaurante / Club",
    "finca" => "Finca rústica",
    "otro" => "Otro",
);
$media_ops = array(
    "N/D" => "-- NO DEFINIDO --",
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
    "N/D" => "-- NO DEFINIDO --",
    "azafatas" => "Azafatas",
    "ponentes" => "Ponentes",
    "transporte" => "Transporte",
    "catering" => "Catering",
    "foto" => "Fotografía",
    "otro" => "Otro",
);
?>
<p>
	<strong>Tipo de evento:</strong>
	<?php echo $type_ops[$qevent->type]; ?></p>
<p>
	<strong>Audiencia destino:</strong>
	<?php echo $qevent->target_audience; ?></p>
<p>
	<strong>Fecha y hora elegidas:</strong>
	<?php echo $qevent->date_time; ?></p>
<p>
	<strong>Localización elegida:</strong>
	<?php echo $loc_ops[$qevent->location]; ?></p>
<p>
	<strong>Medio de difusión elegido:</strong>
	<?php echo $media_ops[$qevent->broadcast]; ?></p>
<p>
	<strong>Material necesario para el evento:</strong>
	<?php echo $material_ops[$qevent->resources]; ?></p>
<p>
	<strong>Servicios complementarios:</strong>
	<?php echo $services_ops[$qevent->complementary_services]; ?></p>
<p>
    <strong>Observaciones:</strong>
    <?php echo $qevent->observ; ?></p>
<br/>
<?php echo Html::anchor('qevents/edit/'.$qevent->id, '<span class="glyphicon glyphicon-pencil"></span> Editar datos del evento',array("class"=>"btn btn-success")); ?>&nbsp;
<?php echo Html::anchor('clientes/view/'.$qevent->idcustomer, '<span class="glyphicon glyphicon-backward"></span> Volver a la ficha de cliente',array("class"=>"btn btn-danger")); ?>