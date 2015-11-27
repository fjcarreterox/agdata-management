<h2><span class="muted">Clientes</span> en el sistema: <u><?php echo $intro; ?></u></h2>
<br/>
<?php if ($clientes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre/Razón social</th>
			<th>Tipo</th>
			<th>CIF/NIF</th>
			<th>Teléfono</th>
			<th>Estado</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($clientes as $item): ?>
        <tr>
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo $tipo=Model_Tipo_Cliente::find($item->tipo)->get('tipo'); ?></td>
			<td><?php echo $item->cif_nif; ?></td>
			<td><?php echo $item->direccion; ?></td>
			<td><?php echo Model_Estados_Cliente::find($item->estado)->get('nombre'); ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('clientes/view/'.$item->id, '<span class="glyphicon glyphicon-eye-open"></span> Ficha completa', array('class' => 'btn btn-default')); ?>
                        <?php echo Html::anchor('clientes/edit/'.$item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success'));
                        if(\Fuel\Core\Session::get('idrol')==1){
                            echo Html::anchor('clientes/delete/'.$item->id, '<span class="glyphicon glyphicon-trash"></span> Borrar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de querer borrar este cliente? Esto conlleva que se borrarán todos sus datos asociados: presupuestos, contratos, servicios contratados, etc.')"));
                        }
                        if(strcmp($intro,"en activo")==0){
                            $cliente_data = array(
                                "nombre" => $item->nombre,
                                "tipo" => $tipo,
                                "dir" =>urlencode($item->direccion),
                                "cp" => $item->cpostal,
                                "loc" => $item->loc,
                                "prov" => $item->prov
                            );
                            //Only for communities
                            $rep_data = array();
                            $pres_name = "NO DISPONIBLE";
                            if($item->tipo==6){
                                $rel_aaff = Model_Rel_Comaaff::find('first',array('where'=>array('idcom'=>$item->id)));
                                $aaff = Model_Cliente::find($rel_aaff->idaaff);
                                $rep =  Model_Personal::find('first',array('where'=>array('idcliente'=>$aaff->id,'relacion'=>1)));
                                if($rep != null) {
                                    $rep_data["nombre"] = $rep->get('nombre');
                                    $rep_data["dir"] = $aaff->direccion;
                                    $rep_data["cp"] = $aaff->cpostal;
                                    $rep_data["loc"] = $aaff->loc;
                                    $rep_data["prov"] = $aaff->prov;
                                }

                                $pres = Model_Personal::find('first',array('where'=>array('idcliente'=>$item->id,'relacion'=>6)));
                                if($pres != null){
                                    $pres_name = $pres->nombre;
                                }
                            }

                            $ficheros_data = array();
                            $niveles = array("1"=>"Básico","2"=>"Medio","3"=>"Alto");
                            $ficheros = Model_Fichero::find('all',array('where'=>array('idcliente'=>$item->id)));
                            if($ficheros != null){
                                foreach($ficheros as $f){
                                    $ficheros_data[] = array(
                                        "idtipo" => $f->idtipo,
                                        "nombre" => Model_Tipo_Fichero::find($f->idtipo)->get('tipo'),
                                        "nivel" => $niveles[$f->nivel],
                                        "soporte" => $f->soporte
                                    );
                                }
                            }
                            $params=base64_encode("nombre=".$item->nombre."&tipo=".$tipo."&cliente_data=".json_encode($cliente_data)."&rep_data=".json_encode($rep_data)."&pres_name=".$pres_name."&f_data=".json_encode($ficheros_data));
                            echo Html::anchor('http://localhost/docpdf/doc_seguridad_ccpp.php?q='.$params, '<span class="glyphicon glyphicon-file"></span> Doc. seguridad', array('class' => 'btn btn-info','target'=>'_blank'));
                        }
                        ?>
                    </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<p>No se han encontrado clientes que cumplan los criterios de búsqueda establecidos.</p>
<?php endif; ?>
<br/>
<p><?php echo Html::anchor('clientes/create', '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo cliente', array('class' => 'btn btn-success')); ?>&nbsp;<?php echo Html::anchor('clientes/index', '<span class="glyphicon glyphicon-eye-open"></span> Ver listado completo de clientes', array('class' => 'btn btn-default')); ?></p>