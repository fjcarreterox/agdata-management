<?php
$tratamiento_ops = array("Sr.","Sra.","D.","Dª");
$title="";
$button_text="Añadir nuevo trabajador en el sistema";
if(isset($nombre_cliente)){
    $title=" asociado al cliente ".$nombre_cliente;
    $button_text="Añadir nuevo trabajador para este cliente";
}
?>
<h2>Listado de <span class='muted'>Personal</span> <?php echo $title; ?></h2>
<br/>
<p><?php echo Html::anchor('personal/create', '<span class="glyphicon glyphicon-plus"></span> '.$button_text, array('class' => 'btn btn-success')); ?></p>
<br/>
<?php if ($personal): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre completo</th>
            <th>Cliente</th>
			<th>Relación con nosotros</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($personal as $item):
                $t="";
                if($item->tratamiento!=null){$t = $tratamiento_ops[$item->tratamiento];}?>
    <tr>
			<td><?php echo $t." ".$item->nombre; ?></td>
			<td><?php echo Model_Cliente::find($item->idcliente)->get('nombre'); ?></td>
			<td><?php echo Model_Relacion::find($item->relacion)->get('nombre'); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('personal/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver datos', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('personal/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('personal/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer borrarlo?')")); ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
    <p>No se han encontrado aún trabajadores registrados de ningún tipo.</p>
<?php endif; ?>
<p><?php echo Html::anchor('personal/create', '<span class="glyphicon glyphicon-plus"></span> '.$button_text, array('class' => 'btn btn-success')); ?></p>
