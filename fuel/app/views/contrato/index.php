<h2>Listado de <span class='muted'>contratos</span> registrados en el sistema</h2>
<p>A continuación se muestran los datos básicos de los contratos existentes en el sistema. Para modificar algún servicio
    contratado concreto asociado a un contrato, accede primero a la <strong>Vista Detalle</strong> del contrato y desde ahí podrás <i>añadir,
        editar o eliminar</i> servicios contratados.</p>

<br/>
<p><?php echo Html::anchor('contrato/create', '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo contrato', array('class' => 'btn btn-primary')); ?></p>
<?php if ($contratos): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Cliente</th>
			<th>Tipo contrato</th>
			<th>Representante legal</th>
			<th>Fecha contrato</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($contratos as $item): ?>
        <tr>
			<td><?php
                if(Model_Cliente::find($item->idcliente)){echo Model_Cliente::find($item->idcliente)->get('nombre');}
                else{echo "<span class='red'>CLIENTE NO RECONOCIDO</span> (idcliente: <b>$item->idcliente</b>)";}
                ?></td>
			<td><?php
                $serv=Model_Servicios_Contratado::find('first',array('where'=>array('idcontrato'=>$item->id)));
                if($serv != null){
                    switch($serv->idtipo_servicio){
                        case 1: echo "LOPD";break;
                        case 2: echo "LOPD";break;
                        case 3: echo "GESTORÍA";break;
                        case 4: echo "CD-NEOS";break;
                        case 5: echo "CAE";break;
                    }
                }
                else{
                    echo '<span class="red">N/D</span>';
                }

            ?></td>
			<td><?php
                if($item->idpersonal != 0) {
                    if(Model_Personal::find($item->idpersonal) != null){
                        echo Model_Personal::find($item->idpersonal)->get('nombre');
                    }
                    else{
                        echo '<span class="red">-- NOMBRE NO ESPECIFICADO --</span>';
                    }
                }
                else{
                    echo '<span class="red">-- AÚN NO ESPECIFICADO --</span>';
                }
                ?></td>
			<td><?php echo date_conv($item->fecha_firma); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('contrato/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('contrato/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                        <?php echo Html::anchor('contrato/doc/'.$item->id, '<span class="glyphicon glyphicon-file"></span> Vista previa', array('class' => 'btn btn-info')); ?>
                        <?php echo Html::anchor('contrato/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer eliminar este contrato y sus servicios incluidos?')")); ?>
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
<p><?php echo Html::anchor('contrato/create', '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo contrato', array('class' => 'btn btn-primary')); ?></p>
