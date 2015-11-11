<h2>Asignar una nueva comunidad de propietarios a <span class='muted'><?php echo $nombre?></span></h2>
<br/>
<?php
$data['idaaff'] = $idaaff;
echo render('rel/comaaff/_form_com',$data); ?>
<p><?php echo Html::anchor('rel/comaaff/comunidades/'.$idaaff, '<span class="glyphicon glyphicon-backward"></span> Volver al listado de comunidades gestionadas',array('class'=>'btn btn-danger')); ?></p>
