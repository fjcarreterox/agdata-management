<h2>Listado de todas las <span class='muted'>Cesiones de ficheros de datos</span> registradas en el sistema</h2>
<br>
<?php if ($cesiones): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Cliente</th>
			<th>Empresa cesionaria</th>
			<th>Representante legal</th>
			<th>Fecha firma contrato</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($cesiones as $item): ?>		<tr>

			<td><?php echo Model_Cliente::find($item->idcliente)->get('nombre'); ?></td>
			<td><?php
                $c = Model_Cliente::find($item->idcesionaria);
                if($c != NULL){echo $c->get('nombre');}
                    else{echo "NO DISPONIBLE";}
                ?></td>
			<td><?php
                $r = Model_Personal::find($item->idrep);
                if($r != NULL){echo $r->get('nombre');}
                else{echo "NO DISPONIBLE";}
                ?></td>
			<td><?php echo date_conv($item->fecha_contrato); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('cesiones/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('cesiones/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('cesiones/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar cesión', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
                    </div>
				</div>

			</td>
		</tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p>No se han registrado Cesiones de ficheros aún.</p>
<?php endif; ?>
