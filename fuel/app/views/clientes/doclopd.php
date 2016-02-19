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
    $nombre = Model_Cliente::find($idcliente)->get('nombre');
    $tipo = Model_Cliente::find($idcliente)->get('tipo');
    echo '<h2>Ver la <span class="muted"> Documentación LOPD </span> del cliente <strong>' . $nombre . '</strong></h2>';
    ?>
    <p>Haciendo clic en cada uno de los siguientes botones, se mostrará la <strong>vista previa</strong> de los datos
        del sistema que se van a volcar
        en el documento PDF correspondiente que se desea generar.</p>
    <ul>
        <?php if ($tipo == 6) { ?>
            <li><?php echo Html::anchor('http://localhost/docpdf/portada.php?q=' . base64_encode(urlencode($nombre)), '<span class="glyphicon glyphicon-file"></span> Portada de la documentación', array('class' => 'btn btn-info btn-sm', 'target' => '_blank')); ?></li>
            <br/>
        <?php
            $aaff= Model_Rel_Comaaff::find('first',array('where'=>array('idcom'=>$idcliente)));
            //Default contract with its legal representative
            $nombre = Model_Cliente::find($aaff->idaaff)->get('nombre');
        ?>
            <li><?php echo Html::anchor('clientes/doc_cesion/' . $idcliente .'/'.$aaff->idaaff, '<span class="glyphicon glyphicon-file"></span> Contrato de cesión de datos con ' . $nombre, array('class' => 'btn btn-info btn-sm', 'target' => '_blank')); ?></li>
            <br/>
<?php
        }
    if(isset($cesiones)) {
        foreach ($cesiones as $c) {
            $nombre = Model_Cliente::find($c->idcesionaria)->get('nombre');
            ?>
            <li><?php echo Html::anchor('clientes/doc_cesion/' . $idcliente . '/' . $c->idcesionaria, '<span class="glyphicon glyphicon-file"></span> Contrato de cesión de datos con ' . $nombre, array('class' => 'btn btn-info btn-sm')); ?></li>
            <br/>
            <?php
        }
    }
        ?>
        <li><?php echo Html::anchor('clientes/doc_seguridad/' . $idcliente, '<span class="glyphicon glyphicon-file"></span> Documento de seguridad', array('class' => 'btn btn-info btn-sm'));?></li>
    </ul>
<?php
} ?>