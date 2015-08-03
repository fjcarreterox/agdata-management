<h2>Detalle de agenda para el <span class='muted'>cliente</span> seleccionado</h2>

<p>
	<strong>Cliente:</strong>
	<?php echo Model_Cliente::find($agenda->idcliente)->get('nombre'); ?></p>
<p>
	<strong>Última llamada:</strong>
	<?php echo $agenda->last_call; ?></p>
<p>
	<strong>Próxima llamada:</strong>
	<?php echo $agenda->next_call; ?></p>
<p>
	<strong>Última visita:</strong>
	<?php echo $agenda->last_visit; ?></p>
<p>
	<strong>Próxima visita:</strong>
	<?php echo $agenda->next_visit; ?></p>
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

<?php echo Html::anchor('agenda/edit/'.$agenda->id, 'Editar'); ?> |
<?php echo Html::anchor('agenda', 'Volver'); ?>