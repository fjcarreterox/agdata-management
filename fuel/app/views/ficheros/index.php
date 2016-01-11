<h2>Lsitado con todos los <span class='muted'>ficheros</span> de datos existentes en el sistema</h2>
<br/>
<?php if ($ficheros): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Tipo de fichero</th>
            <th>Finalidad</th>
			<th>Soporte</th>
			<th>Nivel de Seguridad</th>
			<th>Inscrito en la AEPD</th>
			<th>Fecha de inscripción</th>
			<th>Cesión a terceros</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($ficheros as $item): ?>
        <tr>
            <td><?php echo Model_Tipo_Fichero::find($item->idtipo)->get('tipo'); ?></td>
            <td><?php echo Model_Tipo_Fichero::find($item->idtipo)->get('finalidad'); ?></td>
			<td><?php echo $item->soporte; ?></td>
			<td><?php
                switch($item->nivel) {
                    case 1: echo "Básico";break;
                    case 2: echo "Medio";break;
                    case 3: echo "Alto";break;
                    default: echo "-- NO ESPECIFICADO --";
                }
                ?></td>
			<td><?php if($item->inscrito){echo "SÍ";}else{echo "NO";}; ?></td>
			<td><?php echo date_conv($item->fecha); ?></td>
			<td><?php if($item->cesion){echo "SÍ";}else{echo "NO";}; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('ficheros/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('ficheros/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('ficheros/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer eliminarlo?')")); ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>
<?php else: ?>
    <p>No se han encontrado aún ficheros registrados en el sistema.</p>
<?php endif; ?>