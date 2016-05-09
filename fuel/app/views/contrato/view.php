<h2>Mostrando detalles del <span class='muted'>contrato</span> seleccionado</h2>
<br/>
<h3>Datos específicos del contrato</h3>
<br/>
<p>
	<strong>Cliente:</strong>
	<?php echo Model_Cliente::find($contrato->idcliente)->get('nombre'); ?></p>
<p>
	<strong>Presupuesto relacionado:</strong>
    <?php
    if($contrato->idpres != 0) {
        echo Html::anchor('presupuesto/view/' . $contrato->idpres, 'Núm. ' . Model_Presupuesto::find($contrato->idpres)->get('num_p'), array('target' => '_blank', 'title' => 'Se abrirá en ventana nueva'));
    }
    else{
        echo "<strong>NO APLICA</strong>";
    }?>
<p>
	<strong>Representante legal:</strong>
	<?php
        if($contrato->idpersonal != 0) {
            if(Model_Personal::find($contrato->idpersonal) != null){
                echo Model_Personal::find($contrato->idpersonal)->get('nombre');
            }
            else{
                echo '<span class="red">-- NOMBRE NO ESPECIFICADO --</span>';
            }
        }
        else{
            echo '<span class="red">-- AÚN NO ESPECIFICADO --</span>';
        }
    ?></p>
<p>
	<strong>Fecha contrato:</strong>
	<?php echo date_conv($contrato->fecha_firma); ?></p>
<br/>
<?php echo Html::anchor('contrato/edit/'.$contrato->id, '<span class="glyphicon glyphicon-pencil"></span> Editar datos del contrato',array('class'=>'btn btn-success')); ?>&nbsp;&nbsp;
<?php echo Html::anchor('contrato/doc/'.$contrato->id, '<span class="glyphicon glyphicon-file"></span> Vista previa',array('class'=>'btn btn-info')); ?>&nbsp;&nbsp;
<?php echo Html::anchor('contrato', '<span class="glyphicon glyphicon-backward"></span> Listado de todos los contratos',array('class'=>'btn btn-danger')); ?>

<br/><br/>

<h3>Servicios contratados incluidos</h3>
<?php if(count($servicios) == 0): ?>
    <p>Por ahora no se han definido servicios para el presente contrato. Agrega los servicios que desees en el siguiente botón.</p>
<?php else: ?>
    <p>A continuación listamos los servicios contratados por el cliente que van a aparecer en el presente contrato:</p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Tipo servicio</th>
            <th>Importe neto</th>
            <th>Cuota</th>
            <th>Año facturación</th>
            <th>Mes facturación</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($servicios as $item):
            //needed to display correctly the name of the months
            setlocale(LC_TIME,'');
            ?>
            <tr>
                <td><?php echo Model_Servicio::find($item->idtipo_servicio)->get('nombre');?></td>
                <td><?php echo $item->importe; ?> &euro;</td>
                <td><?php echo $item->cuota; ?> &euro;</td>
                <td><?php echo $item->year; ?></td>
                <td><?php echo getMes($item->mes_factura);  ?></td>
                <td>
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <?php echo Html::anchor('servicios/contratados/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver detalle', array('class' => 'btn btn-default')); ?>
                            <?php echo Html::anchor('servicios/contratados/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar servicio', array('class' => 'btn btn-success')); ?>
                            <?php echo Html::anchor('servicios/contratados/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar servicio', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer eliminar el contrato?')")); ?>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<br/>
<?php echo Html::anchor('servicios/contratados/create/'.$contrato->id, '<span class="glyphicon glyphicon-plus"></span> Añadir servicio',array('class'=>'btn btn-primary')); ?>&nbsp;&nbsp;