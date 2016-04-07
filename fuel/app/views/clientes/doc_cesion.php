<h2>Vista previa del <span class='muted'>contrato de cesión de datos</span> </h2>
<p>A continuación presentamos los datos que volcamos dentro del <strong>contrato de cesión de ficheros</strong> entre las
    dos partes afectadas (cedentes y cesionarios). Si faltara algún dato, por favor, rellénalo y vuelve a esta pantalla (o completalo en pestaña nueva y
    simplemente actualiza ésta).</p>

<h3>Datos del cliente</h3>
<?php
$isCPP= ($cliente->tipo==6)?1:0;

//only the important data
$cliente_data = array(
    "nombre" => $cliente->nombre,
    "tipo" => $cliente->tipo,
    "cif_nif" => $cliente->cif_nif,
    "dir" => $cliente->direccion,
    "cp" => $cliente->cpostal,
    "loc" => $cliente->loc,
    "prov" => $cliente->prov
);
?>
<ul>
    <li>Nombre: <strong><?php echo $cliente->nombre;?></strong></li>
    <li>Tipo: <strong><?php echo Model_Tipo_Cliente::find($cliente->tipo)->get('tipo');?></strong></li>
    <li>CIF: <strong><?php echo $cliente->cif_nif;?></strong></li>
    <li>Dirección: <strong><?php echo $cliente->direccion;?></strong></li>
    <li>Código Postal: <strong><?php echo $cliente->cpostal;?></strong></li>
    <li>Localidad: <strong><?php echo $cliente->loc;?></strong></li>
    <li>Provincia: <strong><?php echo $cliente->prov;?></strong></li>
</ul>

<?php
$tratamiento_ops = array("D.","Dª");
//Only for communities
if($isCPP){ ?>
    <h3>Presidente de la CPP</h3>
    <ul>
        <li>Nombre:
            <?php
            $pres_trat = "N/D";
            $pres_name = '<span class="red">-- NO ESPECIFICADO --</span>';
            $presidente = $pres_trat.' '.$pres_name;
            if($pres = Model_Personal::find('first',array('where'=>array('idcliente'=>$cliente->id,'relacion'=>6)))){
                $pres_trat = $pres->tratamiento;
                $pres_name = $pres->nombre;
                $pres_dni = $pres->dni;
                $presidente = $tratamiento_ops[$pres_trat].' '.$pres_name;
                echo "<strong>".$presidente."</strong></li>";
                echo "<li>DNI: <strong>".$pres_dni."</strong></li>";
            }
            else{
                $presidente = "............................................................";
                $pres_dni = "....................................";
                echo "<strong>".$presidente."</strong></li>";
                echo "<li>DNI: <strong>".$pres_dni."</strong></li>";
            }
            ?>
    </ul>
<?php }else{ ?>
    <h3>Representante Legal</h3>
    <ul>
        <li>Nombre completo:
            <?php
            $rep_trat = "N/D";
            $rep_dni = '';
            $rep_name = '<span class="red">-- NO ESPECIFICADO --</span>';
            $rep_legal = $rep_trat.' '.$rep_name;
            if($rep_legal = Model_Personal::find('first',array('where'=>array('idcliente'=>$cliente->id,'relacion'=>1)))){
                $rep_trat = $rep_legal->tratamiento;
                $rep_name = $rep_legal->nombre;
                if($rep_legal->dni != ''){$rep_dni = $rep_legal->dni;}
                $rep_legal = $tratamiento_ops[$rep_trat].' '.$rep_name;
            }
            echo "<strong>".$rep_legal."</strong>";
            $cliente_data["rep_nombre"] = $rep_legal;
            $cliente_data["rep_dni"] = $rep_dni;
            ?></li>
        <li>DNI: <?php echo "<strong>".$rep_dni."</strong>";?></li>
    </ul>
<?php } ?>

<h3>Fichero(s) cedido(s)</h3>
<?php
$cesiones_data = array();
if(count($cesiones)>0) {
    $ficheros = array();
    foreach ($cesiones as $c):
        ?>
        <ul>
            <li>
                <strong>Tipo:</strong>
                <?php
                echo $tipo = Model_Tipo_Fichero::find(Model_Fichero::find($c->idfichero)->get('idtipo'))->get('tipo');
                //$ficheros[]=$tipo;
                ?>
            </li>
            <li><strong>Nivel de seguridad:</strong> <?php
                $nivel = Model_Fichero::find($c->idfichero)->get('nivel');
                switch ($nivel) {
                    case 1:
                        echo "Básico";
                        break;
                    case 2:
                        echo "Medio";
                        break;
                    case 3:
                        echo "Alto";
                        break;
                    default:
                        echo "-- NO ESPECIFICADO --";
                }
                ?></li>
            <li><strong>Soporte:</strong> <?php echo $soporte = Model_Fichero::find($c->idfichero)->get('soporte'); ?></li>
        </ul>
        <?php
        $ficheros[] = array(
            "tipo" => $tipo,
            "nivel" => $nivel,
            "soporte" => $soporte);

    endforeach;
}else{
    echo "<p>No se han encontrado cesiones de ficheros aún. Ve a la ficha de cliente y defínelos en el apartado <i>Auditoría de adaptación</i>.</p>";
}

