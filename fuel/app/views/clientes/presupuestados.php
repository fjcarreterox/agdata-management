<h2><span class='muted'>Clientes presupuestados</span> existentes en el sistema</h2>
<br>
<?php if ($clientes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre/Razón social</th>
			<th>Tipo</th>
			<!--<th>Persona de contacto</th>-->
			<th>Teléfono de contacto</th>
			<th>Estado del presupuesto</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($clientes as $item):

    $pptos=Model_Presupuesto::find('all',array('where'=>array('idcliente'=>$item->id)));
    if(count($pptos)==1){ //Just one budget
        $ppto = array_pop($pptos);
        $state = $ppto->get('idestado');
        $btn = Html::anchor('presupuesto/view/'.$ppto->get('id'), '<span class="glyphicon glyphicon-file"></span> Ver presupuesto', array('class' => 'btn btn-info'));
    }
    elseif(count($pptos)>1){
        $state = "VARIOS PPTOS.";
        $btn=Html::anchor('presupuesto/view_all/'.$item->id, '<span class="glyphicon glyphicon-file"></span> Ver presupuestos', array('class' => 'btn btn-info'));
    }
    else{
        $state = 0;
        $btn=Html::anchor('presupuesto/create/', '<span class="glyphicon glyphicon-plus"></span> Crear presupuesto', array('class' => 'btn btn-info'));
    }
    ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo Model_Tipo_Cliente::find($item->tipo)->get('tipo'); ?></td>
            <!--<td></td>-->
            <td><?php echo $item->tel; ?></td>
            <td><?php
                    if($state > 0){ echo Model_Estados_Presupuesto::find($state)->get('nombre');}
                    else{ echo "<span class='red'>NO CREADO AÚN</span>";}
                ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('clientes/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ficha completa', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('clientes/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php echo $btn; ?>
                    </div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<p>No se han encontrado clientes aún.</p>

<?php endif; ?>
<p><?php echo Html::anchor('clientes/create', '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo cliente', array('class' => 'btn btn-success')); ?></p>