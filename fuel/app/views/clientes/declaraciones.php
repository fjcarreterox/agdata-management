<?php
if (!isset($idcliente)) {
    ?>
    <h2>Ver las <span class="muted"> declaraciones </span> de comunidades <strong>activas</strong> en el sistema</h2>
    <br/>
    <p> Selecciona una comunidad en el desplegable de abajo para acceder a sus declaraciones <i>(recuerda que clicando en el
            desplegable y pulsando una letra, te llevará directamente a las comunidades que comiencen por dicha letra)</i>
    </p>
    <br/>
    <?php
    $clientes_ops = array();
    $clientes_ops[0] = "-- SELECCIONA A UNA CPP ACTIVA DEL SISTEMA --";
    foreach ($clientes as $c) {
        $clientes_ops[$c->id] = $c->nombre;
    }

    echo Form::open(array("class" => "form-horizontal")); ?>
    <fieldset>
        <div class="form-group">
            <?php echo Form::label('Comunidad de propietarios activa', 'idcliente', array('class' => 'control-label')); ?><span
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
    echo '<h2>Ver las <span class="muted"> declaraciones </span> de la C.PP. <strong>' . $name . '</strong></h2>';
    ?>
    <p>Haciendo clic en los siguientes botones, se generará el documento PDF directamente.</p>
    <br/>
    <h3>Listado de declaraciones</h3>
    <table class="table table-striped">
        <?php
        echo "<tr><td>Declaración de vigencia de cargos</td>";
        echo "<td>".Html::anchor('doc/vigencia/'.$idcliente, '<span class="glyphicon glyphicon-file"></span> Generar PDF', array('class' => 'btn btn-info', 'target' => '_blank'))."</td></tr>";

        echo "<tr><td>Declaración NO tener el Acta de Constitución</td>";
        echo "<td>" . Html::anchor('doc/noacta/' . $idcliente, '<span class="glyphicon glyphicon-file"></span> Generar PDF', array('class' => 'btn btn-info', 'target' => '_blank')) . "</td></tr>";

        ?>
    </table>
    <br/>

    <?php
    echo Html::anchor('clientes/view/'.$idcliente, '<span class="glyphicon glyphicon-eye-open"></span> Abrir ficha de cliente', array('class' => 'btn btn-default', 'target' => '_blank', 'title'=>'En ventana nueva...'));

} ?>