<h2>Vista previa del <span class='muted'>contrato</span> seleccionado</h2>
<br/>
<p>A continuación mostramos los datos que se van a incluir en el contrato generado en PDF. Si alguno de ellos aún no está
completado, por favor, complétalo antes y regresa a esta pantalla para generar el contrato correctamente.</p>

<h3>Datos de cliente</h3>
<ul>
    <li>Nombre: <strong><?php echo $cliente["nombre"];?></strong></li>
    <li>Tipo de cliente: <strong><?php echo Model_Tipo_Cliente::find($cliente["tipo"])->get('tipo');?></strong></li>
    <li>CIF: <strong><?php echo $cliente["cif"];?></strong></li>
    <li>IBAN: <strong><?php echo $cliente["iban"];?></strong></li>
</ul>


<h3>Representante legal</h3>
<ul>
    <li>Nombre: <strong><?php echo $rep_legal["nombre"];?></strong></li>
    <li>DNI: <strong><?php echo $rep_legal["nif"];?></strong></li>
</ul>

<?php
if($cliente["tipo"] == 6){
    if(count($aaff)>0) {
        ?>
        <h3>Empresa representada por el Representante Legal</h3>
        <ul>
            <li>Nombre: <strong><?php echo $aaff["nombre"];?></strong></li>
            <li>CIF: <strong><?php echo $aaff["cif"];?></strong></li>
            <li>Domicilio:
                <strong><?php echo $aaff["dir"] . ", " . $aaff["cp"] . ", " . $aaff["loc"] . ", " . $aaff["prov"];?></strong>
            </li>
        </ul>
    <?php
    }
}
?>

<h3>Servicios contratados</h3>
<?php
    $servicios_data = array();
    $periodo_ops = array(12=>'Mensual',4=>'Trimestral',2=>'Semestral',1=>'Anual',0=>'Pago único');
    foreach($servicios as $s):
        $nombre = Model_Servicio::find($s->idtipo_servicio)->get('nombre');?>
    <ul>
        <li>Nombre: <strong><?php echo $nombre;?></strong></li>
        <li>Precio: <strong><?php echo $s->importe;?> &euro;</strong></li>
        <li>Periodicidad: <strong><?php echo $periodo_ops[$s->periodicidad];?></strong></li>
        <li>Cuota: <strong><?php echo $s->cuota;?> &euro;</strong></li>
        <li>Tipo de pago: <strong><?php echo $s->forma_pago;?></strong></li>
    </ul>
    <br/>
<?php
    $servicios_data[$s->idtipo_servicio] = array(
        "nombre"=> $nombre,
        "precio"=> $s->importe,
        "periodicidad"=> $periodo_ops[$s->periodicidad],
        "cuota"=> $s->cuota,
        "pago"=> $s->forma_pago
    );
endforeach;
if($cliente["tipo"] == 6) {
    $params = base64_encode("cliente_data=" . json_encode($cliente) . "&rep_data=" . urlencode(json_encode($rep_legal)) . "&aaff_data=" . urlencode(json_encode($aaff)) . "&serv=" . urlencode(json_encode($servicios_data)));
}else{
    $params=base64_encode("cliente_data=".json_encode($cliente)."&rep_data=".urlencode(json_encode($rep_legal))."&serv=".urlencode(json_encode($servicios_data)));
}
echo Html::anchor('http://localhost/docpdf/contrato_prestacion_servicios.php?q='.$params, '<span class="glyphicon glyphicon-file"></span> Generar contrato', array('class' => 'btn btn-info','target'=>'_blank'));
?>