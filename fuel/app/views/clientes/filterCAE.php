<h2>Listado de <span class="muted">Clientes</span> en el sistema: <u><?php echo $intro; ?></u></h2>
<br/>
<?php if ($clientes): ?>
    <p>Nº total de clientes: <strong><?php echo count($clientes); ?></strong></p>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre/Razón social</th>
			<th>Admon.Fincas Asociado</th>
			<th>Contrata Asociada</th>
			<th>Fecha envío de informe</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($clientes as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td><?php
                $af=Model_Rel_Comaaff::find_by_idcom($item->id);
                if($af!=null){
                    echo Model_Cliente::find_by_id($af->idaaff)->get('nombre');
				}
				else{
					echo '<span class="red">N/D</span>';
				}
                ?></td>
			<?php
                $cont=Model_Rel_Comcont::find_by_idcom($item->id);
				if($cont != null){
					echo "<td>".Model_Cliente::find_by_id($cont->idcontrata)->get('nombre')."</td>";
					echo "<td>".date_conv($cont->get('fechaenvio'))."</td>";
				}
				else{
					echo "<td>-- N/D --</td>";
					echo "<td>-- N/D --</td>";
				}
				?>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('clientes/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ficha completa', array('class' => 'btn btn-default','target' => '_blank')); ?>
						<?php /*echo Html::anchor('clientes/tareas_mantenimiento/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ficha mantenimiento', array('class' => 'btn btn-info'));*/ ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<p>No se han encontrado clientes que cumplan los criterios de búsqueda establecidos.</p>
<?php endif; ?>