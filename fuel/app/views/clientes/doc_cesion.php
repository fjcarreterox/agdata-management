<h2>Vista previa del <span class='muted'>contrato de cesión de datos</span> </h2>
<p>A continuación presentamos los datos que varían dentro de un contrato de cesión de ficheros entre Comunidades
    de Propietarios y sus Administradores de fincas asociados. Si falta algún dato, rellénalo y vuelve a esta pantalla.</p>

<h3>Comunidad de propietarios</h3>
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
    <li>Nombre de la C.PP: <strong><?php echo $cliente->nombre;?></strong></li>
    <li>CIF: <strong><?php echo $cliente->cif_nif;?></strong></li>
    <li>Dirección: <strong><?php echo $cliente->direccion;?></strong></li>
    <li>Código Postal: <strong><?php echo $cliente->cpostal;?></strong></li>
    <li>Localidad: <strong><?php echo $cliente->loc;?></strong></li>
    <li>Provincia: <strong><?php echo $cliente->prov;?></strong></li>
</ul>

<h3>Presidente</h3>
<ul>
    <li>Nombre del Presidente de la comunidad:
   <?php
    $tratamiento_ops = array("D.","Dª");

    $pres_trat = "N/D";
    $pres_name = '<span class="red">-- NO ESPECIFICADO --</span>';
    $presidente = $pres_trat.' '.$pres_name;
    if($pres = Model_Personal::find('first',array('where'=>array('idcliente'=>$cliente->id,'relacion'=>6)))){
        $pres_trat = $pres->tratamiento;
        $pres_name = $pres->nombre;
        $presidente = $tratamiento_ops[$pres_trat].' '.$pres_name;
    }
    echo "<strong>".$presidente."</strong>";
   ?></li>
</ul>

<h3>Representante(s) legal(es)</h3>
<?php
$reps_data = array();
foreach($rel_aaffs as $rel_aaff): ?>
<ul>
    <li>Nombre del Rep. legal:
    <?php
    $aaff = Model_Cliente::find($rel_aaff->idaaff);

    $rep_trat = "N/D";
    $rep_dni = "N/D";
    $rep_name = '<span class="red">-- NO ESPECIFICADO --</span>';
    $representante = $rep_trat.' '.$rep_name;
    if($rep = Model_Personal::find('first',array('where'=>array('idcliente'=>$aaff->id,'relacion'=>1)))){
        $rep_trat = $rep->tratamiento;
        $rep_name = $rep->nombre;
        $rep_dni = $rep->dni;
        $representante = $tratamiento_ops[$rep_trat].' '.$rep_name;
    }
    echo "<strong>".$representante."</strong>";
    //for the query string
    $reps_data[] = array(
        "nombre" => $representante,
        "dni" => $rep_dni,
        "nombre_aaff" => $aaff->nombre,
        "cif_nif" => $aaff->cif_nif,
        "dir" => $aaff->direccion,
        "cp" => $aaff->cpostal,
        "loc" => $aaff->loc,
        "prov" => $aaff->prov
    );
    ?></li>
    <li>DNI del Rep. legal: <strong><?php echo $rep_dni; ?></strong></li>

    <h4><i>En representación de la empresa Administradora de fincas:</i></h4>
    <li>Nombre de la empresa cesionaria: <strong><?php echo urldecode($aaff->nombre);?></strong></li>
    <li>CIF: <strong><?php echo $aaff->cif_nif;?></strong></li>
    <li>Dirección: <strong><?php echo $aaff->direccion;?></strong></li>
    <li>Código postal: <strong><?php echo $aaff->cpostal;?></strong></li>
    <li>Localidad: <strong><?php echo $aaff->loc;?></strong></li>
    <li>Provincia: <strong><?php echo $aaff->prov;?></strong></li>
    <br/>
</ul>
<?php endforeach; ?>
<br/>
<p><?php
    $params=base64_encode("cliente_data=".urlencode(json_encode($cliente_data))."&pres=".urlencode($presidente)."&reps_data=".urlencode(json_encode($reps_data)));
    echo Html::anchor('http://localhost/docpdf/contrato_cesion_com.php?q='.$params, '<span class="glyphicon glyphicon-file"></span> Generar PDF del contrato de cesión', array('class' => 'btn btn-info','target'=>'_blank')); ?>
</p>