<h2>Asociando un nuevo tipo de dato al <span class='muted'>fichero</span> seleccionado</h2>
<br/>
<?php
$data["datos"] = $datos;
$data["idfichero"] = $idfichero;
echo render('rel/estructura/_form',$data); ?>
<p><?php echo Html::anchor('rel/estructura', '<span class="glyphicon glyphicon-backward"></span> Volver la listado',array('class'=>'btn btn-danger')); ?></p>
