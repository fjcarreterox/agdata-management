<h2><span class="muted">Clientes</span> en el sistema: <u><?php echo $intro; ?></u></h2>
<br/>
<?php if ($clientes): ?>
    <p>Nº total de clientes en mantenimiento: <strong><?php echo count($clientes); ?></strong></p>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre/Razón social</th>
			<th>Tipo</th>
			<th>CIF/NIF</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($clientes as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo $tipo=Model_Tipo_Cliente::find($item->tipo)->get('tipo'); ?></td>
			<td><?php echo $item->cif_nif; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('clientes/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ficha completa', array('class' => 'btn btn-default')); ?>
						<?php echo Html::anchor('clientes/tareas_mantenimiento/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ficha mantenimiento', array('class' => 'btn btn-info')); ?>
                        <?php echo Html::anchor('clientes/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success'));
                        if(\Fuel\Core\Session::get('idrol')==1){
                            echo Html::anchor('clientes/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer borrar este cliente? Esto conlleva que se borrarán todos sus datos asociados: presupuestos, contratos, servicios contratados, etc.')"));
                        }
                        ?>
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
<br/>
<p><?php echo Html::anchor('clientes/create', '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo cliente', array('class' => 'btn btn-success')); ?>&nbsp;<?php echo Html::anchor('clientes/index', '<span class="glyphicon glyphicon-eye-open"></span> Ver listado completo de clientes', array('class' => 'btn btn-default')); ?></p>