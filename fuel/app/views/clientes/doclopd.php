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
    $nombre_cliente = Model_Cliente::find($idcliente)->get('nombre');
    $cif = Model_Cliente::find($idcliente)->get('cif_nif');
    $tipo = Model_Cliente::find($idcliente)->get('tipo');
    $dir = Model_Cliente::find($idcliente)->get('direccion').", ".Model_Cliente::find($idcliente)->get('cpostal').", ".Model_Cliente::find($idcliente)->get('loc').", en la provincia de ".Model_Cliente::find($idcliente)->get('prov');
    echo '<h2>Ver la <span class="muted"> Documentación LOPD </span> del cliente <strong>' . $nombre_cliente . '</strong></h2>';
    ?>
    <p>Haciendo clic en cada uno de los siguientes botones, se mostrará la <strong>vista previa</strong> de los datos
        del sistema que se van a volcar
        en el documento PDF correspondiente que se desea generar.</p>

    <ul>
        <li><?php echo Html::anchor('clientes/doc_seguridad/' . $idcliente, '<span class="glyphicon glyphicon-file"></span> Documento de seguridad', array('class' => 'btn btn-info'));?></li>
        <br/>
        <?php
        if(isset($cesiones)) {
            foreach ($cesiones as $c) {
                $nombre = Model_Cliente::find($c->idcesionaria)->get('nombre');
                ?>
                <li><?php echo Html::anchor('clientes/doc_cesion/' . $idcliente . '/' . $c->idcesionaria, '<span class="glyphicon glyphicon-file"></span> Contrato de cesión de datos con ' . $nombre, array('class' => 'btn btn-info')); ?></li>
                <br/>
            <?php
            }
        }

        if ($tipo == 6) {
            ?>
            <li><?php echo Html::anchor('http://localhost/docpdf/portada.php?q=' . base64_encode(urlencode($nombre_cliente)), '<span class="glyphicon glyphicon-file"></span> Portada de la documentación', array('class' => 'btn btn-info', 'target' => '_blank')); ?></li>
            <br/>
            <?php
            $aaff= Model_Rel_Comaaff::find('first',array('where'=>array('idcom'=>$idcliente)));
            //Default contract with its legal representative
            $nombre = Model_Cliente::find($aaff->idaaff)->get('nombre');
            ?>
            <li><?php echo Html::anchor('clientes/doc_cesion/' . $idcliente .'/'.$aaff->idaaff, '<span class="glyphicon glyphicon-file"></span> Contrato de cesión de datos con ' . $nombre, array('class' => 'btn btn-info', 'target' => '_blank')); ?></li>
            <br/>
        <?php
        }
        else{
            ?>
            <li><?php echo Html::anchor('clientes/clausula_empleados/'. $idcliente, '<span class="glyphicon glyphicon-file"></span> Cláusulas legales para empleados', array('class' => 'btn btn-info')); ?></li>
            <br/>
            <li><?php
                $params = "nombre=".$nombre_cliente."&dir=".$dir."&cif=".$cif;
                echo Html::anchor('http://localhost/docpdf/clausula_clientes.php?q='. base64_encode(urlencode($params)), '<span class="glyphicon glyphicon-file"></span> Cláusula de recogida de datos de clientes', array('class' => 'btn btn-info', 'target' => '_blank')); ?></li>
            <br/>
            <li><?php
                echo Html::anchor('http://localhost/docpdf/clausula_proveedores.php?q='. base64_encode(urlencode($params)), '<span class="glyphicon glyphicon-file"></span> Cláusula de recogida de datos de proveedores', array('class' => 'btn btn-info', 'target' => '_blank')); ?></li>
            <br/>
            <li><?php
                echo Html::anchor('http://localhost/docpdf/coletilla_correos.php?q='. base64_encode(urlencode($params)), '<span class="glyphicon glyphicon-file"></span> Coletilla legal para e-mails', array('class' => 'btn btn-info', 'target' => '_blank')); ?></li>
            <br/>
        <?php      }
        ?>

    </ul>

<?php } ?>