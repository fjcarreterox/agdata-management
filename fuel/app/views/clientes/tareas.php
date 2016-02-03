<h2>Tareas de mantenimiento para <span class='muted'><?php echo $cliente->nombre; ?></span> </h2>
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
            <td><?php echo Html::anchor('clientes/tareas_mantenimiento/'.$cliente->id.'/'.$c->id ,'Contrato nº'.$c->id, array('class'=>'contrato','data-id'=>$c->id)); ?></td>
            <td><?php echo $c->fecha_firma; ?></td>
            <td><?php echo Html::anchor('contrato/view/'.$c->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver detalle del contrato', array('class' => 'btn btn-default','target'=>'_blank','title'=>'Se abre en ventana nueva...')); ?></td>
        </tr>
    <?php endforeach; ?>

    </tbody>
    </table>
    <?php endif; ?>
<?php endif; ?>

<?php if(isset($contrato)): ?>
<h3 class="datos_cliente">Facturación asociada al <strong>contrato nº<?php echo $contrato->id;?></strong></h3>
    <?php if(!empty($servicios)):?>
        <?php foreach($servicios as $s): ?>
            <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td>Mes</td>
                    <td>Año</td>
                    <td>Ciclo</td>
                    <td>Nº cuota</td>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    $now = strtotime("01-".$s->mes_factura."-".$s->year);
                    while($i<24){
                        if($i<12){$ciclo="1º";}
                        else{$ciclo="2º";}
                        echo "<tr><td>".date('m',$now)."</td><td>".date('Y',$now)."</td><td>".$ciclo."</td><td>".$s->cuota." &euro;</td></tr>";
                        $now = strtotime("+1 month",$now);
                        $i++;
                    }
                ?>
            </tbody>
            </table>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>