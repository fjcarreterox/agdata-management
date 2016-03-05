<h2>Vista previa de los <span class='muted'>trabajadores</span> del cliente seleccionado</h2>
<h3>Datos del cliente</h3>
<?php
//only the important data
$cliente_data = array(
    "nombre" => $cliente->nombre,
    "cif_nif" => $cliente->cif_nif,
    "dir" => $cliente->direccion,
    "cp" => $cliente->cpostal,
    "loc" => $cliente->loc,
    "prov" => $cliente->prov
);
?>
<ul>
    <li>Nombre: <strong><?php echo $cliente->nombre;?></strong></li>
    <li>CIF: <strong><?php echo $cliente->cif_nif;?></strong></li>
    <li>Dirección: <strong><?php echo $cliente->direccion;?></strong></li>
    <li>Código Postal: <strong><?php echo $cliente->cpostal;?></strong></li>
    <li>Localidad: <strong><?php echo $cliente->loc;?></strong></li>
    <li>Provincia: <strong><?php echo $cliente->prov;?></strong></li>
</ul>

<?php
$tratamiento_ops = array("D.","Dª");
//Only for communities

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

<br/>
<p><?php
    $params=base64_encode("cliente_data=".urlencode(json_encode($cliente_data))."&trab_data=".urlencode(json_encode($trab_data)));
    echo Html::anchor('http://localhost/docpdf/clausula_empleados.php?q='.$params, '<span class="glyphicon glyphicon-file"></span> Generar PDF con las cláusulas legales', array('class' => 'btn btn-info','target'=>'_blank'));
    ?>
</p>