<h2><span class='muted'><?php echo $title;?></span> en el sistema</h2>
<br>
<?php if ($facturas): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Cliente</th>
			<th>Núm. factura</th>
			<th>Fecha Cobro</th>
			<th>Estado</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($facturas as $item): ?>
	<tr>
        <td><?php echo Model_Cliente::find(Model_Contrato::find(Model_Servicios_Contratado::find($item->idsc)->get('idcontrato'))->get('idcliente'))->get('nombre'); ?></td>
		<td><?php
            if(strcmp($item->num_fact,"")==0){echo '<span class="red">N/D</span>';}
            else{echo "L".str_pad($item->num_fact, 3, 0, STR_PAD_LEFT)."/".$item->anyo_cobro;} ?></td>
		<td><?php echo getMes($item->mes_cobro)." / ".$item->anyo_cobro; ?></td>
		<td><?php echo $item->estado; ?></td>
		<td>
			<div class="btn-toolbar">
				<div class="btn-group">
                    <?php echo Html::anchor('facturas/issue/'.$item->id, '<span class="glyphicon glyphicon-forward"></span> Emitir', array('class' => 'btn btn-warning'));?>
                    <?php echo Html::anchor('facturas/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Cambiar estado', array('class' => 'btn btn-success'));?>
                    <?php echo Html::anchor('doc/factura/'.$item->id, '<span class="glyphicon glyphicon-file"></span> Imprimir', array('class' => 'btn btn-info','target'=>'_blank')); ?>
                    <?php /*echo Html::anchor('facturas/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')"));*/ ?>
                </div>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
    <p>No se han encontrado facturas con el criterio seleccionado.</p>
    <br/>
<?php endif; ?>
<p><?php echo Html::anchor('facturas', '<span class="glyphicon glyphicon-backward"></span> Volver al menú de facturas', array('class' => 'btn btn-danger')); ?></p>