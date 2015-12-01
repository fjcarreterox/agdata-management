<h2>Mostrando detalle del <span class='muted'>servicio contratado</span> seleccionado</h2>
<br/>
<p>
	<strong>Identificador del contrato asociado:</strong>
	<?php echo Html::anchor('contrato/view/'.$servicios_contratado->idcontrato, 'Contrato nº'.$servicios_contratado->idcontrato );?></p>
<p>
	<strong>Tipo de servicio:</strong>
	<?php echo Model_Servicio::find($servicios_contratado->idtipo_servicio)->get('nombre'); ?></p>
<p>
	<strong>Importe:</strong>
	<?php echo $servicios_contratado->importe; ?> &euro;</p>
<p>
	<strong>Año de contratación:</strong>
	<?php echo $servicios_contratado->year; ?></p>
<p>
	<strong>Mes de comienzo de factura:</strong>
	<?php echo $servicios_contratado->mes_factura; ?></p>
<p>
	<strong>Periodicidad de pago:</strong>
	<?php echo $servicios_contratado->periodicidad; ?></p>
<p>
	<strong>Cuota a pagar:</strong>
	<?php echo $servicios_contratado->cuota; ?> &euro;</p>
<p>
	<strong>Forma pago:</strong>
	<?php echo $servicios_contratado->forma_pago; ?></p>
<br/>
<?php echo Html::anchor('servicios/contratados/edit/'.$servicios_contratado->id, '<span class="glyphicon glyphicon-pencil"></span> Editar servicio',array('class'=>'btn btn-success')); ?>&nbsp;&nbsp;
<?php echo Html::anchor('contrato/view/'.$servicios_contratado->idcontrato, '<span class="glyphicon glyphicon-backward"></span> Volver al contrato',array('class'=>'btn btn-danger')); ?>