if($isCPP) { ?>

    <h3>Representante(s) legal(es)</h3>
    <?php
    $reps_data = array();
    if (isset($rel_aaffs)) {
        foreach ($rel_aaffs as $rel_aaff): ?>
            <ul>
                <li>Nombre del Rep. legal:
                    <?php
                    $aaff = Model_Cliente::find($rel_aaff->idaaff);

                    $rep_trat = "";
                    $rep_dni = ".......................................";
                    $rep_name = '...................................................................';
                    $representante = $rep_trat . ' ' . $rep_name;
                    if ($rep = Model_Personal::find('first', array('where' => array('idcliente' => $aaff->id, 'relacion' => 1)))) {
                        $rep_trat = $rep->tratamiento;
                        $rep_name = $rep->nombre;
                        $rep_dni = $rep->dni;
                        $representante = $tratamiento_ops[$rep_trat] . ' ' . $rep_name;
                    }
                    echo "<strong>" . $representante . "</strong>";
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
                <li>Nombre de la empresa cesionaria: <strong><?php echo urldecode($aaff->nombre); ?></strong></li>
                <li>CIF: <strong><?php echo $aaff->cif_nif; ?></strong></li>
                <li>Dirección: <strong><?php echo $aaff->direccion; ?></strong></li>
                <li>Código postal: <strong><?php echo $aaff->cpostal; ?></strong></li>
                <li>Localidad: <strong><?php echo $aaff->loc; ?></strong></li>
                <li>Provincia: <strong><?php echo $aaff->prov; ?></strong></li>
                <br/>
            </ul>
        <?php endforeach;
    } else {
        echo "<ul><li>No se han encontrado aún representantes asociados.</li></ul>";
    }

}else{
    echo "<h3>Empresa cesionaria</h3>";
    ?>
    <ul>
        <li>Nombre de la empresa cesionaria: <strong><?php echo urldecode($cesionaria->nombre); ?></strong></li>
        <li>Tipo de empresa cesionaria: <strong><?php echo Model_Tipo_Cliente::find($cesionaria->tipo)->get('tipo'); ?></strong></li>
        <li>CIF: <strong><?php echo $cesionaria->cif_nif; ?></strong></li>
        <li>Dirección: <strong><?php echo $cesionaria->direccion; ?></strong></li>
        <li>Código postal: <strong><?php echo $cesionaria->cpostal; ?></strong></li>
        <li>Localidad: <strong><?php echo $cesionaria->loc; ?></strong></li>
        <li>Provincia: <strong><?php echo $cesionaria->prov; ?></strong></li>
        <li>Actividad: <strong><?php echo $cesionaria->actividad; ?></strong></li>
        <br/>
        <?php
        $nombre_rep_ces = "...........................................................................";
        $dni_rep_ces = ".....................................";
        $rep_legal_ces = Model_Personal::find('first', array('where' => array('idcliente' => $cesionaria->id, 'relacion' => 1)));
        if($rep_legal_ces != null){
            $nombre_rep_ces = $tratamiento_ops[$rep_legal_ces->tratamiento]." ".$rep_legal_ces->nombre;
            $dni_rep_ces = $rep_legal_ces->dni;
        }
        $ces_data = array(
            "nombre_rep" => $nombre_rep_ces,
            "tipo" => $cesionaria->tipo,
            "dni" => $dni_rep_ces,
            "nombre" => $cesionaria->nombre,
            "cif_nif" => $cesionaria->cif_nif,
            "servicio" => $cesionaria->actividad,
            "dir" => $cesionaria->direccion,
            "cp" => $cesionaria->cpostal,
            "loc" => $cesionaria->loc,
            "prov" => $cesionaria->prov
        );
        ?>
        <li>Nombre del Rep. legal: <strong><?php echo $nombre_rep_ces; ?></strong></li>
        <li>DNI del Rep. legal: <strong><?php echo $dni_rep_ces; ?></strong></li>
    </ul>
<?php }   ?>

<br/>
<p><?php
    if($isCPP){
        $params=base64_encode("cliente_data=".urlencode(json_encode($cliente_data))."&pres_dni=".urlencode($pres_dni)."&pres=".urlencode($presidente)."&reps_data=".urlencode(json_encode($reps_data)));
        $script = 'contrato_cesion_com.php?q=';
    }
    else{
        $params=base64_encode("cliente_data=".urlencode(json_encode($cliente_data))."&ficheros=".json_encode($ficheros)."&rep_data=".urlencode(json_encode($ces_data)));
        $script = 'contrato_cesion.php?q=';
    }
    echo Html::anchor('http://localhost/docpdf/'.$script.$params, '<span class="glyphicon glyphicon-file"></span> Generar PDF del contrato de cesión', array('class' => 'btn btn-info','target'=>'_blank'));
    ?>
</p>