<h2>Editando el <span class='muted'>evento</span> seleccionado de la Agenda</h2>
<br/>
<?php
$data["clientes"] = $clientes;
$data["users"] = $users;
echo render('agenda/_form',$data); ?>
<p><?php echo Html::anchor('agenda/view/'.$agenda->id, '<span class="glyphicon glyphicon-eye-open"></span> Ver registro',array('class'=>'btn btn-default')); ?>
    &nbsp;&nbsp;<?php echo Html::anchor('agenda', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?></p>
