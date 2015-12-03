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
    "dir" =>urlencode($cliente->direccion),
    "cp" => $cliente->cpostal,
    "loc" => $cliente->loc,
    "prov" => $cliente->prov
);

//Only for communities
$rep_data = array();
$pres_name = "NO DISPONIBLE";
if($cliente->tipo==6){
    $rel_aaff = Model_Rel_Comaaff::find('first',array('where'=>array('idcom'=>$cliente->id)));
    if($rel_aaff != null) {
        $aaff = Model_Cliente::find($rel_aaff->idaaff);
        $rep = Model_Personal::find('first', array('where' => array('idcliente' => $aaff->id, 'relacion' => 1)));
        if ($rep != null) {
            $rep_data["nombre"] = $rep->get('nombre');
            $rep_data["dir"] = $aaff->direccion;
            $rep_data["cp"] = $aaff->cpostal;
            $rep_data["loc"] = $aaff->loc;
            $rep_data["prov"] = $aaff->prov;
        }
    }

    if($pres != null){
        $pres_name = $pres->nombre;
    }
    echo "<h3>Presidente</h3>";
    echo "<ul><li>Nombre: <strong>$pres_name</strong></li></ul>";

    echo "<h3>Representante legal</h3>";
    echo "<ul><li>Nombre: <strong>".$rep->get('nombre')."</strong></li></ul>";

    echo "<h3>Empresa representada</h3>";
    echo "<ul>
            <li>Dirección: <strong>".$aaff->direccion."</strong></li>
            <li>Código postal: <strong>".$aaff->cpostal."</strong></li>
            <li>Localidad: <strong>".$aaff->loc."</strong></li>
            <li>Provincia: <strong>".$aaff->prov."</strong></li>
         </ul>";
}
?>

<h3>Datos de los ficheros declarados</h3>
<?php
$ficheros_data = array();
$niveles = array("1"=>"Básico","2"=>"Medio","3"=>"Alto");

if($ficheros != null){
    foreach($ficheros as $f){
        $ficheros_data[] = array(
            "idtipo" => $f->idtipo,
            "nombre" => Model_Tipo_Fichero::find($f->idtipo)->get('tipo'),
            "nivel" => urlencode($niveles[$f->nivel]),
            "soporte" => $f->soporte
        );
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
    $params=base64_encode("nombre=".$cliente->nombre."&tipo=".$tipo."&cliente_data=".json_encode($cliente_data)."&rep_data=".json_encode($rep_data)."&pres_name=".$pres_name."&f_data=".json_encode($ficheros_data));
    echo Html::anchor('http://localhost/docpdf/doc_seguridad_ccpp.php?q='.$params, '<span class="glyphicon glyphicon-file"></span> Doc. seguridad', array('class' => 'btn btn-info','target'=>'_blank'));
?>