<h2 xmlns="http://www.w3.org/1999/html">Nueva entrada en la <span class='muted'>Agenda</span></h2>
<br/>
<p>El cliente que deseas crear en la agenda debe existir previamente en el sistema, por lo que si aún no has introducido sus
<strong>datos básicos de contacto</strong>, deberás hacerlo <?php echo Html::anchor('clientes/create', 'aquí'); ?>.</p>
<br/>
<?php echo render('agenda/_form'); ?>
<p><?php echo Html::anchor('agenda', 'Volver al listado',array('class'=>'btn btn-danger')); ?></p>
