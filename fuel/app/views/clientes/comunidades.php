<h2>Comunidades de propietarios gestionadas por <span class='muted'><?php echo $nombre; ?></span></h2>
<br/>
<?php if ($comunidades): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre/Razón social</th>
			<th>CIF/NIF</th>
			<th>C.Postal</th>
			<th>Estado</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php
    $num_com=0;
    foreach ($comunidades as $item):
            $com = Model_Cliente::find($item->idcom);
        if($com!=null) {
            $num_com++;
            ?>
            <tr>
                <td><?php echo $com->nombre; ?></td>
                <td><?php echo $com->cif_nif; ?></td>
                <td><?php echo $com->cpostal; ?></td>
                <td><?php echo Model_Estados_Cliente::find($com->estado)->get('nombre'); ?></td>
                <td>
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <?php echo Html::anchor('clientes/view/' . $com->id, '<span class="glyphicon glyphicon-eye-open"></span> Ficha completa', array('class' => 'btn btn-default')); ?>
                            <?php echo Html::anchor('rel/comaaff/delete/' . $com->id . '/' . $idaaff, '<span class="glyphicon glyphicon-trash"></span> Desasociar de este administrador', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
                            <?php echo Html::anchor('ficheros/viewall/' . $com->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver ficheros', array('class' => 'btn btn-info')); ?>
                        </div>
                    </div>

                </td>
            </tr>
            <?php
        }
        else{echo "<p class='red'>No se ha encontrado ficha para la C.PROP con id: $item->idcom";}
        endforeach; ?>
    </tbody>
</table>
<p>Este administrador de fincas tiene <b><?php echo $num_com;?></b> comunidades asociadas.</p>
<?php else: ?>
    <p>No se han encontrado aún comunidades asociadas a este administrador de fincas.</p>
<?php endif; ?>
<br/>
<p><?php echo Html::anchor('rel/comaaff/addcom/'.$idaaff, '<span class="glyphicon glyphicon-plus"></span> Asociar una nueva comunidad a este administrador', array('class' => 'btn btn-success')); ?>&nbsp;
    <?php echo Html::anchor('clientes/aaff', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de AAFF', array('class' => 'btn btn-danger')); ?></p>