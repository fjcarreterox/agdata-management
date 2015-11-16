<h2>Listado de <span class='muted'>contratos</span> registrados en el sistema</h2>
<br>
<?php if ($contratos): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Cliente</th>
			<th>Presupuesto relacionado</th>
			<th>Representante legal</th>
			<th>Fecha firma</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($contratos as $item): ?>
        <tr>
			<td><?php echo Model_Cliente::find($item->idcliente)->get('nombre'); ?></td>
			<td><?php echo Html::anchor('presupuesto/view/'.$item->idpres,'Núm. '.Model_Presupuesto::find($item->idpres)->get('num_p'), array('target'=>'_blank','title'=>'Se abrirá en ventana nueva')); ?></td>
			<td><?php
                if($item->idpersonal != null) {
                    echo Model_Personal::find($item->idpersonal)->get('nombre');
                }
                else{
                    echo '<span class="red">-- AÚN NO ESPECIFICADO --</span>';
                }
                ?></td>
			<td><?php echo date_conv($item->fecha_firma); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('contrato/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver detalle', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('contrato/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar datos', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('contrato/doc/'.$item->id, '<span class="glyphicon glyphicon-file"></span> Vista previa', array('class' => 'btn btn-info')); ?>
                        <?php /*echo Html::anchor('contrato/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar contrato', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer eliminar el contrato?')"));*/ ?>
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
<p>
	<?php echo Html::anchor('contrato/create', '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo contrato', array('class' => 'btn btn-success')); ?>
</p>
