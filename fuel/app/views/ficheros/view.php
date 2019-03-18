<h2>Mostrando detalle del <span class='muted'>fichero de datos</span> seleccionado</h2>
<br/>
<?php
$soporte_ops = array(
    "digital"=>"En formato digital",
    "papel"=>"En papel",
    "mixto"=>"Mixto"
);

$base_ops = array(
    "consent"=>"Consentimiento del interesado",
    "interes"=>"Interés legítimo",
    "ejecucion"=>"Ejecución de un contrato"
);
$origen_ops = array(
    "propio"=>"El propio interesado o su representante legal",
    "fuentes"=>"Fuentes accesibles al público",
    "entpriv"=>"Entidades privadas",
    "entpub"=>"Entidades públicas"
);
$recogida_ops = array(
    "personalmente"=>"Personalmente",
    "forms"=>"Formularios",
    "email"=>"E-mail",
    "internet"=>"Internet"
);
$boolean_ops = array( "0"=>"NO","1"=>"SÍ");

$niveles_ops = array("NO ESPECIFICADO","Básico","Medio","Alto");
?>
<p>
    <strong>Cliente al que pertenece:</strong>
    <?php echo Model_Cliente::find($fichero->idcliente)->get('nombre'); ?></p>
<br/>
<ul>
	<li><strong>Tipo de fichero:</strong>
	<?php echo Model_Tipo_Fichero::find($fichero->idtipo)->get('tipo'); ?></li>
    <li><strong>Finalidad del fichero:</strong>
    <?php echo Model_Tipo_Fichero::find($fichero->idtipo)->get('finalidad'); ?></li>
    <li><strong>Soporte en el que se almacena:</strong>
	<?php echo $soporte_ops[$fichero->soporte]; ?></li>
    <li><strong>Nivel de seguridad:</strong>
    <?php
        switch($fichero->nivel) {
            case 1: echo "Básico";break;
            case 2: echo "Medio";break;
            case 3: echo "Alto";break;
            default: echo "-- NO ESPECIFICADO --";
        }
    ?></li>
    <li><strong>Base de legitimación:</strong>
	<?php
        if($fichero->base){echo $base_ops[$fichero->base];}
        else{ echo "N/D";}
         ?></li>
    <li><strong>Origen de los datos:</strong>
	<?php
        if($fichero->origen){echo $origen_ops[$fichero->origen];}
        else{echo "N/D";}
         ?></li>
    <li><strong>Procedimiento de recogida de datos:</strong>
    <?php
        if($fichero->recogida){echo $recogida_ops[$fichero->recogida];}
        else{echo "N/D";}
    ?></li>
    <li><strong>Transferencias internacionales de datos:</strong>
    <?php echo $boolean_ops[$fichero->trans]; ?></li>
</ul>
<br/>
<?php echo Html::anchor('ficheros/edit/'.$fichero->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('clientes/view/'.$fichero->idcliente, '<span class="glyphicon glyphicon-backward"></span> Volver a la ficha del cliente', array('class'=>'btn btn-danger')); ?>