<?php
if (!isset($idcliente)) {
    ?>
    <h2>Ver la <span class="muted"> Documentación LOPD </span> de clientes <strong>activos</strong> en el sistema</h2>
    <br/>
    <p> Selecciona un cliente en el desplegable de abajo para acceder a su documentación LOPD <i>(recuerda que clicando
            en el
            desplegable y pulsando una letra, te llevará directamente a los clientes que comiencen por dicha letra)</i>
    </p>
    <br/>
    <?php
    $clientes_ops = array();
    $clientes_ops[0] = "-- SELECCIONA A UN CLIENTE ACTIVO DEL SISTEMA --";
    foreach ($clientes as $c) {
        $clientes_ops[$c->id] = $c->nombre;
    }

    echo Form::open(array("class" => "form-horizontal")); ?>
    <fieldset>
        <div class="form-group">
            <?php echo Form::label('Cliente activo', 'idcliente', array('class' => 'control-label')); ?><span
                class="red"> *</span>
            <?php echo Form::select('idcliente', '', $clientes_ops, array('class' => 'col-md-4 form-control', 'placeholder' => 'Nombre del cliente')); ?>
        </div>
        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::button('submit', 'Ver documentación <span class="glyphicon glyphicon-arrow-right"></span>', array('class' => 'btn btn-primary', 'type' => 'submit')); ?>
        </div>
    </fieldset>
    <?php echo Form::close();
} else {
    echo '<h2>Ver la <span class="muted"> Documentación LOPD </span> del cliente <strong>' . $name . '</strong></h2>';
    ?>
    <p>Haciendo clic en los siguientes botones, se mostrará la <strong>vista previa</strong> de los datos del sistema que se van a volcar
        en el documento PDF o bien podrá generarlo directamente si lo deseas.</p>
    <br/>
    <h3>Listado de documentos</h3>
    <table class="table table-striped">
        <?php
        if(isset($cesiones)) {
            foreach ($cesiones as $c) {
                $ces_name = Model_Cliente::find($c->idcesionaria)->get('nombre');
                ?>
                <tr>
                    <td>Contrato de cesión de datos con <strong><?php echo $ces_name;?></strong></td>
                        <td><?php echo Html::anchor('clientes/doc_cesion/' . $idcliente . '/' . $c->idcesionaria, '<span class="glyphicon glyphicon-eye-open"></span> Vista previa', array('class' => 'btn btn-default')); ?>
                &nbsp;<?php echo Html::anchor('doc/cesion/' . $idcliente . '/' . $c->idcesionaria, '<span class="glyphicon glyphicon-file"></span> Generar PDF', array('class' => 'btn btn-info','target'=>'_blank')); ?></td></tr>
            <?php
            }
        }
        if ($type == 6) {
            $aaffs = Model_Rel_Comaaff::find('all', array('where' => array('idcom' => $idcliente)));
            foreach ($aaffs as $aaff) {
                //Default contract with its legal representative
                $aaff_name = Model_Cliente::find($aaff->idaaff)->get('nombre');
                ?>
                <tr>
                    <td>Contrato de cesión de datos con <strong><?php echo $aaff_name; ?></strong></td>
                    <td><?php echo Html::anchor('clientes/doc_cesion/' . $idcliente . '/' . $aaff->idaaff, '<span class="glyphicon glyphicon-eye-open"></span> Vista previa', array('class' => 'btn btn-default')); ?>
                        &nbsp;<?php echo Html::anchor('doc/cesion/' . $idcliente . '/' . $aaff->idaaff, '<span class="glyphicon glyphicon-file"></span> Generar PDF', array('class' => 'btn btn-info', 'target' => '_blank')); ?></td>
                </tr>
                <?php
            }
            if (Model_Fichero::find('first',array('where'=>array('idcliente'=>$idcliente,'idtipo'=>6)))!=null) {
                //Solicitud Acceso Fichero Videovigilancia
                echo "<tr><td>Solicitud de acceso al Fichero de Videovigilancia</td>";
                echo "<td>" . Html::anchor('doc/solicitud_video/' . $idcliente, '<span class="glyphicon glyphicon-file"></span> Generar PDF', array('class' => 'btn btn-info', 'target' => '_blank')) . "</td></tr>";
            }
        }

        //Security doc
        echo "<tr><td>Documento de seguridad</td>";
        echo "<td>".Html::anchor('clientes/doc_seguridad/' . $idcliente, '<span class="glyphicon glyphicon-eye-open"></span> Vista previa', array('class' => 'btn btn-default'));
        echo "&nbsp;".Html::anchor('doc/seguridad/' . $idcliente, '<span class="glyphicon glyphicon-file"></span> Generar PDF', array('class' => 'btn btn-info', 'target' => '_blank'))."</td></tr>";

        //E-mail
        echo "<tr><td>Coletilla legal para e-mails</td>";
        echo "<td>".Html::anchor('doc/coletilla/'.$idcliente, '<span class="glyphicon glyphicon-file"></span> Generar PDF', array('class' => 'btn btn-info', 'target' => '_blank'))."</td></tr>";

        //Portada
        echo "<tr><td>Portada de la documentación</td>";
        echo "<td>".Html::anchor('doc/portada/'.$idcliente, '<span class="glyphicon glyphicon-file"></span> Generar PDF', array('class' => 'btn btn-info', 'target' => '_blank'))."</td></tr>";

        //Claúsulas
        echo "<tr><td>Cláusulas legales para empleados</td>";
        echo "<td>".Html::anchor('doc/clausula/'.$idcliente.'/E', '<span class="glyphicon glyphicon-file"></span> Generar PDF', array('class' => 'btn btn-info', 'target' => '_blank'))."</td></tr>";

        echo "<tr><td>Cláusula de recogida de datos de clientes</td>";
        echo "<td>".Html::anchor('doc/clausula/'.$idcliente.'/C', '<span class="glyphicon glyphicon-file"></span> Generar PDF', array('class' => 'btn btn-info', 'target' => '_blank'))."</td></tr>";

        echo "<tr><td>Cláusula de recogida de datos de proveedores</td>";
        echo "<td>".Html::anchor('doc/clausula/'.$idcliente.'/P', '<span class="glyphicon glyphicon-file"></span> Generar PDF', array('class' => 'btn btn-info', 'target' => '_blank'))."</td></tr>";

        ?>
        </table>
        <br/>

<?php
    echo Html::anchor('clientes/view/'.$idcliente, '<span class="glyphicon glyphicon-eye-open"></span> Abrir ficha de cliente', array('class' => 'btn btn-default', 'target' => '_blank', 'title'=>'En ventana nueva...'));

} ?>