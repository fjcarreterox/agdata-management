<h2>Mostrando detalle del <span class='muted'>presupuesto</span> seleccionado</h2>
<br/>
<p>
	<strong>Núm. presupuesto:</strong>
	<?php echo $presupuesto->num_p; ?></p>
<p>
	<strong>Cliente:</strong>
	<?php echo Model_Cliente::find($presupuesto->idcliente)->get('nombre'); ?></p>
<p>
    <strong>Fecha de creación:</strong>
    <?php echo date(' H:i \d\e\l d-m-Y',$presupuesto->created_at); ?></p>
<p>
	<strong>Fecha de entrega:</strong>
	<?php echo date_conv($presupuesto->fecha_entrega); ?></p>
<p>
    <strong>Servicios ofertados:</strong>
    <?php echo Model_Servicio::find($presupuesto->servicios)->get('nombre')." LOPD"; ?></p>
<p>
    <strong>Importe total:</strong>
    <?php echo $presupuesto->importe; ?> &euro;</p>
<p>
	<strong>Estado:</strong>
	<?php echo Model_Estados_Presupuesto::find($presupuesto->idestado)->get('nombre'); ?></p>
<p>
    <strong>Observaciones:</strong>
    <?php echo $presupuesto->observaciones; ?></p>
<br/>
<?php echo Html::anchor('presupuesto/edit/'.$presupuesto->id, 'Editar',array('class'=>'btn btn-success')); ?>&nbsp;&nbsp;
<?php echo Html::anchor('presupuesto', 'Volver al listado',array('class'=>'btn btn-danger')); ?>