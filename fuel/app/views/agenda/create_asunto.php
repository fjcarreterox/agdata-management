<h2>Nuevo asunto propio en la <span class='muted'>Agenda</span></h2>
<br/>
<p>Un asunto propio es aquel que está relacionado con la gestión interna de la empresa como reuniones internas, asuntos varios y/o personales, etc...</p>
<br/>
<?php
$data["users"] = $users;
echo render('agenda/_form_asunto',$data); ?>
<p><?php echo Html::anchor('agenda/activos', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?></p>
