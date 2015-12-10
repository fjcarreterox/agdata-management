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
if($cliente->tipo==6){

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
    $params=base64_encode("nombre=".urlencode($cliente->nombre)."&tipo=".$tipo."&cliente_data=".urlencode(json_encode($cliente_data))."&reps_data=".json_encode($reps_data)."&pres_name=".urlencode($pres_name)."&f_data=".urlencode(json_encode($ficheros_data))."&max_nivel=".$max_nivel);
    echo Html::anchor('http://localhost/docpdf/doc_seguridad_ccpp.php?q='.$params, '<span class="glyphicon glyphicon-file"></span> Generar PDF del Documento de seguridad', array('class' => 'btn btn-info','target'=>'_blank'));
?>