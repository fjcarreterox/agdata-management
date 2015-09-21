<h2>Detalle de agenda para el <span class='muted'>cliente</span> seleccionado</h2>
<br/>
<p>
	<strong>Cliente:</strong>
	<?php echo Model_Cliente::find($agenda->idcliente)->get('nombre'); ?></p>
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

<table class="table table-responsive table-striped table-bordered">
    <thead>
        <tr>
            <td>&nbsp;</td>
            <td><strong>Última</strong></td>
            <td><strong>Próxima</strong></td>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td><strong>Llamada</strong></td>
        <td><?php echo date_conv($agenda->last_call); ?></td>
        <td><?php echo date_conv($agenda->next_call); ?></td>
    </tr>
    <tr>
        <td><strong>Visita</strong></td>
        <td><?php echo date_conv($agenda->last_visit); ?></td>
        <td><?php echo date_conv($agenda->next_visit); ?></td>
    </tr>
    </tbody>
</table>
<?php echo Html::anchor('agenda/edit/'.$agenda->id, '<span class="glyphicon glyphicon-pencil"></span> Editar datos',array('class'=>'btn btn-success')); ?>&nbsp;
<?php echo Html::anchor('agenda', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?>