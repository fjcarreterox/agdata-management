<h2>Listado de <span class='muted'>servicios contratados</span>: <strong><?php echo $title;?></strong></h2>
<p>A continuación se muestran los datos básicos de los servicios contratados encontrados en el sistema con sus criterios de búsqueda. Para modificar algún servicio
    contratado concreto asociado a un contrato, accede primero a la <strong>Vista Detalle</strong> del contrato y desde ahí podrás <i>añadir,
        editar o eliminar</i> <strong>servicios contratados</strong>.</p>

<br/>
<p><?php echo Html::anchor('contrato/month_search', '<span class="glyphicon glyphicon-search"></span> Buscar otra fecha', array('class' => 'btn btn-warning')); ?></p>
<?php if ($services): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Cliente</th>
			<th>Cuota</th>
			<th>Método de pago</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($services as $item): ?>
        <tr>
			<td><?php $idc = Model_Contrato::find($item->idcontrato)->get('idcliente');
                echo Model_Cliente::find($idc)->get('nombre'); ?></td>
			<td><?php echo $item->cuota; ?> &euro;</td>
			<td><?php echo $item->forma_pago; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('contrato/view/'.$item->idcontrato, '<span class="glyphicon glyphicon-eye-open"></span> Ver detalle de contrato', array('class' => 'btn btn-default','target'=>'_blank')); ?>
						<?php echo Html::anchor('clientes/view/'.$idc, '<span class="glyphicon glyphicon-eye-open"></span> Ficha cliente', array('class' => 'btn btn-default','target'=>'_blank')); ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<p>No hay contratos aún registrados en el sistema.</p>
<?php endif; ?>
<p><?php echo Html::anchor('contrato/month_search', '<span class="glyphicon glyphicon-search"></span> Buscar otra fecha', array('class' => 'btn btn-warning')); ?></p>
