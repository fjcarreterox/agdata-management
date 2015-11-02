<h2>Datos necesarios para la generación del <span class='muted'>presupuesto</span></h2>
<br/>
<p>Los siguientes datos son los que se incluirán en el PDF del presupuesto que se va a generar. Por favor, confirma que
    todos están completos y correctos antes de generar el PDF definitivo.</p>
<br/>
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
            $p = Model_Personal::find('first',array('where'=>array('idcliente'=>$presupuesto->idcliente)));
            if($p){
                $nombre_contacto = $p->get('nombre');
            }
            else{
                $nombre_contacto = "-- NO EXISTENTE --";
            }
            echo $nombre_contacto;
    ?></p>
<p>
    <strong>Fecha de creación:</strong>
    <?php echo "a las ".date(' H:i \d\e\l d-m-Y',$presupuesto->created_at); ?></p>
<p>
    <strong>Servicios ofertados:</strong>
    <?php
        $serv=array();
        foreach($rel_servicios as $rs){
            $nombre = Model_Servicio::find($rs->idserv)->get('nombre');
            echo $nombre." ( ".number_format($rs->precio,2)." &euro; ), ";
            $serv[$rs->idserv] = array("nombre"=>$nombre,"precio"=>$rs->precio);
        }
    ?></p>
<p>
    <strong>Estado:</strong>
    <?php echo Model_Estados_Presupuesto::find($presupuesto->idestado)->get('nombre'); ?></p>
<p>
    <strong>Usuario del sistema que lo ha generado:</strong>
    <?php
        $user = Model_Usuario::find(Session::get('iduser'))->get('nombre');
        echo $user;
    ?></p>
<br/>
<?php echo Html::anchor('presupuesto/edit/'.$presupuesto->id, '<span class="glyphicon glyphicon-pencil"></span> Editar presupuesto',array('class'=>'btn btn-success')); ?>&nbsp;
<?php
    $params=base64_encode("nump=$nump&nombre=$nombre_cliente&contacto=$nombre_contacto&user=$user&fecha=$presupuesto->created_at&serv=".json_encode($serv));
    echo Html::anchor('http://localhost/docpdf/presupuesto.php?q='.$params, '<span class="glyphicon glyphicon-file"></span> Generar PDF', array('class' => 'btn btn-info','target'=>'_blank'));
?>&nbsp;
<?php echo Html::anchor('presupuesto', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?>