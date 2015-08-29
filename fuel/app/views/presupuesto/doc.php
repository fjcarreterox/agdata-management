<h2>Datos necesarios para la generación del <span class='muted'>presupuesto</span></h2>
<br/>
<p>Los siguientes datos son los que se incluirán en el PDF del presupuesto que se va a generar.</p>
<p>Confirma que todos están completos y correctos antes de generar el PDF.</p>
<p>
	<strong>Núm. presupuesto:</strong>
	<?php $nump = str_pad($presupuesto->num_p,5,0, STR_PAD_LEFT); echo $nump; ?></p>
<p>
    <strong>Nombre del cliente:</strong>
    <?php
            $nombre_cliente = Model_Cliente::find($presupuesto->idcliente)->get('nombre');
            echo $nombre_cliente;
    ?></p>
<p>
    <strong>Nombre de la persona de contacto:</strong>
    <?php
            $nombre_contacto = Model_Personal::find('first',array('where'=>array('idcliente'=>$presupuesto->idcliente)))->get('nombre');
            echo $nombre_contacto;
    ?></p>
<p>
    <strong>Fecha de creación:</strong>
    <?php echo date(' H:i \d\e\l d-m-Y',$presupuesto->created_at); ?></p>
<p>
    <strong>Servicios ofertados:</strong>
    <?php echo Model_Servicio::find($presupuesto->servicios)->get('nombre')." LOPD"; ?></p>
<p>
    <strong>Importe total:</strong>
    <?php echo $presupuesto->importe; ?> &euro;</p>
<p>
    <strong>Estado:</strong>
    <?php echo Model_Estados_Presupuesto::find($presupuesto->idestado)->get('nombre'); ?></p>
<p>
    <strong>Usuario del sistema que lo ha generado:</strong>
    <?php
        $user = Model_Usuario::find(1)->get('nombre');
        echo $user;
    ?></p>
<br/>
<?php echo Html::anchor('presupuesto/edit/'.$presupuesto->id, 'Editar presupuesto',array('class'=>'btn btn-success')); ?>&nbsp;&nbsp;
<?php
    $params=base64_encode("nump=$nump&nombre=$nombre_cliente&contacto=$nombre_contacto&user=$user&fecha=$presupuesto->created_at");
    echo Html::anchor('http://localhost/docpdf/presupuesto.php?q='.$params, '<i class="icon-wrench"></i> Generar PDF', array('class' => 'btn btn-info','target'=>'_blank')); ?>&nbsp;&nbsp;
<?php echo Html::anchor('presupuesto', 'Volver al listado',array('class'=>'btn btn-danger')); ?>