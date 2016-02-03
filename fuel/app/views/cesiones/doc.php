<h2>Vista previa del <span class='muted'>contrato de cesión</span> del fichero seleccionado</h2>
<br/>
<p>A continuación mostramos los datos que se van a incluir en el <strong>contrato de cesión</strong> generado en PDF. Si alguno de
    ellos aún no está completado, por favor, complétalo antes y regresa a esta pantalla para generar el contrato
    correctamente.</p>

<h3>Datos de cliente:</h3>
<ul>
    <li><strong>Nombre:</strong> <?php $cliente_nombre = Model_Cliente::find($cesion->idcliente)->get('nombre');echo $cliente_nombre; ?></li>
    <li><strong>CIF:</strong> <?php echo Model_Cliente::find($cesion->idcliente)->get('cif_nif');?></li>
    <li><strong>Domicilio:</strong> <?php echo Model_Cliente::find($cesion->idcliente)->get('direccion');?></li>
    <li><strong>Código Postal:</strong> <?php echo Model_Cliente::find($cesion->idcliente)->get('cpostal');?></li>
    <li><strong>Localidad:</strong> <?php echo Model_Cliente::find($cesion->idcliente)->get('loc');?></li>
    <li><strong>Provincia:</strong> <?php echo Model_Cliente::find($cesion->idcliente)->get('prov');?></li>
</ul>

<h3>Empresa cesionaria:</h3>
<ul>
    <li><strong>Nombre:</strong> <?php echo Model_Cliente::find($cesion->idcesionaria)->get('nombre');?></li>
    <li><strong>CIF:</strong> <?php echo Model_Cliente::find($cesion->idcesionaria)->get('cif_nif');?></li>
    <li><strong>Domicilio:</strong> <?php echo Model_Cliente::find($cesion->idcesionaria)->get('direccion');?></li>
    <li><strong>Código Postal:</strong> <?php echo Model_Cliente::find($cesion->idcesionaria)->get('cpostal');?></li>
    <li><strong>Localidad:</strong> <?php echo Model_Cliente::find($cesion->idcesionaria)->get('loc');?></li>
    <li><strong>Provincia:</strong> <?php echo Model_Cliente::find($cesion->idcesionaria)->get('prov');?></li>
    <li><strong>Fecha de firma del contrato de cesión:</strong> <?php echo date_conv($cesion->fecha_contrato);?></li>
</ul>

<h3>Representante legal de la empresa cesionaria:</h3>
<ul>
    <li><strong>Nombre:</strong> <?php echo Model_Personal::find($cesion->idrep)->get('nombre');?></li>
    <li><strong>Cargo o función:</strong> <?php echo Model_Personal::find($cesion->idrep)->get('cargofuncion');?></li>
    <li><strong>DNI:</strong> <?php echo Model_Personal::find($cesion->idrep)->get('dni');?></li>
</ul>
<br/>
<p><?php
        $params=base64_encode("cliente_nombre=$cliente_nombre");
        echo Html::anchor('http://localhost/docpdf/contrato_cesion.php?q='.$params, '<span class="glyphicon glyphicon-print"></span> Generar contrato de cesión',array('class'=>'btn btn-info'));
    ?></p>
