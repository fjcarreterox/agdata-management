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
    $subject = 'Tareas de mantenimiento LOPD - '.$nombre;
    $body1 = 'Estimado cliente,%0D%0A%0D%0ALe indicamos las tareas de mantenimiento LOPD que deben realizar este mes.%0D%0A%0D%0A- Verificar la existencia de copias de seguridad actualizadas de los ficheros de datos%0D%0A- Verificar si hay cambios en los ficheros declarados o existen nuevos ficheros (Anexo II)%0D%0A- Verificar la lista de personal con acceso a ficheros (Anexo III del Documento de Seguridad)%0D%0A- Comprobar si existen nuevas comunicaciones o cesiones de datos a terceros%0D%0A%0D%0ALe recomendamos imprimir este mail, anotar la/s fecha/s de verificación para cada tarea y adjuntarlo al Anexo X de su Documento de Seguridad.%0D%0A%0D%0AAsimismo, le recordamos la importancia de tener actualizada su política de protección de datos de cara a la auditoría bienal obligatoria.%0D%0A%0D%0ANo dude en plantearnos cualquier duda o cuestión que le surja.%0D%0A%0D%0AUn cordial saludo.';
    $body3 = 'Estimado cliente,%0D%0A%0D%0ALe indicamos las tareas de mantenimiento LOPD que deben realizar este mes.%0D%0A%0D%0A- Verificar la existencia de copias de seguridad actualizadas de los ficheros de datos%0D%0A- Verificar si hay cambios en los ficheros declarados o existen nuevos ficheros (Anexo II)%0D%0A- Verificar la lista de personal con acceso a ficheros (Anexo III del Documento de Seguridad)%0D%0A- Comprobar si existen nuevas comunicaciones o cesiones de datos a terceros%0D%0A- Cambio de contraseñas periódicos para los usuarios de los equipos informáticos%0D%0A- Análisis de las incidencias producidas en el trimestre (Anexo IX. Registro de Incidencias)%0D%0A%0D%0ALe recomendamos imprimir este mail, anotar la/s fecha/s de verificación para cada tarea y adjuntarlo al Anexo X de su Documento de Seguridad.%0D%0A%0D%0AAsimismo, le recordamos la importancia de tener actualizada su política de protección de datos de cara a la auditoría bienal obligatoria.%0D%0A%0D%0ANo dude en plantearnos cualquier duda o cuestión que le surja.%0D%0A%0D%0AUn cordial saludo.';
    $bodyf = 'Estimado cliente,%0D%0A%0D%0AEste mes, además de las tareas de mantenimiento LOPD, tenemos que realizarles la auditoría bienal obligatoria. Indíquenos qué día y hora le vendría bien atendernos para poder efectuarla.%0D%0A%0D%0ALe recomendamos imprimir este e-mail, anotar la/s fecha/s de verificación para cada tarea LOPD y adjuntarlo al Anexo X de su Documento de Seguridad.%0D%0A%0D%0A- Verificar la existencia de copias de seguridad actualizadas de los ficheros de datos%0D%0A- Verificar si hay cambios en los ficheros declarados o existen nuevos ficheros (Anexo II) %0D%0A- Verificar la lista de personal con acceso a ficheros (Anexo III del Documento de Seguridad)%0D%0A- Comprobar si existen nuevas comunicaciones o cesiones de datos a terceros%0D%0A- Cambio de contraseñas periódicos para los usuarios de los equipos informáticos%0D%0A- Análisis de las incidencias producidas en el trimestre (Anexo IX. Registro de Incidencias)%0D%0A%0D%0AEn espera de su respuesta,%0D%0A%0D%0AUn cordial saludo.';

    $email_resp_seg="-- NO ESPECIFICADO --";
    $resp_seg=Model_Personal::find('first',array('where'=>array('idcliente'=>$idcliente,'relacion'=>3)));
    if($resp_seg != null && $resp_seg->email != ''){
        $email_resp_seg = $resp_seg->email;
    }

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
                    $year = date('Y',$now);
                    $month = date('m',$now);
                    echo "<tr><td>".getMes($month)."</td><td>".$year."</td>";
                    $now = strtotime("+1 month",$now);
                    $i++;

                    echo "<td>";
                    if($i%24 == 0){
                        echo Html::mail_to($email_resp_seg,'<span class="glyphicon glyphicon-envelope"></span> Enviar e-mail auditoría',$subject.' - '.getMes($month).' '.$year.'&body='.$bodyf , array('class' => 'btn btn-danger'));
                    }
                    elseif($i%3 == 0){
                        echo Html::mail_to($email_resp_seg,'<span class="glyphicon glyphicon-envelope"></span> Enviar e-mail trimestral',$subject.' - '.getMes($month).' '.$year.'&body='.$body3 , array('class' => 'btn btn-warning'));
                    }
                    else{
                        echo Html::mail_to($email_resp_seg,'<span class="glyphicon glyphicon-envelope"></span> Enviar e-mail mensual',$subject.' - '.getMes($month).' '.$year.'&body='.$body1 , array('class' => 'btn btn-info'));
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