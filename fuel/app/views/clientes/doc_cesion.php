<h2>Vista previa del <span class='muted'>contrato de cesión de datos</span> </h2>
<p>A continuación presentamos los datos que varían dentro de un contrato de cesión de ficheros entre Comunidades
    de Propietarios y sus Administradores de fincas asociados. Si falta algún dato, rellénalo y vuelve a esta pantalla.</p>
<h3>Presidente</h3>
<ul>
    <li><strong>Nombre del Presidente de la comunidad:</strong>
   <?php
    $tratamiento_ops = array("Sr.","Sra.","D.","Dª");

    $pres_trat = "N/D";
    $pres_name = '<span class="red">-- NO ESPECIFICADO --</span>';
    $presidente = $pres_trat.' '.$pres_name;
    if($pres = Model_Personal::find('first',array('where'=>array('idcliente'=>$cliente->id,'relacion'=>6)))){
        $pres_trat = $pres->tratamiento;
        $pres_name = $pres->nombre;
        $presidente = $tratamiento_ops[$pres_trat].' '.$pres_name;
    }
    echo $presidente;
   ?></li>
</ul>

<h3>Representante legal</h3>
<ul>
    <li><strong>Nombre del Rep. legal:</strong>
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
    echo $representante;
    //for the query string
    $rep_data = array(
        "nombre" => $representante,
        "dni" => $rep_dni
    );
    ?></li>
    <li><strong>DNI del Rep. legal:</strong><?php echo $rep_dni; ?></li>
</ul>

<h3>Comunidad de propietarios</h3>
<?php
//only the important data
$cliente_data = array(
    "nombre" => urlencode($cliente->nombre),
    "cif_nif" => $cliente->cif_nif,
    "dir" => urlencode($cliente->direccion),
    "cp" => $cliente->cpostal,
    "loc" => $cliente->loc,
    "prov" => $cliente->prov
);

?>
<ul>
    <li><strong>Nombre de la C.PP:</strong> <?php echo $cliente->nombre;?></li>
    <li><strong>CIF:</strong> <?php echo $cliente->cif_nif;?></li>
    <li><strong>Dirección:</strong> <?php echo $cliente->direccion;?></li>
    <li><strong>Código Postal:</strong> <?php echo $cliente->cpostal;?></li>
    <li><strong>Localidad:</strong> <?php echo $cliente->loc;?></li>
    <li><strong>Provincia:</strong> <?php echo $cliente->prov;?></li>
</ul>

<h3>Empresa Administradora de fincas</h3>
<?php
$aaff_data = array(
    "nombre" => urlencode($aaff->nombre),
    "cif_nif" => $aaff->cif_nif,
    "dir" => urlencode($aaff->direccion),
    "cp" => $aaff->cpostal,
    "loc" => $aaff->loc,
    "prov" => $aaff->prov
);

$params=base64_encode("cliente_data=".json_encode($cliente_data)."&aaff_data=".json_encode($aaff_data)."&pres=".urlencode($pres)."&rep_data=".json_encode($rep_data));
?>
<ul>
    <li><strong>Nombre de la empresa cesionaria:</strong> <?php echo $aaff->nombre;?></li>
    <li><strong>CIF:</strong> <?php echo $aaff->cif_nif;?></li>
    <li><strong>Dirección:</strong> <?php echo $aaff->direccion;?></li>
    <li><strong>Código postal:</strong> <?php echo $aaff->cpostal;?></li>
    <li><strong>Localidad:</strong> <?php echo $aaff->loc;?></li>
    <li><strong>Provincia:</strong> <?php echo $aaff->prov;?></li>
</ul>
<br/>
<p><?php echo Html::anchor('http://localhost/docpdf/contrato_cesion_com.php?q='.$params, '<span class="glyphicon glyphicon-file"></span> Generar PDF del contrato', array('class' => 'btn btn-info','target'=>'_blank')); ?></p>