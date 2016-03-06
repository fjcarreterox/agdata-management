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
$tipo = Model_Tipo_Cliente::find($cliente->tipo)->get('tipo');
$cliente_data = array(
    "nombre" => $cliente->nombre,
    "tipo" => $tipo,
    "cif_nif" => $cliente->cif_nif,
    "dir" =>$cliente->direccion,
    "cp" => $cliente->cpostal,
    "loc" => $cliente->loc,
    "prov" => $cliente->prov
);

//Only for communities
$reps_data = array();
$pres_data = array();
if($isCPP){
    $pres_name = "NO DISPONIBLE";
    $falta="";
    $fbaja="";
    if($pres != null){
        $pres_name = $pres->nombre;
        $falta=date_conv($pres->fecha_alta);
        $fbaja=date_conv($pres->fecha_baja);
        $pres_data["nombre"] = $pres_name;
        $pres_data["falta"] = date_conv($pres->fecha_alta);
        $pres_data["fbaja"] = date_conv($pres->fecha_baja);
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
            $reps_data[] = array(
                "nombre" => $rep->get('nombre'),
                "dni" => $rep->get('dni'),
                "nombre_aaff" => $aaff->nombre,
                "dir" => $aaff->direccion,
                "cp" => $aaff->cpostal,
                "loc" => $aaff->loc,
                "prov" => $aaff->prov
            );

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
    if ($rep != null) {
        $reps_data[] = array(
            "nombre" => $tratamiento_ops[$rep->get('tratamiento')]." ".$rep->get('nombre'),
            "dni" => $rep->dni,
            "cargo" => $rep->cargofuncion
        );
    }
    echo "<ul><li>Nombre: <strong>".$tratamiento_ops[$rep->get('tratamiento')]." ".$rep->get('nombre')."</strong></li>";
    echo "<li>DNI: <strong>".$rep->get('dni')."</strong></li>";
    echo "<li>Cargo / Función: <strong>".$rep->get('cargofuncion')."</strong></li></ul>";

    echo "<h3>Responsable de seguridad</h3>";
    $rep_seg = Model_Personal::find('first', array('where' => array('idcliente' => $cliente->id, 'relacion' => 3)));
    $repseg_data = array();
    if ($rep_seg != null) {
        $nombre_repseg = $tratamiento_ops[$rep_seg->get('tratamiento')]." ".$rep_seg->get('nombre');
        $repseg_data[] = array(
            "nombre" => $nombre_repseg,
            "dni" => $rep_seg->dni,
            "cargo" => $rep_seg->cargofuncion,
            "falta" => date_conv($rep_seg->fecha_alta),
            "fbaja" => date_conv($rep_seg->fecha_baja)
        );
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
    $cesionarias = array();
    foreach($cesiones as $c){
        $cesionarias[] = array(
            "nombre" => Model_Cliente::find($c->idcesionaria)->get('nombre'),
            "cif_nif" => Model_Cliente::find($c->idcesionaria)->get('cif_nif'),
            "nombre_rep" => Model_Personal::find('first', array('where' => array('idcliente' => $c->idcesionaria, 'relacion' => 1)))->get('nombre'),
            "dni_rep" => Model_Personal::find('first', array('where' => array('idcliente' => $c->idcesionaria, 'relacion' => 1)))->get('dni')
        );
        echo "<ul><li>Nombre: <strong>".Model_Cliente::find($c->idcesionaria)->get('nombre')."</strong></li>";
        echo "<li>CIF/NIF: <strong>".Model_Cliente::find($c->idcesionaria)->get('cif_nif')."</strong></li>";
        echo "<li>Nombre Rep. Legal: <strong>".Model_Personal::find('first', array('where' => array('idcliente' => $c->idcesionaria, 'relacion' => 1)))->get('nombre')."</strong></li>";
        echo "<li>DNI Rep. Legal: <strong>".Model_Personal::find('first', array('where' => array('idcliente' => $c->idcesionaria, 'relacion' => 1)))->get('dni')."</strong></li></ul>";
    }
}

$trab_data = array();
if(count($trabajadores)>0){
    echo "<h3>Trabajadores con acceso a los ficheros</h3>";
    foreach($trabajadores as $t) {
        $trab_data[] = array(
            "nombre" => $tratamiento_ops[$t->get('tratamiento')] . " " . $t->get('nombre'),
            "dni" => $t->dni,
            "cargo" => $t->cargofuncion,
            "falta" => date_conv($t->fecha_alta),
            "fbaja" => date_conv($t->fecha_baja)
        );
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
$ficheros_data = array();
$niveles = array("No especificado","Básico","Medio","Alto");
$max_nivel = 0;

if($ficheros != null){
    foreach($ficheros as $f){
        $ficheros_data[] = array(
            "idtipo" => $f->idtipo,
            "nombre" => Model_Tipo_Fichero::find($f->idtipo)->get('tipo'),
            "nombre_nivel" => $niveles[$f->nivel],
            "nivel" => $f->nivel,
            "soporte" => $f->soporte
        );
        if($f->nivel > $max_nivel){$max_nivel=$f->nivel;}
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
    $params=base64_encode("nombre=".urlencode($cliente->nombre)."&tipo=".$tipo."&cliente_data=".urlencode(json_encode($cliente_data))."&reps_data=".urlencode(json_encode($reps_data))."&pres_data=".urlencode(json_encode($pres_data))."&f_data=".urlencode(json_encode($ficheros_data))."&trab_data=".urlencode(json_encode($trab_data,JSON_UNESCAPED_UNICODE))."&max_nivel=".$max_nivel);
    echo Html::anchor('http://localhost/docpdf/doc_seguridad_ccpp.php?q='.$params, '<span class="glyphicon glyphicon-file"></span> Generar PDF del Documento de seguridad', array('class' => 'btn btn-info','target'=>'_blank'));
}
else{
    $params=base64_encode("nombre=".urlencode($cliente->nombre)."&tipo=".$tipo."&cliente_data=".urlencode(json_encode($cliente_data))."&reps_data=".urlencode(json_encode($reps_data,JSON_UNESCAPED_UNICODE))."&repseg_data=".urlencode(json_encode($repseg_data,JSON_UNESCAPED_UNICODE))."&trab_data=".urlencode(json_encode($trab_data,JSON_UNESCAPED_UNICODE))."&cesionarias=".urlencode(json_encode($cesionarias))."&f_data=".urlencode(json_encode($ficheros_data))."&max_nivel=".$max_nivel);
    echo Html::anchor('http://localhost/docpdf/doc_seguridad.php?q='.$params, '<span class="glyphicon glyphicon-file"></span> Generar PDF del Documento de seguridad', array('class' => 'btn btn-info','target'=>'_blank'));
}
echo "&nbsp;".Html::anchor('clientes/view/'.$cliente->id, '<span class="glyphicon glyphicon-eye-open"></span> Abrir ficha de cliente', array('class' => 'btn btn-default','target'=>'_blank','title'=>'Se abre en ventana nueva...'));
?>