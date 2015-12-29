<h2>Detalle del <span class='muted'>evento</span> seleccionado de la Agenda</h2>
<br/>
<p>
	<strong>Cliente:</strong>
	<?php echo Model_Cliente::find($agenda->idcliente)->get('nombre'); ?></p>
<p>
    <strong>Tipo de evento:</strong>
    <?php
        $tipo_ops = array("-- NO ESPECIFICADO --","visita","llamada","auditoría");
        echo $tipo_ops[$agenda->tipo];
    ?></p>
<p>
    <strong>Fecha y hora del evento:</strong>
    <?php echo date_conv($agenda->fecha)." a las ".$agenda->hora; ?></p>
<p>
    <strong>Información comercial enviada:</strong>
    <?php
    if($agenda->send_info) {
        echo "SÍ";
    }else{
        echo "NO";
    }?></p>
<p>
    <strong>Observaciones:</strong>
    <?php echo $agenda->observaciones; ?></p>
<br/>
<?php echo Html::anchor('agenda/edit/'.$agenda->id, '<span class="glyphicon glyphicon-pencil"></span> Editar evento',array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('agenda', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de visitas',array('class'=>'btn btn-danger')); ?>