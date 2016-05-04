<h2>Vista previa del <span class='muted'>documento de seguridad</span> </h2>
<p>A continuación presentamos los datos que varían dentro del documento de seguridad del cliente. Si falta algún dato,
    rellénalo y vuelve a esta pantalla.</p>

<h3>Datos del cliente</h3>
<ul>
    <li>Nombre: <strong><?php echo $cliente->nombre;?></strong></li>
    <li>Tipo de cliente: <strong><?php echo Model_Tipo_Cliente::find($cliente->tipo)->get('tipo');?></strong></li>
    <li>CIF: <strong><?php echo $cliente->cif_nif;?></strong></li>
    <li>Dirección: <strong><?php echo $cliente->direccion;?></strong></li>
    <li>Código Postal: <strong><?php echo $cliente->cpostal;?></strong></li>
    <li>Localidad: <strong><?php echo $cliente->loc;?></strong></li>
    <li>Provincia: <strong><?php echo $cliente->prov;?></strong></li>
</ul>
<?php
$isCPP= ($cliente->tipo==6)?1:0;
$tratamiento_ops = array("D.","Dª");

if($isCPP){
    $pres_name = "NO DISPONIBLE";
    $falta="";
    $fbaja="";
    if($pres != null){
        $pres_name = $pres->nombre;
        $falta=date_conv($pres->fecha_alta);
        $fbaja=date_conv($pres->fecha_baja);
    }

    echo "<h3>Presidente</h3>";
    echo "<ul><li>Nombre: <strong>$pres_name</strong></li>";
    echo "<li>Fecha de alta: <strong>".$falta."</strong></li>";
    echo "<li>Fecha de baja: <strong>".$fbaja."</strong></li></ul>";

    echo "<h3>Representante(s) legal(es)</h3>";
    foreach($rels_aaff as $rel_aaff) {
        $aaff = Model_Cliente::find($rel_aaff->idaaff);
        $rep = Model_Personal::find('first', array('where' => array('idcliente' => $aaff->id, 'relacion' => 1)));
        if ($rep != null) {
            echo "<ul><li>Nombre: <strong>".$rep->get('nombre')."</strong></li>";
            echo "<li>DNI: <strong>".$rep->get('dni')."</strong></li></ul>";
            echo "<li><h4><i>En representación de la empresa:</i></h4></li>";
            echo "
                <li>Nombre o razón social: <strong>".$aaff->nombre."</strong></li>
                <li>Dirección: <strong>".$aaff->direccion."</strong></li>
                <li>Código postal: <strong>".$aaff->cpostal."</strong></li>
                <li>Localidad: <strong>".$aaff->loc."</strong></li>
                <li>Provincia: <strong>".$aaff->prov."</strong></li>
            </ul><br/>";
        }
    }
}
else{
    echo "<h3>Representante legal</h3>";
    $rep = Model_Personal::find('first', array('where' => array('idcliente' => $cliente->id, 'relacion' => 1)));
    echo "<ul><li>Nombre: <strong>".$tratamiento_ops[$rep->get('tratamiento')]." ".$rep->get('nombre')."</strong></li>";
    echo "<li>DNI: <strong>".$rep->get('dni')."</strong></li>";
    echo "<li>Cargo / Función: <strong>".$rep->get('cargofuncion')."</strong></li></ul>";

    echo "<h3>Responsable de seguridad</h3>";
    $rep_seg = Model_Personal::find('first', array('where' => array('idcliente' => $cliente->id, 'relacion' => 3)));
    if ($rep_seg != null) {
        echo "<ul><li>Nombre: <strong>".$tratamiento_ops[$rep_seg->get('tratamiento')]." ".$rep_seg->get('nombre')."</strong></li>";
        echo "<li>Fecha Alta: <strong>" . date_conv($rep_seg->get('fecha_alta')) . "</strong></li>";
        echo "<li>Fecha Baja: <strong>" . date_conv($rep_seg->get('fecha_baja')) . "</strong></li>";
        echo "<li>DNI: <strong>".$rep_seg->get('dni')."</strong></li>";
        echo "<li>Cargo / Función: <strong>".$rep_seg->get('cargofuncion')."</strong></li></ul>";
    }
    else{
        echo "<ul><li>Nombre: <strong> -- NO DISPONIBLE -- </strong></li>";
        echo "<li>DNI: <strong> -- NO DISPONIBLE -- </strong></li>";
        echo "<li>Cargo / Función: <strong> -- NO DISPONIBLE -- </strong></li></ul>";
    }

    echo "<h3>Cesionarios</h3>";
    foreach($cesiones as $c){
        echo "<ul><li>Nombre: <strong>".Model_Cliente::find($c->idcesionaria)->get('nombre')."</strong></li>";
        echo "<li>CIF/NIF: <strong>".Model_Cliente::find($c->idcesionaria)->get('cif_nif')."</strong></li>";
        echo "<li>Nombre Rep. Legal: <strong>".Model_Personal::find('first', array('where' => array('idcliente' => $c->idcesionaria, 'relacion' => 1)))->get('nombre')."</strong></li>";
        echo "<li>DNI Rep. Legal: <strong>".Model_Personal::find('first', array('where' => array('idcliente' => $c->idcesionaria, 'relacion' => 1)))->get('dni')."</strong></li></ul>";
    }
}

if(count($trabajadores)>0){
    echo "<h3>Trabajadores con acceso a los ficheros</h3>";
    foreach($trabajadores as $t) {
        echo "<ul><li>Nombre: <strong>" . $tratamiento_ops[$t->get('tratamiento')] . " " . $t->get('nombre') . "</strong></li>";
        echo "<li>Fecha Alta: <strong>" . date_conv($t->get('fecha_alta')) . "</strong></li>";
        echo "<li>Fecha Baja: <strong>" . date_conv($t->get('fecha_baja')) . "</strong></li>";
        echo "<li>DNI: <strong>" . $t->get('dni') . "</strong></li>";
        echo "<li>Cargo / Función: <strong>" . $t->get('cargofuncion') . "</strong></li></ul>";
    }
}
?>

<h3>Datos de los ficheros declarados</h3>
<?php
$niveles = array("No especificado","Básico","Medio","Alto");
if($ficheros != null){
    foreach($ficheros as $f){
        ?>
        <ul>
            <li>Tipo de fichero: <strong><?php echo Model_Tipo_Fichero::find($f->idtipo)->get('tipo');?></strong></li>
            <li>Nivel de seguridad: <strong><?php echo $niveles[$f->nivel];?></strong></li>
            <li>Soporte: <strong><?php echo $f->soporte;?></strong></li>
        </ul>
    <?php
    }
}
echo "<br/>";
if($isCPP){
    echo Html::anchor('doc/seguridad_ccpp/'.$cliente->id, '<span class="glyphicon glyphicon-file"></span> Generar PDF del Documento de seguridad', array('class' => 'btn btn-info','target'=>'_blank'));
}
else{
    echo Html::anchor('doc/seguridad/'.$cliente->id, '<span class="glyphicon glyphicon-file"></span> Generar PDF del Documento de seguridad', array('class' => 'btn btn-info','target'=>'_blank'));
}
echo "&nbsp;".Html::anchor('clientes/view/'.$cliente->id, '<span class="glyphicon glyphicon-eye-open"></span> Abrir ficha de cliente', array('class' => 'btn btn-default','target'=>'_blank','title'=>'Se abre en ventana nueva...'));
?>