<h2>Mostrando detalle del <span class='muted'>fichero de datos</span> seleccionado</h2>
<br/>
<p>
    <strong>Cliente al que pertenece:</strong>
    <?php echo Model_Cliente::find($fichero->idcliente)->get('nombre'); ?></p>
<br/>
<p>
	<strong>Tipo de fichero:</strong>
	<?php echo Model_Tipo_Fichero::find($fichero->idtipo)->get('tipo'); ?></p>
<p>
    <strong>Finalidad del fichero:</strong>
    <?php echo Model_Tipo_Fichero::find($fichero->idtipo)->get('finalidad'); ?></p>
<p>
	<strong>Soporte en el que se almacena:</strong>
	<?php echo $fichero->soporte; ?></p>
<p>
    <strong>Nivel de seguridad:</strong>
    <?php
        switch($fichero->nivel) {
            case 1: echo "Básico";break;
            case 2: echo "Medio";break;
            case 3: echo "Alto";break;
            default: echo "-- NO ESPECIFICADO --";
        }
    ?></p>
<p>
	<strong>Fecha de inscripción:</strong>
	<?php echo date_conv($fichero->fecha); ?></p>
<p>
	<strong>Cesión a terceros:</strong>
	<?php if($fichero->cesion){echo "SÍ";}else{echo "NO";}; ?></p>
<br/>
<?php echo Html::anchor('ficheros/edit/'.$fichero->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('clientes/view/'.$fichero->idcliente, '<span class="glyphicon glyphicon-backward"></span> Volver a la ficha del cliente', array('class'=>'btn btn-danger')); ?>