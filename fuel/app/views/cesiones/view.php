<h2>Mostrando detalle de la  <span class='muted'>cesión de fichero de datos</span> seleccionada</h2>
<br/>
<p>
	<strong>Cliente que cede el fichero:</strong>
	<?php echo Model_Cliente::find($cesione->idcliente)->get('nombre'); ?></p>
<p>
	<strong>Empresa cesionaria:</strong>
	<?php echo Html::anchor('clientes/view/'.$cesione->idcesionaria, Model_Cliente::find($cesione->idcesionaria)->get('nombre'),array("title"=>"Se abre en una ventana nueva...","target"=>"_blank")); ?></p>
<p>
	<strong>Representante legal:</strong>
	<?php
        $r = Model_Personal::find($cesione->idrep);
        if($r != null){ echo $r->get('nombre');}
        else{echo "-- NO DISPONIBLE --";}
    ?></p>
<p>
	<strong>Fecha de firma del contrato de cesión:</strong>
	<?php echo date_conv($cesione->fecha_contrato); ?></p>
<br/>
<?php echo Html::anchor('cesiones/edit/'.$cesione->id, '<span class="glyphicon glyphicon-pencil"></span> Editar',array("class"=>"btn btn-success")); ?>&nbsp;
<?php echo Html::anchor('clientes/view/'.$cesione->idcliente, '<span class="glyphicon glyphicon-backward"></span> Volver a la Ficha del cliente',array("class"=>"btn btn-danger")); ?>