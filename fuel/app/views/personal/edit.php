<h2>Editando datos de <span class='muted'>Personal</span> de cliente</h2>
<br/>
<?php
$data["clientes"] = $clientes;
$data["relaciones"] = $relaciones;
echo render('personal/_form',$data); ?>
<p><?php echo Html::anchor('personal/view/'.$personal->id, 'Ver datos'); ?> | <?php echo Html::anchor('personal', 'Volver al listado'); ?></p>
