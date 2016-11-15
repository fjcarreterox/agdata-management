<h2>Cuestionario para eventos: <span class='muted'><?php echo $cname;?></span></h2>
<br/>
<?php
$data["idc"] = $idc;
echo render('qevents/_form',$data); ?>
<p><?php echo Html::anchor('qevents', '<span class="glyphicon glyphicon-backward"></span> Volver',array('class'=>'btn btn-danger')); ?></p>