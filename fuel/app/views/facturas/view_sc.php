<h2><span class='muted'>Facturas</span> asociadas a <b><?php echo $cname;?></b></h2>
<br/>
<ul>
    <li>Servicio contratado asociado: <strong><?php echo $servicio;?></strong></li>
    <li>Cuota NETA a cobrar: <strong><?php echo $cuota;?> &euro;</strong></li>
    <li>Importe (21% IVA incluído): <strong><?php echo number_format($cuota*1.21,2);?> &euro;</strong></li>
    <li>Medio de pago: <strong><?php echo $forma;?></strong></li>
</ul>
<?php if ($facturas): ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Núm. factura</th>
            <th>Cuota nº</th>
            <th>Fecha de facturación</th>
            <th>Estado</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($facturas as $item): ?>
            <tr>
                <td class="text-center"><?php
                    if(strcmp($item->num_fact,"")==0){echo '<span class="red">N/D</span>';}
                    else{echo "L".str_pad($item->num_fact, 3, 0, STR_PAD_LEFT)."/".$item->anyo_cobro;} ?></td>
                <td><?php echo $item->num_cuota ?></td>
                <td><?php echo getMes($item->mes_cobro)." / ".$item->anyo_cobro; ?></td>
                <td><?php
                        if(strcmp($item->estado,"no emitida")==0){
                            echo '<span class="red">'.$item->estado.'</span>';
                        }
                        else{
                            echo '<span class="green">'.$item->estado.'</span>';
                        }
                    ?></td>
                <td>
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <?php echo Html::anchor('facturas/issue/'.$item->id, '<span class="glyphicon glyphicon-forward"></span> Emitir', array('class' => 'btn btn-warning')); ?>
                            <?php echo Html::anchor('facturas/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Cambiar estado', array('class' => 'btn btn-success')); ?>
                            <?php echo Html::anchor('doc/factura/'.$item->id, '<span class="glyphicon glyphicon-file"></span> Imprimir', array('class' => 'btn btn-info','target'=>'_blank')); ?>
                            <?php /*echo Html::anchor('facturas/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer eliminarla del sistema?')"));*/ ?>
                        </div>
                    </div>
                </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No se han encontrado aún facturas para este cliente.</p>
<?php endif; ?>
<p><?php echo Html::anchor('contrato/view/'.$idcont, '<span class="glyphicon glyphicon-backward"></span> Volver al contrato', array('class' => 'btn btn-primary')); ?></p>
