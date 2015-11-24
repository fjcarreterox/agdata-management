<?php
    $aaff = Model_Cliente::find($rel_aaff->idaaff);
    $rep = Model_Personal::find('first',array('where'=>array('idcliente'=>$aaff->id,'relacion'=>1)));

?>
<h2>Vista previa del <span class='muted'>contrato de cesión de datos</span> </h2>
<br/>
<p><strong>Presidente de la comunidad:</strong>
   <?php
        $tratamiento_ops = array("Sr.","Sra.","D.","Dª");
        $trat = Model_Personal::find('first',array('where'=>array('idcliente'=>$cliente->id,'relacion'=>6)))->get('tratamiento');
        $pres_name = Model_Personal::find('first',array('where'=>array('idcliente'=>$cliente->id,'relacion'=>6)))->get('nombre');
        $pres = $tratamiento_ops[$trat].' '.$pres_name;
        echo $pres;
   ?></p>

<p><strong>Representante legal:</strong>
    <?php echo $tratamiento_ops[$rep->tratamiento].' '.$rep->nombre; ?></p>
<br/>
<?php
//only the important data
$cliente_data = array(
    "nombre" => $cliente->nombre,
    "cif_nif" => $cliente->cif_nif,
    "dir" => urlencode($cliente->direccion),
    "cp" => $cliente->cpostal,
    "loc" => $cliente->loc,
    "prov" => $cliente->prov
);

$aaff_data = array(
    "nombre" => $aaff->nombre,
    "cif_nif" => $aaff->cif_nif,
    "dir" => urlencode($aaff->direccion),
    "cp" => $aaff->cpostal,
    "loc" => $aaff->loc,
    "prov" => $aaff->prov
);

$rep_data = array(
    "nombre" => $tratamiento_ops[$rep->tratamiento].' '.$rep->nombre,
    "dni" => $rep->dni
);
$params=base64_encode("cliente_data=".json_encode($cliente_data)."&aaff_data=".json_encode($aaff_data)."&pres=".urlencode($pres)."&rep_data=".json_encode($rep_data));
?>
<p><?php echo Html::anchor('http://localhost/docpdf/contrato_cesion_com.php?q='.$params, '<span class="glyphicon glyphicon-file"></span> Generar PDF del contrato', array('class' => 'btn btn-info','target'=>'_blank')); ?></p>