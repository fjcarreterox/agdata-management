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
$tratamiento_ops = array("D.","Dª");
$isCPP= ($cliente->tipo==6)?1:0;
$tipo = Model_Tipo_Cliente::find($cliente->tipo)->get('tipo');
$cliente_data = array(
    "nombre" => $cliente->nombre,
    "tipo" => $tipo,
    "dir" =>$cliente->direccion,
    "cp" => $cliente->cpostal,
    "loc" => $cliente->loc,
    "prov" => $cliente->prov
);

//Only for communities
$reps_data = array();
$pres_name = "NO DISPONIBLE";
if($isCPP){

    if($pres != null){
        $pres_name = $pres->nombre;
    }
    echo "<h3>Presidente</h3>";
    echo "<ul><li>Nombre: <strong>$pres_name</strong></li></ul>";

    echo "<h3>Representante(s) legal(es)</h3>";

    foreach($rels_aaff as $rel_aaff) {
        $aaff = Model_Cliente::find($rel_aaff->idaaff);
        $rep = Model_Personal::find('first', array('where' => array('idcliente' => $aaff->id, 'relacion' => 1)));
        if ($rep != null) {
            $reps_data[] = array(
                "nombre" => $rep->get('nombre'),
                "nombre_aaff" => $aaff->nombre,
                "dir" => $aaff->direccion,
                "cp" => $aaff->cpostal,
                "loc" => $aaff->loc,
                "prov" => $aaff->prov
        );

            echo "<ul><li>Nombre: <strong>".$rep->get('nombre')."</strong></li>";
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

    echo "<h3>Cesionarios</h3>";
    $cesionarias = array();
    foreach($cesiones as $c){
        echo "<ul><li>Nombre: <strong>".Model_Cliente::find($c->idcesionaria)->get('nombre')."</strong></li>";
        echo "<li>CIF/NIF: <strong>".Model_Cliente::find($c->idcesionaria)->get('cif_nif')."</strong></li>";
        echo "<li>Nombre Rep. Legal: <strong>".Model_Personal::find('first', array('where' => array('idcliente' => $c->idcesionaria, 'relacion' => 1)))->get('nombre')."</strong></li>";
        echo "<li>DNI Rep. Legal: <strong>".Model_Personal::find('first', array('where' => array('idcliente' => $c->idcesionaria, 'relacion' => 1)))->get('dni')."</strong></li></ul>";
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
if($isCPP) {
    $params = base64_encode("nombre=" . urlencode($cliente->nombre) . "&tipo=" . $tipo . "&cliente_data=" . urlencode(json_encode($cliente_data)) . "&reps_data=" . urlencode(json_encode($reps_data)) . "&pres_name=" . urlencode($pres_name) . "&f_data=" . urlencode(json_encode($ficheros_data)) . "&max_nivel=" . $max_nivel);
    echo Html::anchor('http://localhost/docpdf/doc_seguridad_ccpp.php?q=' . $params, '<span class="glyphicon glyphicon-file"></span> Generar PDF del Documento de seguridad', array('class' => 'btn btn-info', 'target' => '_blank'));
}
else{
    $params = base64_encode("nombre=" . urlencode($cliente->nombre) . "&tipo=" . $tipo . "&cliente_data=" . urlencode(json_encode($cliente_data)) . "&reps_data=" . urlencode(json_encode($reps_data)) . "&cesionarias=" . urlencode($cesionarias) . "&f_data=" . urlencode(json_encode($ficheros_data)) . "&max_nivel=" . $max_nivel);
    echo Html::anchor('http://localhost/docpdf/doc_seguridad.php?q=' . $params, '<span class="glyphicon glyphicon-file"></span> Generar PDF del Documento de seguridad', array('class' => 'btn btn-info', 'target' => '_blank'));
}
    ?>