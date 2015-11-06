<h2>Listado de <span class='muted'>servicios</span> que ofrecemos actualmente</h2>
<br/>
<?php if ($servicios): ?>
    <p>Dado que todo el sistema está basado en los servicios actualmente prestados, si en el futuro se necesita añadir o
    quitar algún servicio, deberá ser notificado al administrador de la aplicación.</p>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre del servicio ofrecido</th>
			<th>Precio base</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($servicios as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo $item->precio_base; ?> &euro;</td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('servicios/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar datos del servicio', array('class' => 'btn btn-success')); ?>
                        <?php /*echo Html::anchor('servicios/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar servicio', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro?')"));*/ ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>No se han encontrado aún servicios definidos en el sistema.</p>
<?php endif; ?><p>
	<?php echo Html::anchor('servicios/create', '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo servicio', array('class' => 'btn btn-success')); ?>

</p>
