<h2>Tareas de mantenimiento para <span class='muted'><?php echo $nombre; ?></span> </h2>
<?php if(isset($contratos)): ?>
    <h3 class="datos_cliente">Selección de contrato</h3>
    <p>Se han localizado los siguientes contratos. Por favor, selecciona uno de ellos para mostrar sus tareas de
        mantenimiento asociadas.</p>
    <?php if(count($contratos) == 0): ?>
        <p>No se ha encontrado aún ningún contrato asociado a este cliente en nuestro sistema.</p>
    <?php else: ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td>Nº Contrato</td>
                <td>Fecha de firma</td>
                <td>&nbsp;</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach($contratos as $c): ?>
                <tr>
                    <td><?php echo Html::anchor('clientes/tareas_mantenimiento/'.$idcliente.'/'.$c->id ,'Contrato nº'.$c->id, array('class'=>'contrato','data-id'=>$c->id)); ?></td>
                    <td><?php echo date_conv($c->fecha_firma); ?></td>
                    <td><?php echo Html::anchor('contrato/view/'.$c->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver detalle del contrato', array('class' => 'btn btn-default','target'=>'_blank','title'=>'Se abre en ventana nueva...')); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>

<?php if(isset($contrato)): ?>
    <h3 class="datos_cliente">Tareas de mantenimiento asociadas al <strong>contrato nº<?php echo $contrato->id;?></strong></h3>
    <?php
    $servicios = Model_Servicios_Contratado::find('all',array('where'=>array('idcontrato'=>$contrato->id)));
    if(!empty($servicios)):?>
        <?php foreach($servicios as $s):
            if($s->idtipo_servicio == 2){?>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <td>Mes</td>
                    <td>Año</td>
                    <td>Enviar correo</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=0;
                $now = strtotime("01-".$s->mes_factura."-".$s->year);
                while($i<24){
                    echo "<tr><td>".date('m',$now)."</td><td>".date('Y',$now)."</td>";
                    $now = strtotime("+1 month",$now);
                    $i++;

                    echo "<td>";
                    if($i%24 == 0){
                        echo Html::anchor('tareas/list/', '<span class="glyphicon glyphicon-envelope"></span> Enviar email auditoría', array('class' => 'btn btn-danger'));
                    }
                    elseif($i%3 == 0){
                        echo Html::anchor('tareas/list/', '<span class="glyphicon glyphicon-envelope"></span> Enviar email trimestral', array('class' => 'btn btn-warning'));
                    }
                    else{
                        echo Html::anchor('tareas/list/', '<span class="glyphicon glyphicon-envelope"></span> Enviar email mensual', array('class' => 'btn btn-info'))."&nbsp;&nbsp;";
                    }
                    echo "</td>";
                }

                echo "</tr>";
                ?>
                </tbody>
            </table>
        <?php } endforeach; ?>
    <?php endif; ?>
<?php endif; ?>