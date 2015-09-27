<h2>Listado de <span class='muted'>personal</span> de <b>todos los clientes</b></h2>
<br/>
<?php if ($personals): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>DNI</th>
            <th>Cliente</th>
			<th>Relación con AGDATA</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($personals as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo $item->dni; ?></td>
            <td><?php echo Model_Cliente::find($item->idcliente)->get('nombre'); ?></td>
			<td><?php echo Model_Relacion::find($item->relacion)->get('nombre'); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('personal/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('personal/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span>  Editar', array('class' => 'btn btn-success')); ?>
                        <?php
                            if($item->relacion == 5) { //If aaff
                                echo Html::anchor('clientes/comunidades_aaff/' . $item->id, '<span class="glyphicon glyphicon-home"></span> Ver comunidades', array('class' => 'btn btn-info'));
                            }?>
                        <?php echo Html::anchor('personal/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>No se ha encontrado Personal de cliente.</p>
<?php endif; ?>
<p><?php echo Html::anchor('personal/create', 'Añadir más Personal', array('class' => 'btn btn-success')); ?></p>
