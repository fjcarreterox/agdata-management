<h2>Nueva entrada en la <span class='muted'>Agenda</span></h2>
<br/>
<p>El cliente que deseas crear en la agenda debe existir previamente en el sistema, por lo que si aún no has introducido sus
datos básicos, deberás hacerlo <?php echo Html::anchor('cliente/create', 'aquí'); ?>.</p>
<?php echo render('agenda/_form'); ?>
<p><?php echo Html::anchor('agenda', 'Volver'); ?></p>
